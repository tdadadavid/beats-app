<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserLoginController extends ApiController
{

    public function login(Request $request): JsonResponse
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];

        $this->validate($request , $rules);

        return $this->showOne("Welcome back!");
    }

}
