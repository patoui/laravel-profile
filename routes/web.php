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
    '/post/create',
    [
        'as' => 'post.create',
        'uses' => 'PostController@create'
    ]
);

Route::get(
    '/post/{id}',
    [
        'as' => 'post.show',
        'uses' => 'PostController@show'
    ]
);

Route::post(
    '/post',
    [
        'as' => 'post.store',
        'uses' => 'PostController@store'
    ]
);

Route::get(
    '/post/{id}/edit',
    [
        'as' => 'post.edit',
        'uses' => 'PostController@edit'
    ]
);

Route::put(
    '/post/{id}',
    [
        'as' => 'post.update',
        'uses' => 'PostController@update'
    ]
);

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
