<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// DO NOT REMOVE
Route::get('/cass-and-pat/2016', function () {
    return view('cass-and-pat/2016');
});

Route::post(
    '/contact-me',
    'ContactMeController@store'
);

Route::get(
    '/blog',
    'PostController@index'
);
