<?php

namespace App\Jobs;

use App\Covid19;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCovid19 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $retryAfter = 10;
    public int $tries      = 3;

    public function handle(): void
    {
        (new Covid19())->process(true);
    }

    public function failed(Exception $exception): void
    {
        (new Covid19())->process(false);
    }
}
