<?php

namespace App\Console;

use App\Notifications\CertificateExpiring;
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
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function () {
            $certificates = \App\Certificate::all();

            foreach ($certificates as $key => $certificate) {
                $expiration = date_create($certificate['expiration']);
                $today = date_create("2016-10-07 16:10:00");
                $diff = date_diff($today,$expiration);

                if ($diff->format("%a") < 374) {
                    $certificate->notify(new CertificateExpiring($certificate));
                }
            }  
        })->everyTenMinutes();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
