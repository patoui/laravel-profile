<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

// Post
Route::get('blog', 'PostController@index')->name('post.index');
Route::get('post/{post:slug}', 'PostController@show')->name('post.show');

// Tip
Route::get('tip', 'TipController@index')->name('tip.index');
Route::get('tip/{tip:slug}', 'TipController@show')->name('tip.show');

Route::get('video', 'VideoController@index')->name('video.index');
Route::get('video/{video}', 'VideoController@show')->name('video.show');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::feeds();
