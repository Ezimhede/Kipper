<?php

namespace App\Console;

use Carbon\Traits\Timestamp;
use Date;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // Send out an email notification at the due date
        $schedule->call(function () {
            $items = DB::table('items')->get();
            foreach ($items as $item) {
                if ($item->notification >= 5) {
                    $fileName = $item->name;
                    $currentTime = date("H:i:s a");
                    $file = fopen($fileName.'.txt', "a+");
                    fwrite($file, $currentTime);
                    fclose($file);
                }
            }

//            $num = 4;
//            if($num >0){
//                $file = fopen("test.txt", "w");
//                fwrite($file, "12345");
//                fclose($file);
//            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
