<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Perkaraevent;
use App\Models\Jawatanlist;
use App\Models\Moeevent;
use App\Models\MoeeventExport;
use App\Models\MoeeventExportRatingList;
use App\Models\MoeeventExportRatingList2;

use App\Models\Employment;
use App\Models\Biodata;
use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// Export Excel - Fira
use App\Exports\ExportExcel; // Import your export class
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet; // Add this import statement
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Mail\MoeEventRegistered;
use App\Mail\MoeEventApproved;
use App\Mail\MoeEventRejected;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

//Added by Amal 'Izzah (PB)

use App\Http\storeRate;

use Mail;



use Illuminate\Support\Facades\Auth;
// Added by Wanie 250124
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Endroid\QrCode\QrCodeInterface;
use ZipArchive;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Http\Controllers\View;

//use for captchha
use Illuminate\Support\Facades\Session;




class MoeeventController extends Controller
{

       public function moeeventlink()
    {
        $perkaraevent = Perkaraevent::pluck('eventlabel','id')->all();
    
    
        return view('moeeventlink', compact('perkaraevent'));
    }
      public function search(Request $request)
    {
        $event = $request->input('event');
        $icno = $request->input('icno');

        // Perform the search query on your model
        $results = Moeevent::where('event', $event)
                            ->where('icno', $icno)
                            ->get();

      

        $perkaraevent = Perkaraevent::pluck('eventlabel','id')->all();


        return view('moeeventlinksearch', compact('results','perkaraevent'));
    }



   
//Added by Amal 'Izzah (PB)

public function rating($event_id)
{
    $departments = Department::pluck('label', 'id')->all();
    $perkaraevent = Perkaraevent::find($event_id); // Use find instead of where->pluck->first
    $jawatanlist = Jawatanlist::pluck('label', 'id')->all();

    return view('rating', compact('departments', 'perkaraevent', 'jawatanlist', 'event_id'));
}

public function ratingopenform()
{
    $departments = Department::pluck('label', 'id')->all();
    $perkaraevent = Perkaraevent::pluck('eventlabel', 'id')->all();
    $jawatanlist = Jawatanlist::pluck('label', 'id')->all();

    return view('ratingopenform', compact('departments', 'perkaraevent', 'jawatanlist'));
}

public function openform()
{
    
   // Generate a random number for the question
   $correctAnswer = rand(6,10);
    
   // Create a set of random numbers for the grid
   $numbers = range(6,10);
   shuffle($numbers); // Shuffle to randomize the display

   // Create a question
   $captchaQuestion = "Please select the number: " . $correctAnswer;


    $departments = Department::pluck('label', 'id')->all();
    $perkaraevents = Perkaraevent::pluck('eventlabel','id')->all();
    $jawatanlist = Jawatanlist::pluck('label','id')->all();

    // Convert the collection to an array
    $perkaraevent = Perkaraevent::all()->toArray();

    return view('moeevent', compact('departments', 'perkaraevent', 'jawatanlist','numbers', 'captchaQuestion', 'correctAnswer'));
}



public function store(Request $request)
{

   

    $request->validate([
    'event' => 'required',
    'jabatan' => 'required',
    'jawatan' => 'required_without:jawatan_lain|string', // jawatan is required unless jawatan_lain is provided
    'jawatan_lain' => 'nullable|string|required_if:jawatan,',
    'nama' => 'required',
    'bhg' => 'required',
    'icno' => 'required|digits:8',
    'no_tel' => 'required',
  
//    'email' => 'required|email',


]);


  // Determine the value for jawatan
  $jawatan = $request->input('jawatan');  // Default to jawatan from dropdown
  if ($request->has('jawatan_lain') && !empty($request->jawatan_lain)) {
      $jawatan = $request->input('jawatan_lain');  // Use jawatan_lain if checkbox is checked and input is provided
  }


    $moeevent = new Moeevent;
    $moeevent->event = $request->event;
    $moeevent->jabatan = $request->jabatan;
    $moeevent->bhg = $request->bhg;
    $moeevent->jawatan = $jawatan;
    $moeevent->nama = $request->nama;
    $moeevent->icno = $request->icno;
    $moeevent->gender = $request->gender;
    $moeevent->no_tel = $request->no_tel;
    $moeevent->email = $request->email;    

    // Save data
    $moeevent-> save();

 
    
    $notf_userEmail = $request->email;
    $notf_Nama = $request->nama;
    $notf_jabatan = $request->jabatan;

    // Added by Amal 'Izzah (PB)
    $notf_tel = $request->no_tel;
    $notf_EventDate = Perkaraevent::where('id', $request->event)->value('eventdate');

    // Convert the date to the desired format
    $notf_EventDate = date('d-m-Y', strtotime($notf_EventDate));

    $notf_EventVenue = Perkaraevent::where('id', $request->event)->value('eventvenue');

    $notf_EventTime = Perkaraevent::where('id', $request->event)->value('eventtime');
    $notf_EventLabel = Perkaraevent::where('id', $request->event)->value('eventlabel');

    if($notf_userEmail != null){
	    Mail::to($notf_userEmail)->send(new MoeEventRegistered($notf_Nama, $notf_EventLabel, $notf_jabatan, $notf_EventDate, $notf_EventTime, $notf_EventVenue, $notf_tel));
    }
   

    $this->sendWhatsAppMessagesRegisterMoeEvent($notf_tel, $notf_Nama, $notf_jabatan, $notf_EventLabel, $notf_EventTime, $notf_EventDate, $notf_EventVenue);


    return redirect()->route('moeevent')
            ->with('success_message', 'Permohonan telah berjaya dihantar');

}

private function sendWhatsAppMessagesRegisterMoeEvent($telMobilesubdc, $notf_Nama, $notf_jabatan, $notf_EventLabel, $notf_EventTime, $notf_EventDate, $notf_EventVenue)
{
    // Adjust the parameters according to your template and use case
    $data = [
        'phone' => "+673" . $telMobilesubdc,
        'template' => 'ons_event_reg',
        'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
        'language' => ['code' => 'ms', 'policy' => 'deterministic'],
        "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $notf_Nama], ["type" => "text", "text" => $notf_jabatan], ["type" => "text", "text" => $notf_EventLabel], ["type" => "text", "text" => $notf_EventVenue], ["type" => "text", "text" => $notf_EventDate], ["type" => "text", "text" => $notf_EventTime]]]],
    ];

    $json = json_encode($data);
    $token = '7hpe9bwi2bl1k5ja';
    $instanceId = '448643';
    $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
    $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
    $result = file_get_contents($url, false, $options);

    // Handle the result if needed
    // For example, you can log the result or perform other actions based on the response
}

//Added by Amal 'Izzah (PB)

public function storeRate(Request $request)
{
    // Validate the request and store the rating information based on $event_id
    $request->validate([
        // Your validation rules here
    ]);

    $rate = new Rating;
    $rate->event = $request->event;
    $rate->jabatan = $request->jabatan;
    $rate->rating1 = $request->rating1;
    $rate->rating2 = $request->rating2;
    $rate->rating3 = $request->rating3;
    $rate->feedback = $request->feedback;

    // Save data
    $rate->save();

     return redirect()->back()->with('success_message', 'Thank you for giving us feedback!');

}

public function storeRateopenform(Request $request)
{
    // Validate the request and store the rating information based on $event_id
    $request->validate([
        // Your validation rules here
    ]);

    $rate = new Rating;
    $rate->event = $request->event;
    $rate->jabatan = $request->jabatan;
    $rate->rating1 = $request->rating1;
    $rate->rating2 = $request->rating2;
    $rate->rating3 = $request->rating3;
    $rate->feedback = $request->feedback;

    // Save data
    $rate->save();

    return redirect()->route('ratingopenform')
        ->with('success_message', 'Thank you for giving us feedback!');
}

public function showrating($me)
{
    $event = Perkaraevent::where('id', $me)->first();
    
    $rate = Rating::where('event', $me)->orderBy('rateID')->get();

    $eventid = $me;

    // Define an array of questions
    $questions = [
        'How would you rate the content of the program was effective and increase your knowledge?',
        'How would you rate the delivery of facilitator was well-organised, smooth and met the objectives?',
        'How would you rate this program is relevant to my job level?'
    ];

    // Calculate overall rating for each row
    $totalRatings = [];
    foreach ($rate as $rating) {
        $totalRatings[$rating->rateID] = $this->calculateTotalRating($rating);
    }

    // Calculate average rating for all ratings
    $averageRating = $this->calculateAverageRating($rate);

    // Generate QR Code URL for this event
    $qrCodeUrl = route('rateqrcode', ['event_id' => $me]);

    // Pass questions, ratings, average rating, and other variables to the view
    return view('moeevent.showrating', compact('rate', 'event', 'qrCodeUrl', 'questions', 'totalRatings', 'averageRating', 'eventid'));
}

public function generateRateQrCode($event_id)
{
    $url = route('rating', ['event_id' => $event_id]);
    \QrCode::size(300)->generate($url);

    return view('rateqrcode', compact('url'));
}

private function calculateTotalRating($rating)
{
    return number_format(($rating->rating1 + $rating->rating2 + $rating->rating3)/3, 2);
}

// Function to calculate average rating for all ratings
private function calculateAverageRating($ratings)
{
    $total = 0;
    $count = count($ratings);

    foreach ($ratings as $rating) {
        $total += $this->calculateTotalRating($rating);
    }

    return $count > 0 ? number_format($total / $count, 2) : 0;
}

//====================================================================================================

// start admin side

public function createevent()
{

    $icNos = Auth::user()->ic_no;
    
    $employments = Employment::all()
                    ->where('ic_no', '=', $icNos);

    $biodatas = Biodata::all()
    ->where('ic_no', '=', $icNos);



    return view('moeevent.createevent', compact('employments','biodatas'));
}


// wanie 250124
public function storeevent(Request $request)
{
    $request->validate([/* Your validation rules here */]);

    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();
 
    $perkaraevent = new Perkaraevent;
    $perkaraevent->eventlabel = $request->eventlabel;
    $perkaraevent->eventdate = $request->eventdate;
    $perkaraevent->eventdateend = $request->eventdateend;
    $perkaraevent->eventtime = $request->eventtime;
    $perkaraevent->eventvenue = $request->eventvenue;
    $perkaraevent->icno = $icNos;
    $perkaraevent->jabatan = $request->jabatan;
    $perkaraevent->nama = $request->nama;
    $perkaraevent->created_at = $now;

    // Save data
    $perkaraevent->save();

    return redirect()->route('moeevent.moeevent.indexadmin')
        ->with('success_message', 'New Event Details Succesfully added!');
}

public function updateadmin(Request $request){

    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();    

    $perkaraevent = Perkaraevent::findOrFail($request->id);

    $perkaraevent->update([
        'eventlabel'   => $request->eventlabel,
        'eventdate'    => $request->eventdate,
        'eventdateend'    => $request->eventdateend,
        'eventtime'    => $request->eventtime,
        'eventvenue'   => $request->eventvenue,
        'updated_at'   => $now,
    ]);

    return redirect()->route('moeevent.moeevent.indexadmin')
        ->with('success_message', 'Updated successfully.');
}

public function destroymoeevent($id){
    try {

    $perkaraevent = Perkaraevent::where('id', $id)->delete();

    // $ssmpermohonansalinanicnos = Moeevent::where('event', $id)->delete();

        return redirect()->route('moeevent.moeevent.indexadmin')
            ->with('success_message', 'Event deleted successfully.');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
    }
}

public function destroyregisterlist($id){
    try {
        $moeevent = Moeevent::where('id', $id)->delete();

        return redirect()->back()->with('success_message', 'Registerd list deleted successfully.');
    } catch (Exception $exception) {
        return back()->withInput()->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
    }
}


public function indexadmin()
{

    if (Auth::user()->hasRole('ROLE_SUPERADMIN') ){
        $perkaraevent = Perkaraevent::select('perkaraevent.*')
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('moeevent.indexadmin', compact('perkaraevent'));
        
    }

    if ( Auth::user()->hasRole('ROLE_MOEEVENT')){

        $icNos = Auth::user()->ic_no;

        $employments = Employment::select('emp_employment_infos.*')
                    ->where('ic_no', '=', $icNos)->first();

        $id = $employments->department_id;

        $perkaraevent = Perkaraevent::select('perkaraevent.*')
        ->orderBy('created_at', 'DESC')
        ->where('jabatan', '=', $id)
        ->get();

        return view('moeevent.indexadmin', compact('perkaraevent','employments'));
        
    }


   
}


public function editadmin($id)
{
    
    $perkaraevent = Perkaraevent::all()
        ->where('id', '=', $id);  

    $moeevent = Moeevent::all()
        ->where('event', '=', $id); 

    
    return view('moeevent.editadmin', compact('perkaraevent','moeevent'));
}

public function approveparticipant($id)
{
    
    $moeevent = Moeevent::all()
        ->where('event', '=', $id)
        ->where('status', 'approve'); 

        $events = Perkaraevent::all()
        ->where('id', '=', $id);

    
    return view('moeevent.participant', compact('moeevent', 'events'));
}

// mail for approve user
public function approve($id, Request $request)
{
    $moeevent = Moeevent::findOrFail($id);
    $moeevent->update(['status' => 'approve']);

    $notf_userEmail = $moeevent->email;
    $notf_Nama = $moeevent->nama;
    $notf_jabatan = $moeevent->jabatan;
    
    // Added by Amal 'Izzah (PB)
    $notf_tel = $moeevent->no_tel;
    $notf_EventDate = Perkaraevent::where('id', $moeevent->event)->value('eventdate');

    // Convert the date to the desired format
    $notf_EventDate = date('d-m-Y', strtotime($notf_EventDate));
    
    $notf_EventVenue = Perkaraevent::where('id', $moeevent->event)->value('eventvenue');

    $notf_EventTime = Perkaraevent::where('id', $moeevent->event)->value('eventtime');
    $notf_EventLabel = Perkaraevent::where('id', $moeevent->event)->value('eventlabel');
    $qrcodeid = $moeevent->id;
    
    // Added by Amal 'Izzah (PB)
    Mail::to($notf_userEmail)->send(new MoeEventApproved($notf_Nama,$notf_EventLabel,$notf_jabatan, $notf_EventTime,$notf_EventDate, $notf_EventVenue, $qrcodeid));

     

    // Call the sendWhatsAppMessage function here with the correct method name and parameters
    $this->sendWhatsAppMessagesApproveMoeevent($notf_tel, $notf_Nama, $notf_jabatan, $notf_EventLabel, $notf_EventTime, $notf_EventDate, $notf_EventVenue, $qrcodeid);

    return redirect()->back()->with('success_message', 'The user has been succesfully approved!');
}

private function sendWhatsAppMessagesApproveMoeevent($telMobile, $notf_Nama, $notf_jabatan, $notf_EventLabel, $notf_EventTime, $notf_EventDate, $notf_EventVenue, $qrcodeid)
    {

        // Adjust the parameters according to your template and use case
        $data = [
            'phone' => "+673" . $telMobile,
            'template' => 'ons_event_apr',
            'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
            'language' => ['code' => 'ms', 'policy' => 'deterministic'],                                                
            "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $notf_Nama], ["type" => "text", "text" => $notf_jabatan], ["type" => "text", "text" => $notf_EventLabel], ["type" => "text", "text" => $notf_EventVenue], ["type" => "text", "text" => $notf_EventDate], ["type" => "text", "text" => $notf_EventTime], ["type" => "text", "text" => urlencode($qrcodeid)]]]],
        ];

        $json = json_encode($data);
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
        $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
        $result = file_get_contents($url, false, $options);

        // Handle the result if needed
        // For example, you can log the result or perform other actions based on the response
    }
// End Approve user mail
// ====================================================================================================

// mail for rejected user
public function reject($id)
{
    $moeevent = Moeevent::findOrFail($id);
    $moeevent->update(['status' => 'reject']);
    $notf_userEmail = $moeevent->email;
    $notf_Nama = $moeevent->nama;
    $notf_jabatan = $moeevent->jabatan;
    $notf_EventDate = Perkaraevent::where('id', $moeevent->event)->value('eventdate');

    // Convert the date to the desired format
    $notf_EventDate = date('d-m-Y', strtotime($notf_EventDate));

    $notf_EventLabel = Perkaraevent::where('id', $moeevent->event)->value('eventlabel');

    $no_tel = $moeevent->no_tel;

    Mail::to($notf_userEmail)->send(new MoeEventRejected($notf_Nama, $notf_EventLabel, $notf_jabatan, $notf_EventDate));

    // Send WhatsApp message after successful submission
    $this->sendWhatsAppMessagesRejectedMoeEvent($no_tel, $notf_Nama, $notf_jabatan, $notf_EventLabel, $notf_EventDate);

    return redirect()->back()->with('success_message', 'The user application has been rejected!');
}

