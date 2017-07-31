<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();

        $this->mapAdminRoutes();
<<<<<<< HEAD

        $this->mapApiRoutes();
=======
>>>>>>> 3a0c01ef73d743daf9c9606e4add0a09287175c2
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "admin" routes for the application.
     *
<<<<<<< HEAD
     * These routes all receive session state, CSRF protection, Authentication.
=======
     * These routes all receive session state, CSRF protection, etc.
>>>>>>> 3a0c01ef73d743daf9c9606e4add0a09287175c2
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::group([
<<<<<<< HEAD
            'middleware' => 'admin',
=======
            'middleware' => 'web',
>>>>>>> 3a0c01ef73d743daf9c9606e4add0a09287175c2
            'namespace' => $this->namespace . '\Admin',
            'prefix' => 'admin',
        ], function ($router) {
            require base_path('routes/admin.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
