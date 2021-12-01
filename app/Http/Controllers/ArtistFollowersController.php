<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArtistFollowersController extends ApiController
{
    public function index(Artist $artist): JsonResponse
    {
        $followers = $artist->users()->get();

        return $this->showAll($followers);

    }
}
