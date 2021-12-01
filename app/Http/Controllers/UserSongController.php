<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\traits\ApiResponse;

class UserSongController extends Controller
{
    use ApiResponse;


    public function index(User $user)
    {
        $songs = $user->songs()->get();

        return $this->showAll($songs);
    }
}
