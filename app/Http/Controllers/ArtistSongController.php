<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\traits\ApiResponse;

class ArtistSongController extends ApiController
{
    public function index(Artist $artist)
    {
        $songs = $artist->songs()->get();

        return $this->showAll($songs);
    }
}
