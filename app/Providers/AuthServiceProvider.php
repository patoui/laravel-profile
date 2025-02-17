<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     */
    public function boot() : void
    {
        $this->registerPolicies();

        Gate::define('profile.show', 'App\Policies\ProfilePolicy@show');

        Gate::define('post.create', 'App\Policies\PostPolicy@create');
        Gate::define('post.edit', 'App\Policies\PostPolicy@edit');
        Gate::define('post.store', 'App\Policies\PostPolicy@store');
        Gate::define('post.update', 'App\Policies\PostPolicy@update');
        Gate::define('post.delete', 'App\Policies\PostPolicy@delete');
        Gate::define('post.publish', 'App\Policies\PostPublishPolicy@publish');

        Gate::define('tip.create', 'App\Policies\TipPolicy@create');
        Gate::define('tip.edit', 'App\Policies\TipPolicy@edit');
        Gate::define('tip.store', 'App\Policies\TipPolicy@store');
        Gate::define('tip.update', 'App\Policies\TipPolicy@update');
        Gate::define('tip.delete', 'App\Policies\TipPolicy@delete');
        Gate::define('tip.publish', 'App\Policies\TipPublishPolicy@publish');

        Gate::define('video.create', 'App\Policies\VideoPolicy@create');
        Gate::define('video.store', 'App\Policies\VideoPolicy@store');
        Gate::define('video.edit', 'App\Policies\VideoPolicy@edit');
        Gate::define('video.update', 'App\Policies\VideoPolicy@update');
        Gate::define('video.publish', 'App\Policies\VideoPublishPolicy@publish');

        Gate::define('dashboard.index', 'App\Policies\DashboardPolicy@index');
    }
}
