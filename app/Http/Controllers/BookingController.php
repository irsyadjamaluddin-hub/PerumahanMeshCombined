<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingMeetingRoom;
use App\Models\Department;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\BookingAdditional;
use App\Http\Controllers\DateTime;

class BookingController extends Controller
{
    public function home()
    {
        $department = Department::select('departments.*')
        ->get();
       
        $bookings = Booking::select('bookingsystem.*')
            ->orderBy('updated_at', 'DESC') 
            ->get();

        $booking1 = Booking::where('room_no', '1')
        ->orderBy('updated_at', 'DESC')
        ->first();

        $booking2 = Booking::where('room_no', '2')
        ->orderBy('updated_at', 'DESC')
        ->first();
        
        $booking3 = Booking::where('room_no', '3')
        ->orderBy('updated_at', 'DESC')
        ->first();

        $booking4 = Booking::where('room_no', '4')
        ->orderBy('updated_at', 'DESC')
        ->first();

        $booking5 = Booking::where('room_no', '5')
        ->orderBy('updated_at', 'DESC')
        ->first();

        $booking7 = Booking::where('room_no', '7')
        ->orderBy('updated_at', 'DESC')
        ->first();

        $booking6 = Booking::where('room_no', '6')
        ->orderBy('updated_at', 'DESC')
        ->first();

        $today = Carbon::today();

        $currenttime = Carbon::now();

        return view('bookings.roombookingsystem', compact('bookings','booking1', 'booking2','booking3', 'booking4', 'booking5','booking7','booking6','currenttime', 'department','today'));
    }
    
    public function store(Request $request) //Save Button
    {

        $booking1= Booking::where('room_no', $request->room_no)
        ->orderBy('updated_at', 'DESC')
        ->first();

        if(!empty($booking1)){
            if(is_null($booking1->end_time)){
                return redirect()->route('bookings.booking.home')
                ->with('success_message', 'Room has been booked');
            }
        }
        

        $request->validate([
                'name' => 'required'
            ]);
        
        $now = Carbon::now();


        $booking = new Booking;

        $booking->name = $request->name;
        $booking->ic_no = $request->ic_no;
        $booking->nama_pegawai = $request->nama_pegawai;
        $booking->dept = $request->dept;
        $booking->syarikat_jabatan = $request->syarikat_jabatan;
        $booking->room_no = $request->room_no;
        $booking->phone_number = $request->phone_number;
        $booking->que_no = $request->que_no;
        $booking->status = '1';
        $booking->start_time = $now;

        // Save 'Booking' data
        $booking->save();

        if($request->extranameMain != "" || $request->extraic_noMain != ""){
            $additional = new BookingAdditional;

            $additional->extraname = $request->extranameMain;
            $additional->extraic_no = $request->extraic_noMain;
            $additional->name = $booking->name;

            $additional->save();
        } 
        
        // if($request->phone_number != ""){ // Whatsapp API Start $data = [
        // 'phone' =>  "+673".$request->phone_number, // Receivers phone
        // 'template' => 'realsyndmalaystart', // Template name 'namespace' =>
        // '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
        // 'language' =>  ['code' => 'en', 'policy' => 'deterministic'], //
        // Language parameters "params"=>
        // [["type"=>"body","parameters"=>[["type"=>"text","text"=>
        // $request->room_no], ["type"=>"text","text"=> $request->name],
        // ["type"=>"text","text"=> $request->syarikat_jabatan],
        // ["type"=>"text","text"=> $request->nama_pegawai]]]], ];

        //     $json = json_encode($data); // Encode data to JSON // URL for
        //     request POST /message $token = '7hpe9bwi2bl1k5ja'; $instanceId
        //     = '448643'; $url = 'http://moe.proxy.mesh/' . $instanceId
        //     . '/sendTemplate?token=' . $token; // Make a POST request
        //     $options = stream_context_create(['http' => [ 'method'  =>
        //     'POST', 'header'  => 'Content-type: application/json',
        //     'content' => $json ] ]); // Send a request $result =
        //     file_get_contents($url, false, $options); //Whatsapp API End

        // }

        return redirect()->route('bookings.booking.home')
            ->with('success_message', 'New booking record was successfully added!');
    }
    
