<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongResource;
use App\Models\Artist;
use App\traits\ApiResponse;

class ArtistSongController extends ApiController
{
    public function index(Artist $artist)
    {
        $songs = $artist->songs()->get();

        $songs = SongResource::collection($songs);
        return $this->showAll($songs);
    }

    public function upload()
    {

    }
}
