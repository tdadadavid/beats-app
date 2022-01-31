<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongResource;
use App\Models\Song;
use App\traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SongController extends Controller
{
    use ApiResponse;

    public function index(): JsonResponse
    {
        $songs = Song::all();

        $songs = SongResource::collection($songs);
        return $this->showAll($songs);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'artist_id' => 'required|exists:artists,id',
            'category_id' => 'required|integer|exists:categories,id',
            'duration' => 'required|integer|min:1|max:100000'
        ];

        $this->validate($request , $rules);

        $newSong = Song::create([
            'name' => $request->name,
            'image' => $request->image ?? null,
            'artist_id' => $request->artist_id,
            'category_id' => $request->category_id,
            'duration' => $request->duration,
            'date_of_release' => now(),
            'no_of_likes' => $request->no_of_likes ?? 0,
            'no_of_dislikes' => $request->no_of_dislikes ?? 0,
            'file_size' => $request->file_size
        ]);

        $newSong->save();

        $newSong = SongResource::make($newSong);
        return $this->showOne($newSong);
    }

    public function show(Song $song): JsonResponse
    {
        $song = SongResource::make($song);
        return $this->showOne($song);
    }

    public function update(Request $request, Song $song): JsonResponse
    {
        $rules = [
            'name' => 'string',
            'category_id' => 'min:1|max:7|integer|exists:categories,id',
            'duration' => 'integer|min:1|max:100000'
        ];

        $this->validate($request , $rules);

        // create an update function in my model

        // Update the song
        $song->name = $request->name ?? $song->name;
        $song->artist_id = $request->artist_id ?? $song->artist_id;
        $song->category_id = $request->category_id ?? $song->category_id;
        $song->duration  = $request->duration ?? $song->duration;

        // check if there was no change
        // then throw error response
        if ($song->isClean())
            return $this->errorResponse("No field was changed update" , 400);

        // persist it to the database
        $song->save();

        $song = SongResource::make($song);
        return $this->showOne($song);
    }


    public function destroy(Song $song): JsonResponse
    {
        $song->delete();
        $song = SongResource::make($song);
        return $this->showOne($song);
    }
}
