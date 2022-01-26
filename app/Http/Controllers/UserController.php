<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\WelcomeNotificationEmail;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;
use Throwable;

class UserController extends Controller
{

    use ApiResponse;

    public function index(): JsonResponse
    {
        $users = User::all();

        $users = UserResource::collection($users);
        return $this->showAll($users);
    }

    public function show(User $user): JsonResponse
    {
        $user = UserResource::make($user);
        return $this->showOne($user);
    }

    /** @throws  ValidationException */
    public function update(Request $request, User $user): JsonResponse
    {
        // validate the request
        $this->validate($request , $this->validationRulesForNameEmailAndPassword());


        // store the update attribute or if there is no changed
        // keep original properties
        $user->name = $request->username ?? $user->username;
        $user->email = $request->email ?? $user->email;
        $user->password = $request->pasword ?? $user->password;

        // if there was no change
        if ($user->isClean())
            return $this->errorResponse("No field was changed for update" , 400);

        // persist the change to the database
        $user->save();

        // return the updates
        return $this->showOne(UserResource::make($user));
    }

    /** @throws Throwable */
    public function destroy(User $user): JsonResponse
    {
        $user->deleteOrFail();

        $user = UserResource::make($user);
        return $this->showOne($user);
    }


    private function validationRulesForNameEmailAndPassword(): array
    {
        return [
            'name' => 'bail|min:0|max:100',
            'email' => 'bail|unique:users',
            'password' => "bail|min:8|"
        ];
    }
}