    // Function to send WhatsApp message
    private function sendWhatsAppMessagesRejectedMoeEvent($telMobilesubdc, $name, $jabatan, $label, $date)
    {
        // Adjust the parameters according to your template and use case
        $data = [
            'phone' => "+673" . $telMobilesubdc,
            'template' => 'ons_event_rej',
            'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
            'language' => ['code' => 'ms', 'policy' => 'deterministic'],
             "params" => [["type" => "body", "parameters" => [
                ["type" => "text", "text" => $name], 
                ["type" => "text", "text" => $jabatan], 
                ["type" => "text", "text" => $label], 
                ["type" => "text", "text" => $date]
            ]]],
        ];

        $json = json_encode($data);
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
        $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
        $result = file_get_contents($url, false, $options);

        // Handle the result if needed
        // For example, you can log the result or perform other actions based on the response
    }
// End Rejected user mail

    public function showevent($id)
    {
        $moeevent= Moeevent::all()
            ->where('id', '=', $id);   

        $departments = Department::pluck('label', 'id')->all();
       
         $jawatanlist = Jawatanlist::pluck('label', 'id')->all();
        
        return view('moeevent.showevent', compact('moeevent','departments','jawatanlist'));
    }

    public function updateregistereduser(Request $request, $id)
    {
        $now = Carbon::now();

        $moeevent =  Moeevent::find($id)
            ->update([
                'nama'          => $request->nama,
                'icno'          => $request->icno,
                'gender'        => $request->gender,
                'no_tel'        => $request->no_tel,
                'email'         => $request->email,
                'jawatan'  => $request->jawatan,

                'updated_at'    => $now
            ]);

        return redirect()->back()
            ->with('success_message', 'Registered user was successfully updated!');
    }

