<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [ Commands\BookingReminder::class
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
        // $schedule->command('inspire')->hourly();
		// $now = Carbon::now();
		
		// $condition = DB::table('mileages')
		// 		  ->select('mileage_status_id')
		// 		  ->where('mileage_status_id', '11')
		// 		  ->get();
		
		// if($condition == null)
		// {
			
		// 	$schedule->job(new SendEmailJob)->everyTwoMinutes();	
		// }
		// else {
		// 	   $schedule->command('report:generate')
  //        ->daily()
  //        ->emailOutputOnFailure('alhafiz.hamidi@moe.gov.bn');
		// }
  //   }

        //ROOM BOOKING COMMAND (18/05/23) HRMD(RR)
        $schedule->command('booking:reminder')->everyMinute();
        // Check the documentation for available timings!
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
