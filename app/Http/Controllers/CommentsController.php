<?php

namespace App\Http\Controllers;

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

        return $this->showAll($comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Comments $comments
     * @return JsonResponse
     */
    public function show(Comments $comment): JsonResponse
    {
        return $this->showOne($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comments $comments
     * @return Response
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Comments $comments
     * @return Response
     */
    public function update(Request $request, Comments $comments)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comments $comments
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Comments $comments): JsonResponse
    {
        //delete this comment
        $comments->deleteOrFail();

        return $this->showOne($comments);
    }
}
