<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ArtistFollowersController;
use App\Http\Controllers\ArtistSongController;
use App\Http\Controllers\CategoryArtistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorySongController;
use App\Http\Controllers\CategoryUserController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SongArtistController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\SongUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSongController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResources([
    'categories' => CategoryController::class, // cannot delete or update only see
    'comments' => CommentsController::class,
    'replies' => ReplyController::class,
],
    ['only' => ['index' , 'show']]
);

Route::apiResources([
    'songs' => SongController::class,
    'artists' => ArtistController::class,
    'users' => UserController::class,
    'categories.songs' => CategorySongController::class,
    'categories.users' => CategoryUserController::class,
    'categories.artist' => CategoryArtistController::class,
    'artists.followers' => ArtistFollowersController::class,
    'artists.songs' => ArtistSongController::class,
    'songs.artist' => SongArtistController::class,
    'songs.users' => SongUserController::class,
    'users.songs' => UserSongController::class,
]);

/*
 * How to read from file into database
 * work on routes
 * then work on model-relationships
 */
