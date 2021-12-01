<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class ReplyController extends ApiController
{

    public function index(): JsonResponse
    {
        $replies = Reply::all();

        return $this->successResponse($replies);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = [

        ];
    }

    public function show(Reply $reply): JsonResponse
    {
        return $this->showOne($reply);
    }


    public function edit(Reply $reply)
    {
        //
    }


    public function update(Request $request, Reply $reply)
    {
        //
    }

    public function destroy(Reply $reply): JsonResponse
    {
        //delete this reply
        $reply->deleteOrFail();

        // display the deleted reply
        return $this->showOne($reply);
    }
}
