<?php

namespace App\Providers;

use App\Post;
use App\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('development', 'local', 'dusk', 'testing')) {
            $this->app->register(\Laravel\Dusk\DuskServiceProvider::class);
        }
        if ($this->app->environment('dusk', 'testing')) {
            $this->app->register(\PatOui\Scout\TestingScoutServiceProvider::class);
        }
    }
}
