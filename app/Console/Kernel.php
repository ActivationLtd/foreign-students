<?php

namespace App\Console;

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
        $schedule->command('telescope:prune')->hourly();
        $schedule->command('cache:clear')->hourly();
        $schedule->command('mainframe:clean-deleted-uploads')->daily();
        $schedule->command('mainframe:clean-temp')->daily();
        $schedule->command('command:send-application-summary-email')->dailyAt('9');
        $schedule->command('command:update-session-status')->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        /*
         * You can load project specific command directories here.
         * Load commands from mainframe and project
         */
        $this->load(app_path('Projects/'.project().'/Commands'));

        require base_path('routes/console.php');
    }
}
