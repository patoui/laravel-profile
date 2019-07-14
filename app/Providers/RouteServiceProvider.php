<?php

declare(strict_types=1);

namespace App\Providers;

use App\Post;
use App\Tip;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use function abort;
use function base_path;

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
     * Define the routes for the application.
     */
    public function map() : void
    {
        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapApiRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes() : void
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], static function ($router) : void {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapAdminRoutes() : void
    {
        Route::group([
            'middleware' => 'admin',
            'namespace' => $this->namespace . '\Admin',
            'prefix' => 'admin',
        ], static function (Router $router) : void {
            $router->bind('post', static function (int $id) {
                $post = Post::find($id);
                abort_if(! $post, 404);
                return  $post;
            });
            $router->bind('tip', static function (int $id) {
                $tip = Tip::find($id);
                abort_if(! $tip, 404);
                return $tip;
            });
            require base_path('routes/admin.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes() : void
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], static function ($router) : void {
            require base_path('routes/api.php');
        });
    }
}
