<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
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
    'songs' => SongController::class,
    'categories' => CategoryController::class,
    'artists' => ArtistController::class,
    'users' => UserController::class,
    'comments' => CommentsController::class,
]);

/*
 * How to read from file into database
 * work on routes
 * then work on model-relationships
 */
