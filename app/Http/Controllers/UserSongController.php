<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongResource;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\JsonResponse;

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

        if($user->isSubscribed($song))
            return $this->errorResponse("Error, You're already subscribed to this song" , 403);

        $user->subscribe($song)->refresh();

        return $this->showOne("Subscription successful");
    }

    public function unsubscribe(User $user , Song $song): JsonResponse
    {
        if (!$user->isSubscribed($song))
            return $this->errorResponse("You're not a subscriber to this song" , 404);

        $user->unsubscribe($song)->refresh();

        return $this->showOne("You've successfully unsubscribed");
    }

    public function likeASong(User $user , Song $song)
    {
        // a user must be registered to like a song
        // email the artist if the likes on a
        // particular song  increased by 10
        // store the song in the user favorite (I need a database for this)
    }

    public function dislikeASong(User $user , Song $song)
    {
        // a user must be registered to like a song
        // email the artist if the dislikes on a
        // particular song  decreased by 10
        // remove the song from the user favorite (I need a database for this)
        // return the list of user favorite
    }

    public function favoriteSongs(User $user)
    {
        // the user must be registered
        // then show the list of user's favorite songs
    }

    // work on a user ability to like and dislike a song
    // work on the routes and database for these new lines
    // line of development then, don't forget to create an
    // email event for the Artist, like and discount counter
    // check on Aspect Oriented programming and Queues and Jobs'
    // in Laravel

}
