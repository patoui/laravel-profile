<?php

namespace App\Providers;

use App\Post;
use App\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Post::observe(PostObserver::class);
    }

    public function register()
    {
        //
    }
}
