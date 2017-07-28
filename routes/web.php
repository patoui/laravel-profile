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

Route::get('/', 'HomeController@index');
Route::get('/image/{arg1}/{arg2?}', 'ImageController@show');

// DO NOT REMOVE
Route::get('/cass-and-pat/2016', 'CassAndPatController@show2016');
Route::post('/contact-me', 'ContactMeController@store');

// Blog
Route::get('/blog', 'PostController@index')->name('post.index');
Route::get('/post/{id}', 'PostController@show')->name('post.show');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
