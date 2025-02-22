<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

use function base_path;

final class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        $this->mapWebRoutes();
        $this->mapAdminRoutes();
    }

    protected function mapWebRoutes(): void
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], static function ($router): void {
            require base_path('routes/web.php');
        });
    }

    protected function mapAdminRoutes(): void
    {
        Route::group([
            'middleware' => 'admin',
            'namespace' => $this->namespace . '\Admin',
            'prefix' => 'admin',
        ], static function (Router $router): void {
            require base_path('routes/admin.php');
        });
    }
}
