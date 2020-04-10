<?php

use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get('/', 'HomeController@index')->name('home');
Route::post('contact', 'ContactController@store')
    ->name('contact.store')
    ->middleware(ProtectAgainstSpam::class);

// Post
Route::get('blog', 'PostController@index')->name('post.index');
Route::get('post/{post}', 'PostController@show')->name('post.show');
Route::post('post/{post}', 'PostFavouriteController@store')
    ->name('post.favourite.store')
    ->middleware('auth');

// Comment
Route::post('post/{post}/comment', 'PostCommentController@store')
    ->name('post.comment.store')
    ->middleware('auth', ProtectAgainstSpam::class);

Route::post('comment/{comment}', 'CommentFavouriteController@store')
    ->name('comment.favourite.store')
    ->middleware('auth');

// Tip
Route::get('tip', 'TipController@index')->name('tip.index');
Route::get('tip/{tip}', 'TipController@show')->name('tip.show');
Route::post('tip/{tip}', 'TipFavouriteController@store')
    ->name('tip.favourite.store')
    ->middleware('auth');

Route::get('video', 'VideoController@index')->name('video.index');
Route::get('video/{video}', 'VideoController@show')->name('video.show');
Route::post('video/{video}', 'VideoFavouriteController@store')
    ->name('video.favourite.store')
    ->middleware('auth');

// Subscription
Route::post('subscription', 'SubscriptionController@store')
    ->name('subscription.store');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register.store');

// Verification
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// Socialite (Github)
Route::get('auth/github', 'Auth\LoginController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('sms', 'SmsController@index')
    ->name('sms.index')
    ->middleware('can:sms.index');
Route::post('sms', 'SmsController@store')
    ->name('sms.store')
    ->middleware('can:sms.store');

Route::feeds();

Route::get('covid19', 'Covid19Controller@index')->name('covid19');
Route::post('covid19', 'Covid19Controller@index');

if (app()->environment('development')) {
    Route::view('storm-the-house', 'games/storm-the-house/index');
}