    public function scanqrcode($id)
    {
        return view('moeeventscan', ['id' => $id]);
    }
    
    public function eventqrcodeadmin($id)
    {
        
        $perkaraevent = Perkaraevent::all()
            ->where('id', '=', $id);  
    
        $moeevent = Moeevent::all()
            ->where('id', '=', $id);  
        
    
        return view('eventqrcode', compact('perkaraevent','moeevent'));
    }
    

    public function attended($id)
    {
        $moeevent = Moeevent::findOrFail($id);
        $moeevent->update(['attend' => 'yes']);

        return redirect()->back()->with('success_message', 'The user has been succesfully modified!');

    }

    public function resubmitattendant($id)
    {
        $moeevent = Moeevent::findOrFail($id);
        $moeevent->update(['attend' => null]);

        return redirect()->back()->with('success_message', 'The user has been succesfully modified!');

    }

    public function dashboard(Request $request, $id){

        
       $perkaraevent = Perkaraevent::all()
    ->where('id', '=', $id);  
       

        $totalAttendees = Moeevent::where('event', $id)
        ->where('status', 'approve')
        ->where('attend', 'yes')
        ->count();

        $totalhadir = Moeevent::where('event', $id)
        ->where('status', 'approve')
        ->where('attend', 'yes')
        ->count();

        $totalnonhadir = Moeevent::where('event', $id)
        ->where('status', 'approve')
        ->where('attend', NULL)
        ->count();

        $totalapproveapplication = Moeevent::where('event', $id)
        ->where('status', 'approve')
        ->count();

        $totalrejectapplication = Moeevent::where('event', $id)
        ->where('status', 'reject')
        ->count();

        $totalnullapplication = Moeevent::where('event', $id)
        ->where('status', NULL)
        ->count();

        $totalfemale = Moeevent::where('event', $id)
        ->where('status', 'approve')
        ->where('gender', 'Female')

        ->count();

        $totalmale = Moeevent::where('event', $id)
        ->where('status', 'approve')
        ->where('gender', 'Male')
        ->count();
    
    
    
        return view('moeevent.chart', compact('totalAttendees','totalapproveapplication','totalrejectapplication' ,'totalnullapplication','perkaraevent', 'totalhadir' , 'totalnonhadir','totalfemale','totalmale' ));
    }






    
    