    public function update($id) //End Time Button
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['end_time' => now()]);
        $booking-> status = '2';

        $booking-> save();

        $book123 = Booking::findOrFail($id)
        ->orderBy('updated_at', 'DESC')
        ->first();

        // // Whatsapp API Start
        // $data = [
        //     'phone' => "+673".$book123->phone_number, // Receivers phone if country code is not included
        //     // 'phone' => $book123->phone_number, //Receiver phone if country code is included
        //     'template' => 'syndmalayend1', // Template name
        //     'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
        //     'language' =>  ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
        //     "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=> $book123->room_no]]]],
        // ];
        
        // $json = json_encode($data); // Encode data to JSON
        // // URL for request POST /message
        // $token = '7hpe9bwi2bl1k5ja';
        // $instanceId = '448643';
        // $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
        // // Make a POST request
        // $options = stream_context_create(['http' => [
        //         'method'  => 'POST',
        //         'header'  => 'Content-type: application/json',
        //         'content' => $json
        //     ]
        // ]);
        // // Send a request
        // $result = file_get_contents($url, false, $options);
        // //Whatsapp API End


        return redirect()->route('bookings.booking.home')
            ->with('success_message', 'Booking record was successfully updated!');
    }
    

//Meeting Room Starts


    public function indexR()
    {
        
        $currentdate = Carbon::now()->format('Y-m-d');

        $displaydate = Carbon::now();
        
        $bookingsys = BookingMeetingRoom::select('bookingsystemmr.*')
            ->orderBy('updated_at', 'DESC') 
            ->get();
        
        $bookingsysdate = BookingMeetingRoom::where ('date_no', $currentdate)
        ->get();

        // $users = User::withCount('tickets')->get();

        $bookingsys1 = BookingMeetingRoom::where('room_no','=' ,'1')
        ->where('date_no','=' ,$currentdate)
        ->orderBy('updated_at', 'DESC')
        ->get()
        ->toArray();

        $bookingsys2 = BookingMeetingRoom::where('room_no','=' ,'2')
        ->where('date_no','=' ,$currentdate)
        ->orderBy('updated_at', 'DESC')
        ->get();

        $bookingsys3 = BookingMeetingRoom::where('room_no','=' ,'5')
        ->where('date_no','=' ,$currentdate)
        ->orderBy('updated_at', 'DESC')
        ->get();

        $bookingsys4 = BookingMeetingRoom::where('room_no','=' ,'6')
        ->where('date_no','=' ,$currentdate)
        ->orderBy('updated_at', 'DESC')
        ->get();

        $bookingsys5 = BookingMeetingRoom::where('room_no','=' ,'MR')
        ->where('date_no','=' ,$currentdate)
        ->orderBy('updated_at', 'DESC')
        ->get();

            
        $bookingmr = BookingMeetingRoom::all();

        
        return view('bookings.indexR', compact('displaydate','bookingsys', 'bookingsysdate','currentdate','bookingsys1','bookingsys2','bookingsys3','bookingsys4','bookingsys5','bookingmr'));
    }

    public function indexRadmin()
    {

        $bookingmr = BookingMeetingRoom::select('bookingsystemmr.*')
            ->orderBy('updated_at', 'DESC') 
            ->get();

        return view('bookings.indexRadmin', compact('bookingmr'));
    }

    public function checkingavailabilityMR(Request $request)
    {

        $request->validate([
            'room_no' => 'required',
            'duration' => 'required',
            'date_no' => 'required'
        ]);

        $bookingmr = new BookingMeetingRoom;

        $currentdate = Carbon::today();
        $tempName = $bookingmr->id;
        $bookingmr->room_no = $request->room_no;
        $bookingmr->duration = $request->duration;
        $bookingmr->date_no = $request->date_no;
        // Save 'Dispatch' data
        $bookingmr->save();

        return redirect()->route('bookings.booking.timeR',$tempName)
            ->with('success_message', 'New booking record was successfully added!');
    }

    public function updateMR(Request $request)
        {
            $request->validate([
                'start_time' => 'required'
            ]);

            $timestate = explode("-",$request->start_time);

            $bkmrdn =  BookingMeetingRoom::select('bookingsystemmr.*')
                ->where('id', $request->id)
                ->orderBy('updated_at', 'DESC')
                ->get();

            $bkmr =  BookingMeetingRoom::select('bookingsystemmr.*')
                ->where('id', $request->id)
                ->update([
                    'start_time'         =>      $timestate[0],
                    'end_time'      =>      $timestate[1]

                ]);

            return redirect()->route('bookings.booking.createR')
                ->with('success_message', 'Booking record was successfully updated!');
        }

    public function storeMR(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);

        $currentdate = Carbon::today();

        $bkmr =  BookingMeetingRoom::select('bookingsystemmr.*')
        ->where('id', $request->id)
        ->update([
            'name' => $request->name,
            'jawatan' => $request->jawatan,
            'dept' => $request->dept,
            'tel_no' => $request->tel_no,
            'agenda' => $request->agenda,
            'anjuran' => $request->anjuran,
            'pengerusi' => $request -> pengerusi,
            'hadir' =>$request->hadir,
            'updated_at' => $request->$currentdate

        ]);

        return redirect()->route('bookings.booking.indexR')
            ->with('success_message', 'New booking record was successfully added!');
    }

   

    public function createR()
    {

        $bookingmraid = BookingMeetingRoom::select('bookingsystemmr.*')
            ->orderBy('updated_at', 'DESC')
            ->get();


        $bookingmraid = BookingMeetingRoom::select('bookingsystemmr.*')
            ->orderBy('updated_at', 'DESC')
            ->first();

        return view('bookings.createR',compact( 'bookingmraid'));
    }

    public function durationMR()
    {
        return view('bookings.durationR');
    }

    public function timeR()
    {

        $bookingmra = BookingMeetingRoom::select('bookingsystemmr.*')
            ->orderBy('updated_at', 'DESC')
            ->first();

        $bookingmra1 = BookingMeetingRoom::select('bookingsystemmr.*')
            ->orderBy('updated_at', 'DESC')
            ->where('room_no', '1')
            ->first();

        $bookingmra2 = BookingMeetingRoom::select('bookingsystemmr.*')
            ->orderBy('updated_at', 'DESC')
            ->where('room_no', '2')
            ->first();

        $bookingmra5 = BookingMeetingRoom::select('bookingsystemmr.*')
            ->orderBy('updated_at', 'DESC')
            ->where('room_no', '5')
            ->first();
        
        $bookingmra6 = BookingMeetingRoom::select('bookingsystemmr.*')
            ->orderBy('updated_at', 'DESC')
            ->where('room_no', '6')
            ->first();

        $bookingmraMR = BookingMeetingRoom::select('bookingsystemmr.*')
            ->orderBy('updated_at', 'DESC')
            ->where('room_no', 'MR')
            ->first(); 

        $bookingsys = BookingMeetingRoom::select('bookingsystemmr.*')
            ->orderBy('updated_at', 'DESC') 
            ->get();

        $tempVarP1 = $bookingmra1->date_no;
        $tempVarP2 = $bookingmra2->date_no;
        $tempVarP5 = $bookingmra5->date_no;
        $tempVarP6 = $bookingmra6->date_no;
        $tempVarMR = $bookingmraMR->date_no;
        

        $durationvalue1 = ($bookingmra1->duration * 60) - (60 * 60);
        $durationvalue2 = ($bookingmra2->duration * 60) - (60 * 60);
        $durationvalue5 = ($bookingmra5->duration * 60) - (60 * 60);
        $durationvalue6 = ($bookingmra6->duration * 60) - (60 * 60);
        $durationvalueMR = ($bookingmraMR->duration * 60) - (60 * 60);

        $duration1 = $bookingmra1->duration;
        $duration2 = $bookingmra2->duration;
        $duration5 = $bookingmra5->duration;
        $duration6 = $bookingmra6->duration;
        $durationMR = $bookingmraMR->duration;


        $otherbookings1 = BookingMeetingRoom::select('bookingsystemmr.*')
        ->where('date_no', $tempVarP1)
        ->where('room_no','1')
        ->get();

        $otherbookings2 = BookingMeetingRoom::select('bookingsystemmr.*')
        ->where('date_no', $tempVarP2)
        ->where('room_no','2')
        ->get();

        $otherbookings5 = BookingMeetingRoom::select('bookingsystemmr.*')
        ->where('date_no', $tempVarP5)
        ->where('room_no','5')
        ->get();

        $otherbookings6 = BookingMeetingRoom::select('bookingsystemmr.*')
        ->where('date_no', $tempVarP6)
        ->where('room_no','6')
        ->get();
        
        $otherbookingsMR = BookingMeetingRoom::select('bookingsystemmr.*')
        ->where('date_no', $tempVarMR)
        ->where('room_no','MR')
        ->get();


        //Start of P1

        // $oriTime = $otherbookings->where('start_time', '')->first();

        // $duration = '60';  // split by 30 mins
        $add_mins  = 60 * 60;

        $timeStartP1 = array();
        $timeStartP1[0] = "07:00";
        $timeStartP1[1] = "08:00";
        $timeStartP1[2] = "09:00";
        $timeStartP1[3] = "10:00";
        $timeStartP1[4] = "11:00";
        $timeStartP1[5] = "12:00";
        $timeStartP1[6] = "01:00";
        $timeStartP1[7] = "02:00";
        $timeStartP1[8] = "03:00";
        $timeStartP1[9] = "04:00";
        

        //Get array of time for whole booked sessions on current date.
        $new_array_of_time = array ();
        foreach($otherbookings1 as $testVal1){


                  //duration counter to be used to minus with start time.
                //if duration to set how much needs to be minus.
                $starttime = $testVal1->start_time;  // your start time
                $endtime = $testVal1->end_time;  // End time

            //


            $array_of_time = array ();  //temp value to store time.
            $start_time    = strtotime ($starttime); //change to strtotime
            $end_time      = strtotime ($endtime); //change to strtotime

            $start_time -= $durationvalue1;

            while ($start_time <= $end_time) // loop between time
            {
                $array_of_time[] = date ("h:i", $start_time);
                $start_time += $add_mins; // to check endtime
            }

            for($j = 0; $j < count($timeStartP1); $j++){
                for($i = 0; $i < count($array_of_time) - 1; $i++)
                {
                    if(in_array($array_of_time[$i],$new_array_of_time)){
                        //do nothing
                    }else{
                        $new_array_of_time[] = '' . $array_of_time[$i];
                    }
                }
                if(in_array($timeStartP1[$j],$new_array_of_time)){
                    $timeStartP1[$j] = "";
                }
            }
        }

        array_values($timeStartP1);
        
        //End of P1

        //Start of P2

    
        $add_mins2  = 60 * 60;

        $timeStartP2 = array();
        $timeStartP2[0] = "07:00";
        $timeStartP2[1] = "08:00";
        $timeStartP2[2] = "09:00";
        $timeStartP2[3] = "10:00";
        $timeStartP2[4] = "11:00";
        $timeStartP2[5] = "12:00";
        $timeStartP2[6] = "01:00";
        $timeStartP2[7] = "02:00";
        $timeStartP2[8] = "03:00";
        $timeStartP2[9] = "04:00";
        

        //Get array of time for whole booked sessions on current date.
        $new_array_of_time2 = array ();
        foreach($otherbookings2 as $testVal2){


                  //duration counter to be used to minus with start time.
                //if duration to set how much needs to be minus.
                $starttime2 = $testVal2->start_time;  // your start time
                $endtime2 = $testVal2->end_time;  // End time

            //


            $array_of_time2 = array ();  //temp value to store time.
            $start_time2    = strtotime ($starttime2); //change to strtotime
            $end_time2      = strtotime ($endtime2); //change to strtotime

            $start_time2 -= $durationvalue2;

            while ($start_time2 <= $end_time2) // loop between time
            {
                $array_of_time2[] = date ("h:i", $start_time2);
                $start_time2 += $add_mins2; // to check endtime
            }

            for($j = 0; $j < count($timeStartP2); $j++){
                for($i = 0; $i < count($array_of_time2) - 1; $i++)
                {
                    if(in_array($array_of_time2[$i],$new_array_of_time2)){
                        //do nothing
                    }else{
                        $new_array_of_time2[] = '' . $array_of_time2[$i];
                    }
                }
                if(in_array($timeStartP2[$j],$new_array_of_time2)){
                    $timeStartP2[$j] = "";
                }
            }
        }

        array_values($timeStartP2);

        //End of P2

        //Start of P5

        $add_mins5  = 60 * 60;

        $timeStartP5 = array();
        $timeStartP5[0] = "07:00";
        $timeStartP5[1] = "08:00";
        $timeStartP5[2] = "09:00";
        $timeStartP5[3] = "10:00";
        $timeStartP5[4] = "11:00";
        $timeStartP5[5] = "12:00";
        $timeStartP5[6] = "01:00";
        $timeStartP5[7] = "02:00";
        $timeStartP5[8] = "03:00";
        $timeStartP5[9] = "04:00";
        

        //Get array of time for whole booked sessions on current date.
        $new_array_of_time5 = array ();
        foreach($otherbookings5 as $testVal5){


                  //duration counter to be used to minus with start time.
                //if duration to set how much needs to be minus.
                $starttime5 = $testVal5->start_time;  // your start time
                $endtime5 = $testVal5->end_time;  // End time

            //


            $array_of_time5 = array ();  //temp value to store time.
            $start_time5    = strtotime ($starttime5); //change to strtotime
            $end_time5      = strtotime ($endtime5); //change to strtotime

            $start_time5 -= $durationvalue5;

            while ($start_time5 <= $end_time5) // loop between time
            {
                $array_of_time5[] = date ("h:i", $start_time5);
                $start_time5 += $add_mins5; // to check endtime
            }

            for($j = 0; $j < count($timeStartP5); $j++){
                for($i = 0; $i < count($array_of_time5) - 1; $i++)
                {
                    if(in_array($array_of_time5[$i],$new_array_of_time5)){
                        //do nothing
                    }else{
                        $new_array_of_time5[] = '' . $array_of_time5[$i];
                    }
                }
                if(in_array($timeStartP5[$j],$new_array_of_time5)){
                    $timeStartP5[$j] = "";
                }
            }
        }

        array_values($timeStartP5);

        //End of P5

        //Start of P6

        $add_mins6  = 60 * 60;

        $timeStartP6 = array();
        $timeStartP6[0] = "07:00";
        $timeStartP6[1] = "08:00";
        $timeStartP6[2] = "09:00";
        $timeStartP6[3] = "10:00";
        $timeStartP6[4] = "11:00";
        $timeStartP6[5] = "12:00";
        $timeStartP6[6] = "01:00";
        $timeStartP6[7] = "02:00";
        $timeStartP6[8] = "03:00";
        $timeStartP6[9] = "04:00";
        

        //Get array of time for whole booked sessions on current date.
        $new_array_of_time6 = array ();
        foreach($otherbookings6 as $testVal6){


                  //duration counter to be used to minus with start time.
                //if duration to set how much needs to be minus.
                $starttime6 = $testVal6->start_time;  // your start time
                $endtime6 = $testVal6->end_time;  // End time

            //


            $array_of_time6 = array ();  //temp value to store time.
            $start_time6    = strtotime ($starttime6); //change to strtotime
            $end_time6      = strtotime ($endtime6); //change to strtotime

            $start_time6 -= $durationvalue6;

            while ($start_time6 <= $end_time6) // loop between time
            {
                $array_of_time6[] = date ("h:i", $start_time6);
                $start_time6 += $add_mins6; // to check endtime
            }

            for($j = 0; $j < count($timeStartP6); $j++){
                for($i = 0; $i < count($array_of_time6) - 1; $i++)
                {
                    if(in_array($array_of_time6[$i],$new_array_of_time6)){
                        //do nothing
                    }else{
                        $new_array_of_time6[] = '' . $array_of_time6[$i];
                    }
                }
                if(in_array($timeStartP6[$j],$new_array_of_time6)){
                    $timeStartP6[$j] = "";
                }
            }
        }

        array_values($timeStartP6);

        //End of P6

        //Start of MR

        $add_minsMR  = 60 * 60;

        $timeStartMR = array();
        $timeStartMR[0] = "07:00";
        $timeStartMR[1] = "08:00";
        $timeStartMR[2] = "09:00";
        $timeStartMR[3] = "10:00";
        $timeStartMR[4] = "11:00";
        $timeStartMR[5] = "12:00";
        $timeStartMR[6] = "01:00";
        $timeStartMR[7] = "02:00";
        $timeStartMR[8] = "03:00";
        $timeStartMR[9] = "04:00";
        

        //Get array of time for whole booked sessions on current date.
        $new_array_of_timeMR = array ();
        foreach($otherbookingsMR as $testValMR){


                  //duration counter to be used to minus with start time.
                //if duration to set how much needs to be minus.
                $starttimeMR = $testValMR->start_time;  // your start time
                $endtimeMR = $testValMR->end_time;  // End time

            //


            $array_of_timeMR = array ();  //temp value to store time.
            $start_timeMR    = strtotime ($starttimeMR); //change to strtotime
            $end_timeMR      = strtotime ($endtimeMR); //change to strtotime

            $start_timeMR -= $durationvalueMR;

            while ($start_timeMR <= $end_timeMR) // loop between time
            {
                $array_of_timeMR[] = date ("h:i", $start_timeMR);
                $start_timeMR += $add_minsMR; // to check endtime
            }

            for($j = 0; $j < count($timeStartMR); $j++){
                for($i = 0; $i < count($array_of_timeMR) - 1; $i++)
                {
                    if(in_array($array_of_timeMR[$i],$new_array_of_timeMR)){
                        //do nothing
                    }else{
                        $new_array_of_timeMR[] = '' . $array_of_timeMR[$i];
                    }
                }
                if(in_array($timeStartMR[$j],$new_array_of_timeMR)){
                    $timeStartMR[$j] = "";
                }
            }
        }

        array_values($timeStartMR);

        //End of MR
        
        $now = Carbon::now();

        return view('bookings.timeR',compact('bookingmra','bookingsys','timeStartP1','timeStartP2', 'timeStartP5', 'timeStartP6', 'timeStartMR','duration1','duration2','duration5','duration6','durationMR'));
    }

    public function destroy($id)
    {
        try {            

            $bookingmra = BookingMeetingRoom::where('id', $id)->delete();

            return redirect()->route('bookings.booking.indexR')
                             ->with('success_message', 'Booking was successfully Delete!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroyAdmin($id)
    {
        try {

            $bookingchat = BookingMeetingRoom::findOrFail($id)
                ->orderBy('updated_at', 'DESC')
                ->first();

            $booking =  BookingMeetingRoom::select('bookingsystemmr.*')
                ->where('id', $id)
                ->update([
                        'remarks'       =>        'The Booking has been canceled by the admin. For futher information please contact admin.',
                    ]);

                    // if($bookingchat->phone_number != ""){
                    //     // Whatsapp API Start
                    //     $data = [
                    //         'phone' =>  "+673".$bookingchat->phone_number, // Receivers phone
                    //         'template' => 'syndmalaystart1', // Template name
                    //         'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
                    //         'language' =>  ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
                    //         "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=> $request->room_no], ["type"=>"text","text"=> $request->name], ["type"=>"text","text"=> $request->syarikat_jabatan], ["type"=>"text","text"=> $now->toDateString('d-m-y')], ["type"=>"text","text"=> $request->que_no], ["type"=>"text","text"=> $request->nama_pegawai]]]],
                    //     ];
            
                    //     $json = json_encode($data); // Encode data to JSON
                    //     // URL for request POST /message
                    //     $token = '7hpe9bwi2bl1k5ja';
                    //     $instanceId = '448643';
                    //     $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
                    //     // Make a POST request
                    //     $options = stream_context_create(['http' => [
                    //             'method'  => 'POST',
                    //             'header'  => 'Content-type: application/json',
                    //             'content' => $json
                    //         ]
                    //     ]);
                    //     // Send a request
                    //     $result = file_get_contents($url, false, $options);
                    //     //Whatsapp API End
            
                    // }

            $bookingmra = BookingMeetingRoom::where('id', $id)->delete();

            return redirect()->route('bookings.booking.indexRAdmin')
                             ->with('success_message', 'Booking was successfully canceled!');
                             
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function view($id)
    {

        $bookingmra = BookingMeetingRoom::all()
            ->where('id', '=', $id);

        return view('bookings.view', compact('bookingmra'));
    }

    public function edit($id)
    {

        $bookingmra = BookingMeetingRoom::all()
            ->where('id', '=', $id);

        return view('bookings.edit', compact('bookingmra'));
    }


    public function verifyMR($id)
    {
        $bookingmr = BookingMeetingRoom::findOrFail($id);
        $bookingmr->update(['booking_recieved_at' => now()]);

        return redirect()->route('bookings.booking.indexRadmin')
            ->with('success_message', 'Booking Recieved successfully');
    }
    
    public function updateOverride(Request $request)
    {
        $today = Carbon::today();

        $booking =  BookingMeetingRoom::select('bookingsystemmr.*')
        ->where('id', $request->id)
            ->update([
                'name'         =>      $request->name,
                'dept'      =>      $request->dept,
                'tel_no'      =>      $request->tel_no,
                'agenda'      =>      $request->agenda,
                'date_no'      =>      $request->date_no,
                'hadir'      =>      $request->hadir,
                'anjuran'      =>      $request->anjuran,
                'jawatan'      =>      $request->jawatan,
                'pengerusi'      =>      $request->pengerusi,
                'remarks'       =>        $request->remakrs,
                'updated_at'    =>          $today
            ]);


        return redirect()->route('bookings.booking.indexRAdmin')
            ->with('success_message', 'Booking record was successfully updated!');

        
          
    }

    

    
}
