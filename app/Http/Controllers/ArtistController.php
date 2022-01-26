<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArtistResource;
use App\Models\Artist;
use App\traits\ApiResponse;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;
use Illuminate\Validation\ValidationException;

class ArtistController extends ApiController
{

    public function index(): JsonResponse
    {
        $artists = Artist::all();

        $artists = ArtistResource::collection($artists);
        return $this->showAll($artists);
    }


    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required',
            'category_id' => 'required|min:1|max:7'
        ];

        $this->validate($request , $rules);

        $newArtist = new Artist();

        $newArtist->name = $request->name;
        $newArtist->category_id = $request->category_id;
        $newArtist->image = $request->image;
        $newArtist->followers = $request->followers;
        $newArtist->rating = $request->rating;

       $newArtist->save();

       $newArtist = ArtistResource::collection($newArtist);
       return $this->showOne($newArtist);

    }


    public function show(Artist $artist): JsonResponse
    {
        $artist = ArtistResource::collection($artist);
        return $this->showOne($artist);
    }


    public function edit(Artist $artist)
    {
        //
    }


    public function update(Request $request, Artist $artist): JsonResponse
    {
        $rules = [
            'category_id' => 'required|min:1|max:7'
        ];

        $this->validate($request , $rules);

        $artist->name = $request->name ?? $artist->name;
        $artist->image = $artist->image ?? $artist->image;
        $artist->category_id = $request->category_id ?? $artist->category_id;

        if ($artist->isClean())
            return $this->errorResponse("No field was changed update" , 400);

        $artist->save();

        $artist = ArtistResource::collection($artist);
        return $this->showOne($artist);
    }


    public function destroy(Artist $artist): JsonResponse
    {
        $artist->delete();

        $artist = ArtistResource::collection($artist);
        return $this->showOne($artist);
    }
}
