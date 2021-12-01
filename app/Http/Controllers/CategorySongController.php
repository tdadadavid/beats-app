<?php

namespace App\Http\Controllers;

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

        return $this->showAll($songs);
    }


}
