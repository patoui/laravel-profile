<?php

namespace App\Jobs;

use App\Covid19;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class ProcessCovid19 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $retryAfter = 10;
    public int $tries      = 3;

    public function handle(): void
    {
        set_time_limit(1800);
        (new Covid19())->process(true);
    }

    public function failed(Exception $exception): void
    {
        $last_slug = Cache::get('covid19_last_country_slug');
        if ($last_slug) {
            set_time_limit(1800);
            (new Covid19())->process(true, $last_slug);
        }
    }
}
