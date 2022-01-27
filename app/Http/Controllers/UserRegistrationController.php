<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use App\Providers\NewUserRegistration;
use App\Providers\VerificationCodeResend;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class UserRegistrationController extends ApiController
{
    public function register(Request $request): JsonResponse
    {
        // validate the request
       $this->validate($request , self::validationRules());

       // create a new user
       $newUser = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'image' => $request->image ?? null,
           'verified' => User::UNVERIFIED,
           'verification_token' => Str::random(40),
           'password' => Hash::make($request->password)

       ]);

        // Send user a welcome notification email
        event(new NewUserRegistration($newUser));

        // refactor the database fields
        $result = UserResource::make($newUser);

        // return the new user instance
        return $this->showOne($result);
    }

    public function sendVerificationCode(User $user): JsonResponse
    {
        // check if the user is already verified
        // if the user is verified continue or else throw error response
        if($user->verified)
            return $this->errorResponse("You're already a  verified user" ,409);

        event(new VerificationCodeResend($user));

        return $this->showOne("Check your email for the verification code!");
    }

    public function verifyEmail($token): JsonResponse
    {
        // find the user with this token
        $user = User::where('verification_token' , $token)
                        ->firstOrFail();


        // update the necessary fileds
        $user->verification_token = null;
        $user->verified = User::VERIFIED;
        $user->email_verified_at = now();

        // persist the changes
        $user->save();

        // return message
        return $this->showOne("Your account has been successfully verified");
    }

    private static function validationRules(): array {

        // validation rules
        return [
            'name' => 'bail|required|string|max:255',
            'email' => 'bail|required|email|max:255|unique:users',
            'password' => ['bail' , 'required', Password::min(8)
                                            ->mixedCase()->numbers()
                                            ->symbols()->uncompromised()
            ],
            'confirm_password' => 'required|same:password'
        ];

    }

}
