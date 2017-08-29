<?php

Route::get('/post/create', 'PostController@create')->name('admin.post.create');
Route::post('/post', 'PostController@store')->name('admin.post.store');
Route::get('/post/{id}/publish', 'PostPublishController@show')
    ->name('admin.post.publish');
Route::get('/post/{id}/edit', 'PostController@edit')->name('admin.post.edit');
Route::put('/post/{id}', 'PostController@update')->name('admin.post.update');

Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
