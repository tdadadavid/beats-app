<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SongController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $songs = Song::all();

        return $this->successResponse($songs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function ofcreate()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'artist_id' => 'required',
            'category_id' => 'required|string',
            'duration' => 'required|integer|min:1|max:100000'
        ];

        $this->validate($request , $rules);

        $newSong = new Song();

        $newSong->name = $request->name;
        $newSong->image = ($request->image === null) ? $newSong->image : $request->image;
        $newSong->artist_id = $request->artist_id;
        $newSong->category_id = $request->category_id;
        $newSong->duration = $request->duration;
        $newSong->date_of_release = Carbon::now();
        $newSong->no_of_likes = ($request->no_of_likes === null) ? 0 : $request->no_of_likes;
        $newSong->no_of_dislikes= ($request->no_of_dislikes === null) ? 0 : $request->no_of_dislikes;
        $newSong->file_size = $request->file_size;

        if ($newSong->isClean())
            return  $this->errorResponse("No fields was changed , you need to change a field to update" , 400);

        $newSong->save();

        return $this->successResponse($newSong);
    }

    /**
     * Display the specified resource.
     *
     * @param Song $song
     * @return JsonResponse
     */
    public function show(Song $song): JsonResponse
    {
        return $this->successResponse($song);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Song $song
     * @return Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Song $song
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Song $song): JsonResponse
    {
        $rules = [
            'name' => 'string',
            'category_id' => 'min:1|max:7',
            'duration' => 'integer|min:1|max:100000'
        ];

        $this->validate($request , $rules);

        $song->name = $request->name ?? $song->name;
        $song->artist_id = $request->artist_id ?? $song->artist_id;
        $song->category_id = $request->category_id ?? $song->category_id;
        $song->duration  = $request->duration ?? $song->duration;

        if ($song->isClean())
            return $this
                ->errorResponse("No attribute was changed, fields needs to be changed to update" , 400);

        $song->save();

        return $this->successResponse($song);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Song $song
     * @return JsonResponse
     */
    public function destroy(Song $song): JsonResponse
    {
        $song->delete();
        return $this->successResponse($song);
    }
}
