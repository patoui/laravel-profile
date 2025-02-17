<?php

use Illuminate\Support\Facades\Route;

// Post
Route::get('/post/create', 'PostController@create')
    ->name('admin.post.create')
    ->middleware('can:post.create');
Route::post('/post', 'PostController@store')
    ->name('admin.post.store')
    ->middleware('can:post.store');
Route::get('/post/{post}/publish', 'PostPublishController@show')
    ->name('admin.post.publish')
    ->middleware('can:post.publish');
Route::get('/post/{post}/edit', 'PostController@edit')
    ->name('admin.post.edit')
    ->middleware('can:post.edit');
Route::put('/post/{post}', 'PostController@update')
    ->name('admin.post.update')
    ->middleware('can:post.update');

// Tip
Route::get('/tip/create', 'TipController@create')
    ->name('admin.tip.create')
    ->middleware('can:tip.create');
Route::post('/tip', 'TipController@store')
    ->name('admin.tip.store')
    ->middleware('can:tip.store');
Route::get('/tip/{tip}/publish', 'TipPublishController@show')
    ->name('admin.tip.publish')
    ->middleware('can:tip.publish');
Route::get('/tip/{tip}/edit', 'TipController@edit')
    ->name('admin.tip.edit')
    ->middleware('can:tip.edit');
Route::put('/tip/{tip}', 'TipController@update')
    ->name('admin.tip.update')
    ->middleware('can:tip.update');

// Video
Route::get('/video/create', 'VideoController@create')
    ->name('admin.video.create')
    ->middleware('can:video.create');
Route::post('/video', 'VideoController@store')
    ->name('admin.video.store')
    ->middleware('can:video.store');
Route::get('/video/{video}/edit', 'VideoController@edit')
    ->name('admin.video.edit')
->middleware('can:video.edit');
Route::put('/video/{video}', 'VideoController@update')
    ->name('admin.video.update')
    ->middleware('can:video.update');
Route::get('/video/{video}/publish', 'VideoPublishController@show')
    ->name('admin.video.publish')
    ->middleware('can:video.publish');

Route::get('/dashboard', 'DashboardController@index')
    ->name('admin.dashboard')
    ->middleware('can:dashboard.index');
