<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{

    public function index():JsonResponse
    {
        $categories = Category::all();

        return $this->showAll($categories);
    }

    public function show(Category $category): JsonResponse
    {
        return $this->showOne($category);
    }

}
