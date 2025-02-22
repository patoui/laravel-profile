<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

final class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Str::macro('short', function (string $value): string {
            return Str::of($value)
                ->stripTags()
                ->replaceMatches("/(\r?\n){2,}/", ' ')
                ->replaceMatches('/[^\da-z ]/i', '')
                ->trim()
                ->substr(0, 100)
                ->value();
        });
    }

    public function register(): void
    {
        // intentionally left empty
    }
}
