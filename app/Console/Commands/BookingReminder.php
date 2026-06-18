<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EventBooking;
use Carbon\Carbon;

class BookingReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminding User of their booking';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    // public function handle()
    // {
    //     return 0;
    // }
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();
        $eventbooking = EventBooking::select('eventsbooking.*')
            ->orderBy('id', 'DESC')
            ->where('recurring_until',$tomorrow)
            ->get();

        foreach($eventbooking as $eb){
            // $dateofbook = Carbon::$userdate()->toDateString();
            // $records = EventBooking::select('eventsbooking.*')
            // ->orderBy('id', 'DESC')
            // ->where('id', $eb->id)
            // ->get();

                if($tomorrow == $eb->recurring_until){

                    // Whatsapp API Start
                    $data = [
                    'phone' =>  "+673".$records->tel_no, // Receivers phone
                    'template' => 'onss', // Template name
                    'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
                    'language' =>  ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
                ];

                $json = json_encode($data); // Encode data to JSON
                // URL for request POST /message
                $token = '7hpe9bwi2bl1k5ja';
                $instanceId = '448643';
                $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
                // Make a POST request
                $options = stream_context_create(['http' => [
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/json',
                        'content' => $json
                    ]
                ]);
                // Send a request
                $result = file_get_contents($url, false, $options);
                //Whatsapp API End
            }
        }
        

    }
}
