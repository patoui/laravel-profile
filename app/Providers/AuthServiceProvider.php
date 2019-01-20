<?php

namespace App\Providers;

use App\Policies\DashboardPolicy;
use App\Policies\MediaPolicy;
use App\Policies\PostPolicy;
use App\Policies\PostPublishPolicy;
use App\Post;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('profile.show', 'App\Policies\ProfilePolicy@show');
        Gate::define('post.create', 'App\Policies\PostPolicy@create');
        Gate::define('post.edit', 'App\Policies\PostPolicy@edit');
        Gate::define('post.store', 'App\Policies\PostPolicy@store');
        Gate::define('post.update', 'App\Policies\PostPolicy@update');
        Gate::define('post.delete', 'App\Policies\PostPolicy@delete');
        Gate::define('post.publish', 'App\Policies\PostPublishPolicy@publish');
        Gate::define('dashboard.index', 'App\Policies\DashboardPolicy@index');
        Gate::define('media.index', 'App\Policies\MediaPolicy@index');
        Gate::define('media.create', 'App\Policies\MediaPolicy@create');
        Gate::define('media.edit', 'App\Policies\MediaPolicy@edit');
        Gate::define('media.store', 'App\Policies\MediaPolicy@store');
        Gate::define('media.update', 'App\Policies\MediaPolicy@update');
        Gate::define('media.delete', 'App\Policies\MediaPolicy@delete');
        Gate::define('sms.index', 'App\Policies\SmsPolicy@index');
        Gate::define('sms.store', 'App\Policies\SmsPolicy@store');
    }
}
