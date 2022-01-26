<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArtistResource;
use App\Models\Song;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SongArtistController extends Controller
{
    use ApiResponse;

    public function index(Song $song) : JsonResponse
    {
        $artist = $song->artist()->get();

        $artist = ArtistResource::collection($artist);
        return $this->showOne($artist);
    }

}