    // olddddd bawah ini need to change later

    public function indexevent()
{

    if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_SKEVENT')){
        $skevent = Skevent::select('skevent.*')
        ->orderBy('created_at', 'DESC')
        ->get();
    }

    return view('slipkedatangan.indexevent', compact('skevent'));
}







public function updateevent(Request $request)
{

    $now = Carbon::now();

        $skevent =  Skevent::select('skevent.*')
            ->where('id', $request->id)
            ->update([
                'perkara'         =>      $request->perkara,
                'tempat'         =>      $request->tempat,
                'masa'         =>      $request->masa,
                'catatan'         =>      $request->catatan,
                'updated_at' => $now

            ]);

    return redirect()->route('sk.slipkedatangan.indexevent')
        ->with('success_message', 'Data record was successfully updated!');
}


public function destroyevent($id)
{
    try {


      $skevent= Skevent::where('id', $id)->delete();

        return redirect()->route('sk.slipkedatangan.indexevent')
            ->with('success_message', 'Data was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

//Export to excel - Fira
public function exportToExcel($id)
{
    $moeeventData = Moeevent::leftJoin('perkaraevent', 'moeevent.event', '=', 'perkaraevent.id')
        ->select(
            'moeevent.jabatan',
            'moeevent.jawatan',
            'moeevent.nama',
            'moeevent.icno',
            'moeevent.email',
            'moeevent.no_tel',
            'moeevent.gender',
            'moeevent.status',
            'moeevent.attend'
        )
        ->where('moeevent.event', $id)
        ->where('moeevent.status', 'approve')
        ->get();

    return Excel::download(new MoeeventExport($moeeventData), 'List approved participant.xlsx');
}

public function exportToExcelRatingList($id)
{
    $moeeventRatingData = Rating::leftJoin('perkaraevent', 'rate.event', '=', 'perkaraevent.id')
        ->select(
            'rate.jabatan',
            'rate.rating',
            'rate.feedback',
        )
        ->where('rate.event', $id)
        ->get();

    return Excel::download(new MoeeventExportRatingList($moeeventRatingData), 'Event Feedback.xlsx');
}

public function exportToExcelRatingList2($id)
{

    $questions = [
        'How would you rate the content of the program was effective and increase your knowledge?',
        'How would you rate the delivery of facilitator was well-organised, smooth and met the objectives?',
        'How would you rate this program is relevant to my job level?'
    ];

    $moeeventRatingData = Rating::leftJoin('perkaraevent', 'rate.event', '=', 'perkaraevent.id')
        ->select(
            'rate.jabatan',
            'rate.rating1',
            'rate.rating2',
            'rate.rating3',
            'rate.feedback',
        )
        ->where('rate.event', $id)
        ->get();

    return Excel::download(new MoeeventExportRatingList2($moeeventRatingData, $questions), 'Event_Feedbacks.xlsx');
}

//wanie250124
public function eventqrcodeclose($id, $participant_id)
{
    // Debugging: Output information to the Laravel log
    \Illuminate\Support\Facades\Log::info('Event ID: ' . $id);
    \Illuminate\Support\Facades\Log::info('Participant ID: ' . $participant_id);

    // Fetch event details using the provided ID
    $perkaraevent = Perkaraevent::findOrFail($id);

    // Debugging: Output information to the Laravel log
    \Illuminate\Support\Facades\Log::info('Perkaraevent: ' . json_encode($perkaraevent));

    // Update the 'attend' field to 'yes' for the specified participant_id
    $updated = Moeevent::where('id', $participant_id)
        ->update(['attend' => 'yes']);

    // Debugging: Output information to the Laravel log
    \Illuminate\Support\Facades\Log::info('Attendee updated: ' . $updated);

    // Fetch the updated Moeevent model
    $moeevent = Moeevent::findOrFail($participant_id);

    // Debugging: Output information to the Laravel log
    \Illuminate\Support\Facades\Log::info('Moeevent: ' . json_encode($moeevent));

    // Pass both $perkaraevent and $participant_id to the view
    return view('moeevent.event', ['perkaraevent' => $perkaraevent, 'participant_id' => $participant_id, 'moeevent' => $moeevent]);
}

   public function eventqrcode($event_id, $participant_id)
    {
        // Fetch event details using the provided ID
      
        $perkaraevent = Perkaraevent::all()
        ->where('id', '=', $event_id);
    
        // Update the 'attend' field to 'yes' for the specified participant_id
        $updated = Moeevent::where('id', $participant_id)
            ->update(['attend' => 'yes']);
    
        // Fetch the updated Moeevent model
        $moeevent = Moeevent::all()
        ->where('id', '=', $participant_id);
    
        return view('eventqrcode', compact('perkaraevent', 'moeevent'));
    }



public function downloadQrCodePdf($id)
    {   
        // dd('here');
        $perkaraevent = Perkaraevent::find($id);

        $qrCodePath = $this->generateQrCode($perkaraevent);
        $pdfPath = $this->generatePdf($perkaraevent, $qrCodePath);

        // dd($qrCodePath);

        return response()->file($pdfPath);
    }

public function generateQrCode(Perkaraevent $event)
{ 
    // dd($event->id);
    // dd(route('eventqrcode', ['event_id' => $event->id]));
    // dd('here');

    $qrCode = QrCode::size(350)->generate(route('eventqrcodeadmin', ['id' => $event->id]));

    $directory = public_path('qrcodes'. '/');

    // if(is_writable($directory)) {
    //     dd('writable');
    // } else {
    //     dd('no write');
    // }

    if (!file_exists($directory)) {
        mkdir($directory, 0755, true);
    }

    $qrCodePath = $directory . $event->id . '.png';



    // Save the QR code to the file path
    file_put_contents($qrCodePath, $qrCode);

    return $qrCodePath;
}

// this one yg dapat download gmbr but img nya nda show

public function downloadQrCodePng($id)
{
    $perkaraevent = Perkaraevent::find($id);

    // Generate QR code
    $qrCode = QrCode::size(350)->generate(route('eventqrcode', ['id' => $perkaraevent->id]));

    // Set the response headers
    $headers = [
        'Content-Type' => 'image/svg',
        'Content-Disposition' => 'attachment; filename="qewer.svg"',
    ];

    // Return the PNG image as a response using response()
    return Response::make($qrCode, 200, $headers);
}



    public function generatePdf(Perkaraevent $event, $qrCodePath)
{
    // $html = view('moeevent.event', ['eventlabel' => $event, 'qrCodePath' => public_path('qrcodes/' . $event->id . '.png')])->render();
    $html = view('moeevent.event', ['eventlabel' => $event, 'qrCodePath' => public_path('qrcodes/' . $event->id . '.png')])->render();


    $directory = public_path('pdfs/');
    File::makeDirectory($directory, 0755, true, true);

    $pdfPath = $directory . $event->id . '.pdf';

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // Allow rendering of images
    $options = $dompdf->getOptions();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);

    $dompdf->setOptions($options);

    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Save the PDF to the file path
    file_put_contents($pdfPath, $dompdf->output());

    return $pdfPath;
}

//Wani Add 6/2/2024
public function showQrCodeImage($id)
{
    // Assuming $id is the identifier for your QR code (e.g., event ID)
    $url = route('eventqrcode', $id);

    // Generate QR code image URL
    $qrCodeUrl = QrCode::size(300)->generate($url);

    // Return the view with only the QR code image URL
    return view('qrCodeImage', ['qrCodeUrl' => $qrCodeUrl]);

}
//End Add

}



