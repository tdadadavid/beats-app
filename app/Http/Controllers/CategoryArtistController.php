<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class CategoryArtistController extends ApiController
{
    use ApiResponse;

    public function index(Category $category): JsonResponse
    {
        $artists = $category->artists()->get();

        return $this->showAll($artists);
    }
}
