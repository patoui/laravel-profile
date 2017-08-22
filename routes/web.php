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

Route::get('/', 'HomeController@index')->name('home');

// DO NOT REMOVE
Route::get('cass-and-pat/2016', 'CassAndPatController@show2016');
Route::post('contact', 'ContactController@store')->name('contact.store');

// Blog
Route::get('blog', 'BlogController@index')->name('post.index');

// Post
Route::get('post/{slug}', 'PostController@show')->name('post.show');

// Comment
Route::post('post/{slug}/comment', 'PostCommentController@store')
    ->name('post.comment.store')
    ->middleware('auth');

// Subscription
Route::post('subscription', 'SubscriptionController@store')
    ->name('subscription.store');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Socialite
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
