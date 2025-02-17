<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostPublishController;
use App\Http\Controllers\Admin\TipController;
use App\Http\Controllers\Admin\TipPublishController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\VideoPublishController;
use Illuminate\Support\Facades\Route;

// Post
Route::get('post/create', [PostController::class, 'create'])
    ->name('admin.post.create')
    ->middleware('can:post.create');
Route::post('post', [PostController::class, 'store'])
    ->name('admin.post.store')
    ->middleware('can:post.store');
Route::get('post/{post}/publish', [PostPublishController::class, 'show'])
    ->name('admin.post.publish')
    ->middleware('can:post.publish');
Route::get('post/{post}/edit', [PostController::class, 'edit'])
    ->name('admin.post.edit')
    ->middleware('can:post.edit');
Route::put('post/{post}', [PostController::class, 'update'])
    ->name('admin.post.update')
    ->middleware('can:post.update');

// Tip
Route::get('tip/create', [TipController::class, 'create'])
    ->name('admin.tip.create')
    ->middleware('can:tip.create');
Route::post('tip', [TipController::class, 'store'])
    ->name('admin.tip.store')
    ->middleware('can:tip.store');
Route::get('tip/{tip}/publish', [TipPublishController::class, 'show'])
    ->name('admin.tip.publish')
    ->middleware('can:tip.publish');
Route::get('tip/{tip}/edit', [TipController::class, 'edit'])
    ->name('admin.tip.edit')
    ->middleware('can:tip.edit');
Route::put('tip/{tip}', [TipController::class, 'update'])
    ->name('admin.tip.update')
    ->middleware('can:tip.update');

// Video
Route::get('video/create', [VideoController::class, 'create'])
    ->name('admin.video.create')
    ->middleware('can:video.create');
Route::post('video', [VideoController::class, 'store'])
    ->name('admin.video.store')
    ->middleware('can:video.store');
Route::get('video/{video}/edit', [VideoController::class, 'edit'])
    ->name('admin.video.edit')
    ->middleware('can:video.edit');
Route::put('video/{video}', [VideoController::class, 'update'])
    ->name('admin.video.update')
    ->middleware('can:video.update');
Route::get('video/{video}/publish', [VideoPublishController::class, 'show'])
    ->name('admin.video.publish')
    ->middleware('can:video.publish');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware('can:dashboard.index');
