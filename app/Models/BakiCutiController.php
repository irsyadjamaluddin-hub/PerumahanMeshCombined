<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\BakiCuti;
use App\Models\Employment;
use App\Models\Biodata;
use App\Models\Contact;

use Carbon\Carbon;

class BakiCutiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(){

        $icNos = Auth::user()->ic_no;
        
        $bc = BakiCuti::select('baki_cuti.*')
            ->where('ic_no', $icNos)
            ->get();
        
        return view('bakicuti.index',compact('bc'));
    }

    public function form(){

        $icNos = Auth::user()->ic_no;

        $empinfo = Employment::where('ic_no',$icNos)
            ->first();

        $bio = Biodata::select('biodatas.*')
            ->where('ic_no',$icNos)
            ->first();

        $empcontact = Contact::where('ic_no',$icNos)
            ->first();
        
        return view('bakicuti.form',compact('empinfo','bio','empcontact'));
    }

    public function view($id){

        $bc = BakiCuti::select('baki_cuti.*')
            ->where('id', $id)
            ->first();
        
        return view('bakicuti.view',compact('bc'));
    }

    public function store(Request $request){

        $now = Carbon::now();

        $bc = new BakiCuti;

        $bc->name = $request->name;
        $bc->ic_no = $request->ic_no;
        $bc->department = $request->department;
        $bc->file_no = $request->file_no;
        $bc->phone_number = $request->phone_number;
        $bc->status = 'Submitted';
        $bc->created_at = $now;
        $bc->save();

        return redirect()->route('bakicuti.bakicutis.index')->with('success_message', 'Maklumat berjaya di hantar !');
    }

    public function destroy($id){

        try {

            $bc = BakiCuti::where('id', $id)->delete();
    
            return redirect()->back()->with('success_message', 'Rekod berjaya di hapuskan!');
            
        } catch (Exception $exception) {
    
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function indexadmin(){

        $icNos = Auth::user()->ic_no;
        
        $bc = BakiCuti::select('baki_cuti.*')
            ->where('status', 'Submitted')
            ->get();

        $bcsel = BakiCuti::select('baki_cuti.*')
            ->where('status', 'Selesai')
            ->get();
        
        return view('bakicuti.indexadmin',compact('bc','bcsel'));
    }

    public function updateadmin(Request $request){

        $now = Carbon::now();

        $bc = new BakiCuti;

        $icNos = Auth::user()->ic_no;
        
        $bc =  BakiCuti::select('baki_cuti.*')
        ->where('id', $request->id)
        ->update([
            'tarikh_baki_cuti' => $request->tarikh_baki_cuti,
            'baki_cuti' => $request->baki_cuti,
            'status' => 'Selesai',
            'done_by' => $icNos,
            'updated_at' => $now
        ]);

        $bcdata = BakiCuti::select('baki_cuti.*')
            ->where('id', $request->id)
            ->first();

        // Whatsapp API Start
        $data = [
            'phone' => "+673" . $bcdata->phone_number, // Receiver's phone
            'template' => 'baki_cuti', // Template name
            'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
            'language' => ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
            'params' => [['type' => 'body', 'parameters' => [
                ['type' => 'text', 'text' => $bcdata->file_no],
                ['type' => 'text', 'text' => $request->baki_cuti],
                ['type' => 'text', 'text' => $request->tarikh_baki_cuti]
            ]]]
        ];


        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $url = 'https://api.1msg.io/' . $instanceId . '/sendTemplate?token=' . $token;

        // Make a POST request
        $options = stream_context_create(['http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/json',
            'content' => $json
        ]]);

        // Send a request
        $result = file_get_contents($url, false, $options);
        // Whatsapp API End

        return redirect()->back()->with('success_message', 'Maklumat berjaya di hantar !');
    }
}
