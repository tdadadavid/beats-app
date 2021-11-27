<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\traits\ApiResponse;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;
use Illuminate\Validation\ValidationException;

class ArtistController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $artists = Artist::all();

        return $this->successResponse($artists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
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

//        if (in_array($newArtist['category_id'] , $categories)){
//
//            $category_no = $newArtist['category_id'];
//
//            $category_id = match ($category_no) {
//                1 => "Others",
//                2 => "Hip-Hop",
//                3 => "Sleep",
//                4 => "Gospel",
//                5 => "Country",
//                6 => "Rock",
//                7 => "Jazz",
//                default => $newArtist['category_id'],
//            };
//        }

       $newArtist->save();

        return $this->successResponse($newArtist);

    }

    /**
     * Display the specified resource.
     *
     * @param Artist $artist
     * @return JsonResponse
     */
    public function show(Artist $artist): JsonResponse
    {
        return $this->successResponse($artist);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Artist $artist
     * @return JsonResponse
     * @throws ValidationException
     */
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
            return $this
                ->errorResponse("No attribute was changed, fields needs to be changed to update" , 400);

        $artist->save();

        return $this->successResponse($artist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Artist $artist
     * @return JsonResponse
     */
    public function destroy(Artist $artist): JsonResponse
    {
        $artist->delete();

        return $this->successResponse($artist);
    }
}
