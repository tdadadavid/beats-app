<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class UserController extends Controller
{

    use ApiResponse;

    public function index(): JsonResponse
    {
        $users = User::all();

        return $this->showAll($users);
    }


    public function create()
    {
        //
    }


    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name' => ['bail' , 'required' , 'min:0' , 'max:100'],
            'email' => ['bail' , 'required' , 'unique:users'],
            'password' => ['bail' , 'required' , 'min:8']
        ];

        $this->validate($request , $rules);

        $newUser = new User();

        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->image = $request->image ?? null;
        $newUser->password = Hash::make($request->password);

        $newUser->saveOrFail();

        return $this->showOne($newUser);
    }


    public function show(User $user): JsonResponse
    {
        return $this->showOne($user);
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user): JsonResponse
    {
        $rules = [
            'name' => ['bail' , 'min:0' , 'max:100'],
            'email' => ['bail', 'unique:users'],
            'password' => ['bail', 'min:8']
        ];

        $this->validate($request , $rules);

        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->password = $request->pasword ?? $user->password;

        if ($user->isClean())
            return $this->errorResponse("No field was changed for update" , 400);

        return  $this->showOne($user);
    }


    public function destroy(User $user): JsonResponse
    {
        $user->deleteOrFail();

        return $this->showOne($user);
    }
}
