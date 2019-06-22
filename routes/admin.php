<?php

Route::get('/media', 'MediaController@index')
    ->name('admin.media.index')
    ->middleware('can:media.index');

Route::get('/media/create', 'MediaController@create')
    ->name('admin.media.create')
    ->middleware('can:media.create');

Route::get('/media/{media}/edit', 'MediaController@edit')
    ->name('admin.media.edit')
    ->middleware('can:media.edit');

Route::post('/media', 'MediaController@store')
    ->name('admin.media.store')
    ->middleware('can:media.store');

Route::put('/media/{media}/update', 'MediaController@update')
    ->name('admin.media.update')
    ->middleware('can:media.update');

Route::get('/media/{media}/delete', 'MediaController@delete')
    ->name('admin.media.delete')
    ->middleware('can:media.delete');

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

Route::get('/dashboard', 'DashboardController@index')
    ->name('admin.dashboard')
    ->middleware('can:dashboard.index');
