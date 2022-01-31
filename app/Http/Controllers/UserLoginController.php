<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserLoginController extends ApiController
{

    public function login(Request $request):JsonResponse
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $this->validate($request , $rules);

        // try to see if this user exists
        // or else throw error message
        try {
//            $request->isAnExistingUser();

            $user = User::where('email', $request->email)->firstOrFail();
        }
        catch (ModelNotFoundException $notFoundException) {
            return $this->errorResponse("You must be registered to login", 409);
        }

        // check if the password given is consistent
        // with the hashed password in the database
        if (!Hash::check($request->password , $user->password))
            return $this->errorResponse("The password mismatch" , 409);


        return $this->errorResponse("Welcome back" , 200);
    }

}
