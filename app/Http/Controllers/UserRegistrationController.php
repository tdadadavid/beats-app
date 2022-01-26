<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use App\Notifications\WelcomeNotificationEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class UserRegistrationController extends ApiController
{
    public function register(Request $request): JsonResponse
    {
        // validate the request
       $this->validate($request , $this->validationRules());

       // create a new user
       $newUser = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'image' => $request->image ?? null,
           'verified' => User::UNVERIFIED,
           'verification_token' => Str::random(40),
           'password' => Hash::make($request->password)
       ]);

        // save user
        $newUser->save();
        // Send user a welcome notification email
        $newUser->notify(new WelcomeNotificationEmail($newUser));
        
        $result = UserResource::make($newUser);
        return $this->showOne($result);
    }

    public function sendVerificationCode(User $user): JsonResponse
    {
        if ($user->verified === true)
            return $this->errorResponse("You're already a verified user. " , 409);

        $user->notify(new VerifyEmailNotification($user));

        return $this->showOne("Check your email for the verification code!");
    }

    public function verifyEmail($token): JsonResponse
    {
        $user = User::where('verification_token' , $token)->firstOrFail();

        $user->verification_token = null;
        $user->verified = User::VERIFIED;
        $user->email_verified_at = now();

        $user->save();

        return $this->showOne("Your account has been successfully verified");

    }

    private function validationRules(): array {

        return [
            'name' => ['bail' , 'required' , 'string' , 'max:255'],
            'email' => ['bail', 'required', 'email', 'max:255', 'unique:users'],
            'password' => ['bail', 'required' , Password::min(8)
                                                        ->mixedCase()
                                                        ->numbers()
                                                        ->symbols()
                                                        ->uncompromised()
            ],
            'confirm_password' => ['required' , 'same:password']
        ];
    }

}
