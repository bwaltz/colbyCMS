<?php

// Register Twill routes here (eg. Route::module('posts'))
Route::module('pages');
Route::module('categories');
Route::module('posts');
Route::name('customPage')->get('/customPage', 'CustomPageController@show');

