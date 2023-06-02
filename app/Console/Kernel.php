<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\RoomChat;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // versi 1, umur room chat berkisar antara 0 - 6 jamn
        // $schedule->call(function () {
        //     RoomChat::where('status', 'active')->update(['status' => 'ended']);
        // })->everySixHours();

        // versi 2, umur room chat sekitar 6 - 7 jam
        $schedule->call(function () {
            $sixHoursAgo = Carbon::now()->subHours(6);
            RoomChat::where('status', 'ready')->where('created_at', '<=', $sixHoursAgo)->update(['status' => 'ended']);
        })->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
