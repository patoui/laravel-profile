<?php

declare(strict_types=1);

namespace App\Providers;

use App\Database\ClickhouseConnection;
use ClickHouseDB\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
    }

    public function register() : void
    {
        $this->app->bind(Client::class, static function () {
            return ClickhouseConnection::create()->getClient();
        });
    }
}
