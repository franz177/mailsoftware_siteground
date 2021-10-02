<?php

namespace App\Console;

use App\Jobs\ArtisanQueueWorkJob;
use App\Jobs\BookingSincronizationJob;
use App\Jobs\GetTypoBookingsJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new GetTypoBookingsJob)->everyMinute();
        $schedule->job(new ArtisanQueueWorkJob())->everyMinute();
//        $schedule->command('queue:work', ['--sleep' => 3])->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
