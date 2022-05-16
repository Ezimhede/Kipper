<?php

namespace App\Console;

use App\Mail\Subscribe;
use App\Models\Item;
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
            $items = Item::all()->where("isNotified", "false"); //get all items that haven't been sent notification

            foreach ($items as $item) {
                if ((date(now()->toDateString())) > ($item->notification_date)) {
                    $user = DB::table('users')
                        ->where('id', '=', $item->user_id)
                        ->get()->first();

                    Mail::to($user->email)->send(new Subscribe($user->firstName, $item->name, $item->expiry_date)); //send email to user

                    $item->isNotified = true;
                    $item->save();
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
