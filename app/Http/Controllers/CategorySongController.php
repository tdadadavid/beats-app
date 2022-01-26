<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongResource;
use App\Models\Category;
use App\Models\Song;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class CategorySongController extends ApiController
{

    public function index(Category $category): JsonResponse
    {
        $songs = $category->songs()
                            ->get();

        $songs = SongResource::collection($songs);
        return $this->showAll($songs);
    }


}
