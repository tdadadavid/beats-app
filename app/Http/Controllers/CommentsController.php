<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentsResource;
use App\Models\Comments;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Js;
use Throwable;

class CommentsController extends ApiController
{

    public function index(): JsonResponse
    {
        $comments = Comments::all();

        $comments = CommentsResource::make($comments);
        return $this->showAll($comments);
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Comments $comment): JsonResponse
    {
        return $this->showOne($comment);
    }


    public function edit(Comments $comments)
    {
        //
    }

    public function update(Request $request, Comments $comments)
    {

    }

    public function destroy(Comments $comments): JsonResponse
    {
        //delete this comment
        $comments->deleteOrFail();

        return $this->showOne($comments);
    }
}
