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

Route::apiResource('posts', 'PostController');
Route::apiResource('pages', 'PageController');
Route::get('post/revisions/{post}', 'PostController@getRevisions');
Route::post('post/attachMedia/{post}', 'PostController@attachMedia');
Route::get('page/revisions/{page}', 'PageController@getRevisions');

Route::get('media', 'MediaController@index');
Route::post('media', 'MediaController@store');
Route::post('media/{media}', 'MediaController@show');
