<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get(
    '/user', function (Request $request) {
        return $request->user();
    }
);

// posts
Route::apiResource('posts', 'PostController');
Route::get('post/revisions/{post}', 'PostController@getRevisions');
Route::post('post/attachMedia/{post}', 'PostController@attachMedia');

Route::get('postsForUser/{user}', 'PostController@getPostsForUser');


// pages
Route::apiResource('pages', 'PageController');
Route::get('page/revisions/{page}', 'PageController@getRevisions');

// media
Route::get('media', 'MediaController@index');
Route::post('media', 'MediaController@store');
Route::post('media/{media}', 'MediaController@show');
Route::post('page/attachMedia/{page}', 'PageController@attachMedia');