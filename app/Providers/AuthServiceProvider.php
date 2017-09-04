<?php

namespace App\Providers;

use App\Post;
use App\Policies\PostPolicy;
use App\Policies\PostPublishPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('post.create', 'App\Policies\PostPolicy@create');
        Gate::define('post.edit', 'App\Policies\PostPolicy@edit');
        Gate::define('post.store', 'App\Policies\PostPolicy@store');
        Gate::define('post.update', 'App\Policies\PostPolicy@update');
        Gate::define('post.delete', 'App\Policies\PostPolicy@delete');
        Gate::define('post.publish', 'App\Policies\PostPublishPolicy@publish');
        Gate::define('dashboard-index', function ($user) {
            return $user->isAdmin();
        });
    }
}
