<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\OnlineNotification;
use App\Models\Department;
use App\Models\Employment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class OnlineNotificationService extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {

         if (Auth::user()->hasRole('ROLE_ONS_ADMIN')){

  

        $icNos = Auth::user()->ic_no;

        $employments = Employment::leftJoin('departments', 'emp_employment_infos.department_id', '=', 'departments.id')
        ->select('emp_employment_infos.*', 'departments.label')
        ->where('ic_no', '=', $icNos)->first();

        // $employments->label;

        $onlinenotif = OnlineNotification::where('jabatan', '=', $employments->label)
          ->select('online_notification.*')
          ->orderBy('updated_at', 'DESC') 
          ->paginate(20);

        $department = Department::pluck('label','label')->all();
    
        return view('onlinenotification.index', compact('onlinenotif','department'));
        }

        if (Auth::user()->hasRole('ROLE_SUPERADMIN')){

            
        $onlinenotif = OnlineNotification::leftJoin('departments','online_notification.jabatan' , '=', 'departments.label')
          ->select('online_notification.*', 'departments.label')
          ->orderBy('updated_at', 'DESC') 
          ->paginate(20);

        $department = Department::pluck('label','label')->all();
    
        return view('onlinenotification.index', compact('onlinenotif','department'));
        }   
    }

    public function adminview($id)
    {

    $adminview = OnlineNotification::leftJoin('departments','online_notification.jabatan' , '=', 'departments.label')
            ->select('online_notification.*', 'departments.label')
            ->orderBy('updated_at', 'DESC') 
            ->get();
    
    $messagedetails = OnlineNotification::leftJoin('departments','online_notification.jabatan' , '=', 'departments.label')
            ->select('online_notification.*', 'departments.label')
            ->orderBy('updated_at', 'DESC')
            ->where('online_notification.id', '=', $id) 
            ->get();

    $department = Department::pluck('label','id')->all();

          return view('onlinenotification.adminview', compact('adminview','messagedetails','department'));
    }

    public function destroy($id)
    {
        try {


          $ons= OnlineNotification::where('id', $id)->delete();

            return redirect()->route('onlinenotifications.onlinenotification.index')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function form()
    {
        $icNos = Auth::user()->ic_no;

        $userdetails = Employment::leftJoin('departments','emp_employment_infos.department_id','=','departments.id')
            ->where('emp_employment_infos.ic_no','=',$icNos)
            ->select('emp_employment_infos.*','departments.label')
            ->get();

        $department = Department::pluck('label','label')->all();
    
        return view('onlinenotification.form', compact('department','userdetails'));    
    }

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function save(Request $request)
    {

        $onlinenotif = new OnlineNotification;

        $currentdate = Carbon::now();
        $icNos = Auth::user()->ic_no;

        // Check if a file was provided
        if(!empty($request->file)){
            if (!$request->hasFile('file') || $request->file('file')->getSize() > 2 * 1024 * 1024) {
                return redirect()->back()->with('error_message', 'Tidak sah atau tidak memenuhi keperluan fail.');
            }
            // Get the original filename
            $originalFilename = $request->file('file')->getClientOriginalName();
	    $encodedFilename = rawurlencode($originalFilename);
            $onlinenotif->file_name = $originalFilename;
            $onlinenotif->file_url = $request->file('file')->storeAs('public/onlinenotification', $originalFilename);
        }

        $phoneNumbersString = implode(' ',$request->phone_numbers);

        $onlinenotif->jabatan = $request->jabatan;
        $onlinenotif->phone_number = $phoneNumbersString;
        $onlinenotif->title = $request->title;
        $onlinenotif->message = $request->message;
        $onlinenotif->additionalmessage = $request->additionalmessage;
        $onlinenotif->sender_icno = $icNos;
        $onlinenotif->updated_at = $currentdate;
        // Save 'Online Notification' data
        $onlinenotif->save();

        $phoneNumbers = explode(' ',$phoneNumbersString);      

        foreach ($phoneNumbers as $phone_number) {
            if (empty($phone_number)) {
                continue;
            }

            if(empty($request->file)){
                $template = 'ons_utility';

                // Whatsapp API Start
                $data = [
                    'phone' => "+673" . $phone_number, // Receiver's phone
                    'template' => $template, // Template name
                    'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
                    'language' => ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
                    'params' => [['type' => 'body', 'parameters' => [
                        ['type' => 'text', 'text' => $request->jabatan],
                        ['type' => 'text', 'text' => $request->title],
                        ['type' => 'text', 'text' => $request->message],
                        ['type' => 'text', 'text' => $request->additionalmessage]
                    ]]]
                ];

            }else{

                $template = 'ons_utility_file';

                // Generate the file URL
                $fileUrl = url('storage/onlinenotification/' . $encodedFilename);

                // Whatsapp API Start
                $data = [
                    'phone' => "+673" . $phone_number, // Receiver's phone
                    'template' => $template, // Template name
                    'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
                    'language' => ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
                    'params' => [['type' => 'body', 'parameters' => [
                        ['type' => 'text', 'text' => $request->jabatan],
                        ['type' => 'text', 'text' => $request->title],
                        ['type' => 'text', 'text' => $request->message],
                        ['type' => 'text', 'text' => $request->additionalmessage],
                        ['type' => 'text', 'text' => $fileUrl] // Link text
                    ]]]
                ];
    
            }

            $json = json_encode($data); // Encode data to JSON
            // URL for request POST /message
            $token = '7hpe9bwi2bl1k5ja';
            $instanceId = '448643';
            $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;

            // Make a POST request
            $options = stream_context_create(['http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => $json
            ]]);

            // Send a request
            $result = file_get_contents($url, false, $options);
            // Whatsapp API End
        }


        return redirect()->back()
        ->with('success_message', 'Message has successfully been sent!');
    }

    //User View

    public function indexuser()
    {

        $icNos = Auth::user()->ic_no;

        $onlinenotif = OnlineNotification::leftJoin('departments','online_notification.jabatan' , '=', 'departments.label')
          ->where('sender_icno','=', $icNos)  
          ->select('online_notification.*', 'departments.label')
          ->orderBy('updated_at', 'DESC') 
          ->get();
         
        $userdetails = Employment::leftJoin('departments','emp_employment_infos.department_id','=','departments.id')
            ->where('emp_employment_infos.ic_no','=',$icNos)
            ->select('emp_employment_infos.*','departments.label')
            ->get();

        $department = Department::pluck('label','label')->all();
        
        return view('onlinenotification.indexuser', compact('onlinenotif','department','userdetails')); 
    }

    public function view($id)
    {

    $userview = OnlineNotification::leftJoin('departments','online_notification.jabatan' , '=', 'departments.label')
            ->select('online_notification.*', 'departments.label')
            ->orderBy('updated_at', 'DESC') 
            ->get();
    
    $messagedetails = OnlineNotification::leftJoin('departments','online_notification.jabatan' , '=', 'departments.label')
            ->select('online_notification.*', 'departments.label')
            ->orderBy('updated_at', 'DESC')
            ->where('online_notification.id', '=', $id) 
            ->get();
            

          return view('onlinenotification.userview', compact('userview','messagedetails'));
    }
    
    // public function send(Request $request)
    // {

    //     $onlinenotif = new OnlineNotification;

    //     $currentdate = Carbon::now();
    //     $icNos = Auth::user()->ic_no;

    //     // Check if a file was provided
    //     if(!empty($request->file)){
    //         if (!$request->hasFile('file') || $request->file('file')->getSize() > 2 * 1024 * 1024) {
    //             return redirect()->back()->with('error_message', 'Tidak sah atau tidak memenuhi keperluan fail.');
    //         }
    //         // Get the original filename
    //         $originalFilename = $request->file('file')->getClientOriginalName();
	//     $encodedFilename = rawurlencode($originalFilename);
    //         $onlinenotif->file_name = $originalFilename;
    //         $onlinenotif->file_url = $request->file('file')->storeAs('public/onlinenotification', $originalFilename);
    //     }

    //     $phoneNumbersString = implode(' ',$request->phone_numbers);

    //     $onlinenotif->jabatan = $request->jabatan;
    //     $onlinenotif->phone_number = $phoneNumbersString;
    //     $onlinenotif->title = $request->title;
    //     $onlinenotif->message = $request->message;
    //     $onlinenotif->additionalmessage = $request->additionalmessage;
    //     $onlinenotif->sender_icno = $icNos;
    //     $onlinenotif->updated_at = $currentdate;
    //     // Save 'Online Notification' data
    //     $onlinenotif->save();

    //     $phoneNumbers = explode(' ',$phoneNumbersString);      

    //     foreach ($phoneNumbers as $phone_number) {
    //         if (empty($phone_number)) {
    //             continue;
    //         }

    //         if(empty($request->file)){
    //             $template = 'ons_utility';

    //             // Whatsapp API Start
    //             $data = [
    //                 'phone' => "+673" . $phone_number, // Receiver's phone
    //                 'template' => $template, // Template name
    //                 'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
    //                 'language' => ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
    //                 'params' => [['type' => 'body', 'parameters' => [
    //                     ['type' => 'text', 'text' => $request->jabatan],
    //                     ['type' => 'text', 'text' => $request->title],
    //                     ['type' => 'text', 'text' => $request->message],
    //                     ['type' => 'text', 'text' => $request->additionalmessage]
    //                 ]]]
    //             ];

    //         }else{

    //             $template = 'ons_utility_file';

    //             // Generate the file URL
    //             $fileUrl = url('storage/onlinenotification/' . $encodedFilename);

    //             // Whatsapp API Start
    //             $data = [
    //                 'phone' => "+673" . $phone_number, // Receiver's phone
    //                 'template' => $template, // Template name
    //                 'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
    //                 'language' => ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
    //                 'params' => [['type' => 'body', 'parameters' => [
    //                     ['type' => 'text', 'text' => $request->jabatan],
    //                     ['type' => 'text', 'text' => $request->title],
    //                     ['type' => 'text', 'text' => $request->message],
    //                     ['type' => 'text', 'text' => $request->additionalmessage],
    //                     ['type' => 'text', 'text' => $fileUrl] // Link text
    //                 ]]]
    //             ];
    
    //         }

    //         $json = json_encode($data); // Encode data to JSON
    //         // // URL for request POST /message
    //         $token = '7hpe9bwi2bl1k5ja';
    //         $instanceId = '448643';
    //         $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;

    //         // Make a POST request
    //         $options = stream_context_create(['http' => [
    //             'method' => 'POST',
    //             // 'header' => 'Content-type: application/json',
    //             'header' => 'Content-type: application/x-www-form-urlencoded\r\n',
    //             // 'content' => $json
    //             'content' => http_build_query($data),
    //             'timeout' => 30
    //         ],
    //         'ssl' => [
    //             'verify_peer' => false,
    //             'verify_peer_name' => false,
    //         ]]);

    //         //$url = 'http://moe.proxy.mesh/';
    //         $url = 'http://mesh.moe.gov.bn/onlinenotification/send';

    //         // Send a request
    //         $result = file_get_contents($url, false, $options);
    //         // Whatsapp API End
    //     }


    //     return redirect()->back()
    //     ->with('success_message', 'Message has successfully been sent!');
    // }

    public function send(Request $request)
    {
        $onlinenotif = new OnlineNotification;
        $currentdate = Carbon::now();
        $icNos = Auth::user()->ic_no;

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if ($file->getSize() > 2 * 1024 * 1024) {
                return redirect()->back()->with('error_message', 'Tidak sah atau tidak memenuhi keperluan fail.');
            }

            $originalFilename = $file->getClientOriginalName();
            $encodedFilename = rawurlencode($originalFilename);
            $filePath = $file->storeAs('public/onlinenotification', $originalFilename);

            $onlinenotif->file_name = $originalFilename;
            $onlinenotif->file_url = $filePath;
            $fileUrl = url('storage/onlinenotification/' . $encodedFilename);
        }

        // Save record
        $phoneNumbersString = implode(' ', $request->phone_numbers);
        $onlinenotif->jabatan = $request->jabatan;
        $onlinenotif->phone_number = $phoneNumbersString;
        $onlinenotif->title = $request->title;
        $onlinenotif->message = $request->message;
        $onlinenotif->additionalmessage = $request->additionalmessage;
        $onlinenotif->sender_icno = $icNos;
        $onlinenotif->updated_at = $currentdate;
        $onlinenotif->save();

        $phoneNumbers = explode(' ', $phoneNumbersString);

        // WhatsApp API details
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $endpoint = "http://moe.proxy.mesh/{$instanceId}/sendTemplate?token={$token}";

        foreach ($phoneNumbers as $phone_number) {
            $phone_number = trim($phone_number);
            if (empty($phone_number)) continue;

            // Determine template
            if (empty($request->file)) {
                $template = 'ons_utility';
                $params = [
                    ['type' => 'text', 'text' => $request->jabatan],
                    ['type' => 'text', 'text' => $request->title],
                    ['type' => 'text', 'text' => $request->message],
                    ['type' => 'text', 'text' => $request->additionalmessage],
                ];
            } else {
                $template = 'ons_utility_file';
                $params = [
                    ['type' => 'text', 'text' => $request->jabatan],
                    ['type' => 'text', 'text' => $request->title],
                    ['type' => 'text', 'text' => $request->message],
                    ['type' => 'text', 'text' => $request->additionalmessage],
                    ['type' => 'text', 'text' => $fileUrl],
                ];
            }

            $data = [
                'phone' => "673{$phone_number}", // without plus sign
                'template' => $template,
                'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
                'language' => ['code' => 'en', 'policy' => 'deterministic'],
                'params' => [['type' => 'body', 'parameters' => $params]],
            ];

            try {
                $response = Http::timeout(30)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post($endpoint, $data);

                Log::info('WhatsApp Send', [
                    'phone' => $phone_number,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

            } catch (\Exception $e) {
                Log::error('WhatsApp Send Failed', [
                    'phone' => $phone_number,
                    'error' => $e->getMessage()
                ]);
            }
        }

        return redirect()->back()
            ->with('success_message', 'Message has successfully been sent!');
    }

    public function searchons(Request $request)
    {
        $query = $request->input('query');
    
        // Define the columns you want to search in
        $columns = ['jabatan', 'phone_number', 'title', 'message', 'sender_icno'];
    
        // Start building the query
        $onlinenotif = OnlineNotification::where(function ($queryBuilder) use ($columns, $query) {
            foreach ($columns as $column) {
                $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
            }
        })->orderBy('updated_at', 'DESC');
    
        // Check if the number of results exceeds a threshold
        $threshold = 1000; // Adjust the threshold as needed
        $totalResults = $onlinenotif->count();
    
        if ($totalResults > $threshold) {
            $onlinenotif = $onlinenotif->paginate(5000);
        } else {
            $onlinenotif = $onlinenotif->get();
        }
    
        return view('onlinenotification.indexresult', ['onlinenotif' => $onlinenotif]);
    }
    
}
