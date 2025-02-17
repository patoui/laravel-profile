<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Post
Route::get('blog', [PostController::class, 'index'])->name('post.index');
Route::get('post/{post:slug}', [PostController::class, 'show'])->name('post.show');

// Tip
Route::get('tip', [TipController::class, 'index'])->name('tip.index');
Route::get('tip/{tip:slug}', [TipController::class, 'show'])->name('tip.show');

Route::get('video', [VideoController::class, 'index'])->name('video.index');
Route::get('video/{video}', [VideoController::class, 'show'])->name('video.show');

// Authentication
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'login'])->middleware('guest');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::feeds();
