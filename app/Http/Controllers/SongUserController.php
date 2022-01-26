<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
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

        $users = UserResource::collection($users);
        return $this->showAll($users);
    }
}
