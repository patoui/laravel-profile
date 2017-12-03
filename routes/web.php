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

Route::post('contact', 'ContactController@store')->name('contact.store');

// Post
Route::get('blog', 'PostController@index')->name('post.index');
Route::get('post/{slug}', 'PostController@show')->name('post.show');

// Comment
Route::post('post/{slug}/comment', 'PostCommentController@store')
    ->name('post.comment.store')
    ->middleware('auth');

Route::post('comment/{comment}', 'CommentFavouriteController@store')
    ->name('comment.favourite.store')
    ->middleware('auth');

// Subscription
Route::post('subscription', 'SubscriptionController@store')
    ->name('subscription.store');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration
Route::get('register', 'Auth\RegisterController@showRegistrationForm')
    ->name('register');
Route::post('register', 'Auth\RegisterController@register')
    ->name('register.store');

// Password Reset
// Route::get(
//     'password/reset',
//     'Auth\ForgotPasswordController@showLinkRequestForm'
// )->name('password.request');
// Route::post(
//     'password/email',
//     'Auth\ForgotPasswordController@sendResetLinkEmail'
// )->name('password.email');
// Route::get(
//     'password/reset/{token}',
//     'Auth\ResetPasswordController@showResetForm'
// )->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Socialite (Github)
Route::get('auth/github', 'Auth\LoginController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\LoginController@handleProviderCallback');
