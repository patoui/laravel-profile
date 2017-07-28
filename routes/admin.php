<?php

// Dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Post
Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post', 'PostController@store')->name('post.store');
Route::get('/post/{id}/edit', 'PostController@edit')->name('post.edit');
Route::put('/post/{id}', 'PostController@update')->name('post.update');
