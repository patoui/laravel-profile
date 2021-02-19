<?php

declare(strict_types=1);

namespace App\Console;

use App\Console\Commands\MigrateAnalytics;
use App\Jobs\ProcessCovid19;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use function base_path;

class Kernel extends ConsoleKernel
{
    /** @var array<string> */
    protected $commands = [
        MigrateAnalytics::class,
    ];

    /**
     * Define the application's command schedule.
     * @param Schedule $schedule
     */
    protected function schedule(Schedule $schedule) : void
    {
         $schedule->job(new ProcessCovid19)->twiceDaily(0, 6);
         $schedule->job(new ProcessCovid19)->twiceDaily(12, 18);
    }

    /**
     * Register the Closure based commands for the application.
     */
    protected function commands() : void
    {
        require base_path('routes/console.php');
    }
}
