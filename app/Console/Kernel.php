<?php

declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use function base_path;

class Kernel extends ConsoleKernel
{
    /** @var array<string> */
    protected $commands = [];

    /**
     * Define the application's command schedule.
     * @param Schedule $schedule
     */
    protected function schedule(Schedule $schedule) : void
    {
        // intentionally left empty
    }
}
