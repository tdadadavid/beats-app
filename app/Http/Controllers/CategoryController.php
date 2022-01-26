<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{

    public function index():JsonResponse
    {
        $categories = Category::all();

        $categories = CategoryResource::collection($categories);
        return $this->showAll($categories);
    }

    public function show(Category $category): JsonResponse
    {
        $category = CategoryResource::collection($category);
        return $this->showOne($category);
    }

}
