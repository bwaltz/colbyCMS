<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get(
//     '/', function () {
//         return view('welcome');
//     }
// );


Auth::routes();

// frontend routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'PostController@all');
Route::get('/post/{slug}', 'PostController@single')->where('slug', '.*');
Route::get('/preview/post/{post}', 'PostController@preview')->middleware('role:superAdmin|admin|editor|author');
Route::get('/preview/page/{page}', 'PageController@preview')->middleware('role:superAdmin|admin|editor|author');
Route::post('/upload', 'MediaController@upload');

Route::get(
    '/contact-us', function () {
        return view('contact');
    }
)->name('contact');

Route::get(
    '{slug}', [
    'uses' => 'PageController@getPage'
    ]
)->where('slug', '^(?!admin).+$');

// admin routes
Route::get(
    '/admin/logout', function () {
        Session::flush();
        Auth::logout();
        return Redirect::to("/login")
        ->with('message', array('type' => 'success', 'text' => 'You have successfully logged out'));
    }
);
Route::get('/admin/{any}', 'AdminController@index')->where('any', '.*')->middleware('role:superAdmin|admin|editor|author');
