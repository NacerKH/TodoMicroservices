<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    { 
        $schedule->command('tasks:listen');
      
        if (! app()->environment('production')) {

            info('here  Process Queue ');
            
            $schedule->command('queue:work redis --queue=default --sleep=3 --tries=3 ');
        }
        else {
            $schedule->command('queue:work --tries=1')->dailyAt('19:00');
        }
       
      
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
