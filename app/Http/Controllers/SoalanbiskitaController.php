<?php

namespace App\Http\Controllers;

use App\Models\Soalanbiskitadepartment;
use App\Models\Soalanbiskita;
use App\Models\Tanyaperkara;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 


use Illuminate\Http\Request;

class SoalanbiskitaController extends Controller
{

        public function show($id)
{
    
    // $soalanbiskitas = Soalanbiskita::select('soalanbiskitas.*')->orderBy('created_at', 'DESC')->get();
    $soalanbiskitas= Soalanbiskita::all()
    ->where('id', '=', $id);   

    return view('soalanbiskita.show', compact('soalanbiskitas') );
  
}

public function editperkara()
{
    
    $tanyaperkaras = TanyaPerkara::select('soalanbiskitaperkara.*')->orderBy('id', 'DESC')->get();

    return view('soalanbiskita.editperkara', compact('tanyaperkaras'));
}

public function editperkaraic($id)
{

    $tanyaperkara= TanyaPerkara::all()
    ->where('id', '=', $id);
    

    return view('soalanbiskita.editperkaraic', compact('tanyaperkara'));
}

public function storeperkara(Request $request){

    $tanyaperkara = new TanyaPerkara;

    $tanyaperkara-> label = $request->label;
    // $tanyaperkara-> ic_no = $request->ic_no;


    $tanyaperkara->save();

    return redirect()->route('soalanbiskita.soalanbiskita.indexadmin')
            ->with('success_message', 'Perkara was updated!');

}

public function storeperkaraic(Request $request, $id) {
    try {
        $tanyaperkara = TanyaPerkara::findOrFail($id);
        $tanyaperkara->label = $request->input('label');
        $icFileNames = $tanyaperkara->ic_no ?? [];

        // Handle removing IC numbers
        if ($request->has('remove_icno')) {
            $removeIcnoIndexes = $request->input('remove_icno');
            $icFileCount = count($tanyaperkara->ic_no);
            $icFileNames = $tanyaperkara->ic_no ?? []; // Retrieve existing image filenames or initialize an empty array

            foreach ($removeIcnoIndexes as $index) {
                // Ensure the index is within the range of the ic_no array
                if ($index >= 0 && $index < $icFileCount) {
                    if (in_array($index, $removeIcnoIndexes)) {
                        // Remove the ic_no from the arrays
                        unset($icFileNames[$index]);
                    }
                }
            }

                // Reindex the arrays after removing elements
                $reindexedFileNames = array_values($icFileNames);

                // Save the updated result news file names and paths in the News model
                $tanyaperkara->setAttribute('ic_no', $reindexedFileNames);
            }


        // Handle uploaded IC numbers
        if ($request->has('ic_no')) {
            $uploadedIcNos = $request->input('ic_no');

            foreach ($uploadedIcNos as $ic_no) {
                // Store the new IC number in the existing array
                $icFileNames[] = $ic_no;
            }
        }

        // Save the updated IC numbers in the model
        $tanyaperkara->setAttribute('ic_no', array_values($icFileNames));
        $tanyaperkara->save();

        return redirect()->back()->with('success', 'Perkara was updated!');

    } catch (Exception $e) {
        // Handle exceptions if necessary
        return back()->with('error_message', 'An error occurred.');
    }
}


public function destroyperkara($id)
{
    try {

      $tanyaperkara= TanyaPerkara::where('id', $id)->delete();

        return redirect()->route('soalanbiskita.soalanbiskita.editperkara')
            ->with('success_message', 'Data was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}


    public function store(Request $request)
    {
        $request->validate([
            'kpd_jabatan' => 'required',
           
    ]);
     
        $soalanbiskita = new Soalanbiskita;
        $soalanbiskita->kpd_jabatan = $request->kpd_jabatan; 
        $soalanbiskita->tajuk = $request->tajuk;
        $soalanbiskita->aduan = $request->aduan;
        $soalanbiskita->nama = $request->nama;
        $soalanbiskita->no_tel = $request->no_tel;
        $soalanbiskita->emel = $request->emel;

        
        $soalanbiskita->save();

        if($request->kpd_jabatan != ""){

       

       $noteldept = Soalanbiskita::leftJoin('soalanbiskitadepartments', 'soalanbiskitas.kpd_jabatan', '=', 'soalanbiskitadepartments.label')
        ->select('soalanbiskitas.*', 'soalanbiskitadepartments.contact_no')
        ->where('label', $request->kpd_jabatan)
        ->first();

        
     

            // Whatsapp API Start
            $data = [
                // 'phone' => $phoneNumbers->implode(','), // Receivers phone
                // 'phone' => "+673".'8924942', // Receivers phone
                'phone' => "+673".$noteldept->contact_no, // Receivers phone

                'template' => 'tanya_moebn', // Template name
                'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
                'language' =>  ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
                "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=> $request->kpd_jabatan],
                 ["type"=>"text","text"=> $request->tajuk], 
                 ["type"=>"text","text"=> $request->aduan]
                 ]]],
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
    
            return redirect()->route('soalanbiskita')
                ->with('success_message', 'Aduan telah berjaya dihantar');
    }


    public function isisoalanbiskita()
{
    $sbdepartments = Soalanbiskitadepartment::pluck('label', 'id')->all();
    $perkara = Tanyaperkara::orderBy('label', 'asc')->pluck('label', 'id')->all();
   

    return view('soalanbiskita', compact('sbdepartments','perkara'));
}




public function index()
{
    $icNos = Auth::user()->ic_no;


$soalanbiskitas = Soalanbiskita::leftJoin('soalanbiskitaperkara', 'soalanbiskitas.tajuk', '=', 'soalanbiskitaperkara.label')
    ->select('soalanbiskitas.*', 'soalanbiskitaperkara.ic_no')
    ->where(function ($query) use ($icNos) {
        $query->whereRaw('CHARINDEX( :icNos, soalanbiskitaperkara.ic_no)>0', ['icNos' => $icNos])
            ->orWhereNotNull('soalanbiskitaperkara.ic_no');
    })
    ->get();

    return view('soalanbiskita.index', compact('soalanbiskitas'));
}







public function indexadmin()
{
    $sbdepartments = Soalanbiskitadepartment::pluck('label', 'id')->all();
    $soalanbiskitas = Soalanbiskita::select('soalanbiskitas.*')->orderBy('created_at', 'DESC')->get();
  

    return view('soalanbiskita.indexadmin', compact('sbdepartments','soalanbiskitas'));
}

public function jabatanlist()
{
    // $sbdepartments = Soalanbiskitadepartment::pluck('label', 'id')->all();
    $soalanbiskitadepartments = Soalanbiskitadepartment::select('soalanbiskitadepartments.*')->get();
  

    return view('soalanbiskita.jabatanlist', compact('soalanbiskitadepartments'));
}

public function editdept($id)
{
    
    $soalanbiskitadepartments= Soalanbiskitadepartment::all()
                ->where('id', '=', $id);
                
  
    return view('soalanbiskita.editdept', compact('soalanbiskitadepartments') );
  
}

public function updatedept(Request $request)
{
   

    
    $soalanbiskitadepartments =  Soalanbiskitadepartment::select('soalanbiskitadepartments.*')
    ->where('id', $request->id)
     ->update([
            'contact_no'         =>      $request->contact_no

            ]);

    return redirect()->route('soalanbiskita.soalanbiskita.jabatanlist')
        ->with('success_message', 'Contact No successfully updated!');

    
      
}

public function tindakan($id)
{
    $soalanbiskita = Soalanbiskita::findOrFail($id);
    $soalanbiskita->update(['status' => 'Tindakan']);

    return redirect()->route('soalanbiskita.soalanbiskita.indexadmin')
        ->with('success_message', 'Status Updated');
}

public function updatetindakan(Request $request){

    $soalanbiskita =  Soalanbiskita::select('soalanbiskitas.*')
    ->where('id', $request->id)
    ->update([
        'status'         =>      'tindakan',
        'mesej'         =>      $request->mesej
    ]);

    // Whatsapp API Start
    $data = [
        'phone' =>  "+673".$request->no_tel, // Receivers phone
        'template' => 'soalan_biskita', // Template name
        'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
        'language' =>  ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
        "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=> $request->mesej]]]],
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
    return redirect()->route('soalanbiskita.soalanbiskita.indexadmin')
        ->with('success_message', 'Status Updated');
}

public function updatetindakanuser(Request $request){

    $soalanbiskita =  Soalanbiskita::select('soalanbiskitas.*')
    ->where('id', $request->id)
    ->update([
        'status'         =>      'tindakan',
        'mesej'         =>      $request->mesej
    ]);

    // Whatsapp API Start
    $data = [
        'phone' =>  "+673".$request->no_tel, // Receivers phone
        'template' => 'soalan_biskita', // Template name
        'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
        'language' =>  ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
        "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=> $request->mesej]]]],
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
    return redirect()->route('soalanbiskita.soalanbiskita.index')
        ->with('success_message', 'Status Updated');
}

public function selesai($id)
{
    $soalanbiskita = Soalanbiskita::findOrFail($id);
    $soalanbiskita->update(['status' => 'Selesai']);

    return redirect()->route('soalanbiskita.soalanbiskita.indexadmin')
        ->with('success_message', 'Status Updated');
}


public function destroy($id)
{
    try {

        
      

        $soalanbiskita = Soalanbiskita::where('id', $id)->delete();

        return redirect()->route('soalanbiskita.soalanbiskita.indexadmin')
                         ->with('success_message', 'Record successfully deleted!');

        

    } catch (Exception $exception) {

        return back()->withInput()
                     ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

    
}
