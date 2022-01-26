<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongResource;
use App\Http\Resources\UserResource;
use App\Models\Song;
use App\Models\User;
use Couchbase\ClusterOptions;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class UserSongController extends ApiController
{
    public function index(User $user): JsonResponse
    {
        $songs = $user->songs()->get();

        $songs = SongResource::collection($songs);
        return $this->showAll($songs);
    }

    public function subscribe(User $user, Song $song): JsonResponse
    {
        // check whether the song exist
        $itsExists = Song::where('id', '=', $song->id)->exists();
        if (!$itsExists)
            return $this->errorResponse("There is no song as such", 404);

        // check whether this user has subscribed to this song
        $userPlaylist = $user->songs()->get();


        $arr = [];
        $index = 0;
        foreach ($userPlaylist as $singleSong){
            $arr[$index] = $singleSong['id'];
            $index++;
        }

        // if the user is a subscriber then return error
        if(in_array($song->id , $arr))
            return $this->errorResponse("You're already a subscriber to this song", 409);


        // if not subscribe the user
        $user->songs()->attach($song->id);
        $user->refresh();

        return $this->showOne("Subscription successful");

    }

    public function unsubscribe(User $user , Song $song): JsonResponse
    {
        $user->songs()->detach($song->id);

        return $this->showOne("You've successfully unsubscribed");
    }

}
