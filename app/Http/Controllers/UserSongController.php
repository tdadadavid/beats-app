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
        if(!$song->songExists($song))
            return $this->errorResponse("Song does not exits." ,404);

        if($user->isASubscriber($song))
            return $this->errorResponse("Error, You're already subscribed to this song" , 403);

        $user->subscribe($song)->refresh();

        return $this->showOne("Subscription successful");
    }

    public function unsubscribe(User $user , Song $song): JsonResponse
    {
        if (!$user->isASubscriber($song))
            return $this->errorResponse("You're not a subscriber to this song" , 404);

        $user->unsubscribe($song)->refresh();

        return $this->showOne("You've successfully unsubscribed");
    }

    // work on a user ability to like and dislike a song

}
