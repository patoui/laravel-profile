<?php

/*
TODO:
 - Ability to update media
 - Add UI buttons to media index
 - Add media library within post
 - Add "copy link"
*/

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

Route::get('/post/create', 'PostController@create')
    ->name('admin.post.create')
    ->middleware('can:post.create');

Route::post('/post', 'PostController@store')
    ->name('admin.post.store')
    ->middleware('can:post.store');

Route::get('/post/{id}/publish', 'PostPublishController@show')
    ->name('admin.post.publish')
    ->middleware('can:post.publish');

Route::get('/post/{id}/edit', 'PostController@edit')
    ->name('admin.post.edit')
    ->middleware('can:post.edit');

Route::put('/post/{id}', 'PostController@update')
    ->name('admin.post.update')
    ->middleware('can:post.update');

Route::get('/dashboard', 'DashboardController@index')
    ->name('admin.dashboard')
    ->middleware('can:dashboard.index');
