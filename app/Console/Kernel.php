<?php

namespace App\Console;

use App\Mail\Subscribe;
use Carbon\Traits\Timestamp;
use Date;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

        // Send out an email notification once the notification date has reached
        $schedule->call(function () {
            $items = DB::table('items')->get();

            foreach ($items as $item) {
//                if ($item->notification >= 5) {
//                    $fileName = $item->name;
//                    $currentTime = date("H:i:s a");
//                    $file = fopen($fileName.'.txt', "a+");
//                    fwrite($file, $currentTime);
//                    fclose($file);
//                }

                var_dump(date(now()->toDateString()));
                var_dump($item -> notification_date);
                $numb = 6;
                if ((date(now()->toDateString())) > ($item -> notification_date)) {
                    $userEmail = DB::table('users')
                                ->where('id', '=','$item->user_id')
                                ->select('email')
                                ->get();

                    foreach ($userEmail as $email) {
                        var_dump($email->email);

                    }
//                    Mail::to($userEmail)->send(new Subscribe());
                }
            }
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
