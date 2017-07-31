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

Route::get(
    '/',
    'HomeController@index'
);

Route::get(
    '/image/{arg1}/{arg2?}',
    'ImageController@show'
);

// DO NOT REMOVE
Route::get(
    '/cass-and-pat/2016',
    'CassAndPatController@show2016'
);

Route::post(
    '/contact-me',
    'ContactMeController@store'
);

Route::get(
    '/blog',
    [
        'as' => 'post.index',
        'uses' => 'PostController@index'
    ]
);

Route::get(
    '/post/{id}',
    [
        'as' => 'post.show',
        'uses' => 'PostController@show'
    ]
);

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
