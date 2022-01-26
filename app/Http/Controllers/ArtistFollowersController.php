<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Artist;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArtistFollowersController extends ApiController
{
    public function index(Artist $artist): JsonResponse
    {
        $followers = $artist->users()->get();

        $followers = UserResource::collection($followers);
        return $this->showAll($followers);

    }
}
