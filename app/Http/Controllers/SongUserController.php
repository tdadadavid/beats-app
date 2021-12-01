<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SongUserController extends Controller
{
    use ApiResponse;

    public function index(Song $song): JsonResponse
    {
        $users = $song->users()->get();

        return $this->showAll($users);
    }
}
