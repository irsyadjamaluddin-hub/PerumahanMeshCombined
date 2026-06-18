<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Models\Datakehadiran;
use App\Models\Datakehadiranschools;
use Illuminate\Support\Facades\Response;

use Carbon\Carbon;



class DatakehadiranController extends Controller
{
    public function indexadmin()
    {

        $datakehadirans = Datakehadiran::select('data_kehadiran.*')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('datakehadiran.indexadmin', compact('datakehadirans'));
    }

    public function indexuniform()
    {
        $datakehadiranuniforms = Datakehadiran::select('data_kehadiran.*')
            ->where('kategori', 'PASUKAN BERUNIFORM') // filtering by kategori
            ->orderBy('created_at', 'DESC')
            ->get();
    
        return view('datakehadiran.indexuniform', compact('datakehadiranuniforms'));
    }

        public function indexpegawai()
    {
        $datakehadiranpegawais = Datakehadiran::select('data_kehadiran.*')
            ->where('kategori', 'PEGAWAI & KAKITANGAN') // filtering by kategori
            ->orderBy('created_at', 'DESC')
            ->get();
    
        return view('datakehadiran.indexpegawai', compact('datakehadiranpegawais'));
    }

         public function indexhadrah()
    {
        $datakehadiranhadrahs = Datakehadiran::select('data_kehadiran.*')
            ->where('pasukan', 'Pasukan Hadrah') // filtering by kategori
            ->orderBy('created_at', 'DESC')
            ->get();
    
        return view('datakehadiran.indexhadrah', compact('datakehadiranhadrahs'));
    }
    
    

 public function index()
    {
        $icNos = Auth::user()->ic_no;
    
        // Fetch schools associated with the given IC numbers
        $dkschools = Datakehadiranschools::whereJsonContains('icno', $icNos)->get();
    
        // Check if IC numbers exist in the Datakehadiranschools table
        if ($dkschools->isNotEmpty()) {
            // Filter IC numbers that match and extract corresponding schools
            $matchedSchools = $dkschools->pluck('schools')->toArray();

       

    // Fetch data_kehadiran entries related to the extracted schools
$datakehadiranblanks = Datakehadiran::select('data_kehadiran.*')
    ->where(function ($query) use ($dkschools) {
        foreach ($dkschools as $dkschool) {
            $query->orWhere('sekolah_institusi', '=', $dkschool->schools);

        }
    })
    ->where(function ($query) {
        $query->where(function ($subQuery) {
            $subQuery->whereNull('hadir')
                     ->orWhere('hadir', '');
        })
        ->orWhere(function ($subQuery) {
            $subQuery->whereNull('icno_skbno')
                     ->orWhere('icno_skbno', '');
        });
    })
    ->orderBy('created_at', 'DESC')
    ->paginate(20);


    
 // Fetch data_kehadiran entries related to the extracted schools
$datakehadirans = Datakehadiran::select('data_kehadiran.*')
    ->whereIn('sekolah_institusi', $matchedSchools)
    ->whereNotNull('hadir')
    ->where('hadir', '!=', '')
    ->whereNotNull('icno_skbno')
    ->where('icno_skbno', '!=', '')
    ->orderBy('created_at', 'DESC')
    ->paginate(20);

    
            // Fetch data_kehadiran entries related to the extracted schools and PASUKAN BERUNIFORM
            $datakehadiranuniforms = Datakehadiran::select('data_kehadiran.*')
                ->whereIn('sekolah_institusi', $matchedSchools)
                ->where('Kategori', '=', 'PASUKAN BERUNIFORM')
                ->orderBy('created_at', 'DESC')
                ->paginate(20);
    
            // Display the view with the retrieved data
            return view('datakehadiran.index', compact('datakehadirans', 'datakehadiranuniforms','datakehadiranblanks'))
                ->withErrors(['msg' => 'Records retrieved successfully']);
        } else {
            return view('datakehadiran.index')->withErrors(['msg' => 'No matching schools found']);
        }
    }

    public function indexlist()
    {

        $dkschools = Datakehadiranschools::select('data_kehadiran_schools.*')
            ->get();

   


        return view('datakehadiran.indexlist', compact('dkschools'));
    }

    public function createadmin()
    {
       
        $dkschools = Datakehadiranschools::pluck('schools','id')->all();
   

        return view('datakehadiran.createadmin', compact('dkschools'));
    }

     public function createuniform()
    {
       
        $dkschools = Datakehadiranschools::pluck('schools','id')->all();
   

        return view('datakehadiran.createuniform', compact('dkschools'));
    }

      public function createhadrah()
    {
       
        $dkschools = Datakehadiranschools::pluck('schools','id')->all();
   

        return view('datakehadiran.createhadrah', compact('dkschools'));
    }


    public function create()
    {
       

   $dkschools = Datakehadiranschools::pluck('schools','id')->all();

        return view('datakehadiran.create', compact('dkschools'));
    }
    

    public function editadmin($id)
    {
        $icNos = Auth::user()->ic_no;

        $datakehadirans = Datakehadiran::all()
        ->where('id', '=', $id);

        $dkschools = Datakehadiranschools::pluck('schools','id')->all();

        return view('datakehadiran.editadmin', compact('datakehadirans','dkschools'));
    }

    public function edit($id)
    {
        $icNos = Auth::user()->ic_no;

        $datakehadirans = Datakehadiran::all()
        ->where('id', '=', $id);

        $dkschools = Datakehadiranschools::pluck('schools','id')->all();



        return view('datakehadiran.edit', compact('datakehadirans','dkschools'));

       
    }

    public function editlist($id)
    {
        

        $dkschools = Datakehadiranschools::all()
        ->where('id', '=', $id);



        return view('datakehadiran.editlist', compact('dkschools'));

       
    }

    public function searchdatakehadiran(Request $request)
    {
        $query = $request->input('query');
    
        // Define the columns you want to search in
        $columns = ['kategori', 'sekolah_institusi', 'nama_pelajar_pengawas', 'type_pelajar_pengawas', 'hadir','pasukan','icno_skbno'];
    
        // Start building the query
        $results = Datakehadiran::where(function ($queryBuilder) use ($columns, $query) {
            foreach ($columns as $column) {
                $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
            }
        })->orderBy('created_at', 'DESC');
    
        // Check if the number of results exceeds a threshold
        $threshold = 1000; // Adjust the threshold as needed
        $totalResults = $results->count();
    
        if ($totalResults > $threshold) {
            $results = $results->paginate(5000);
        } else {
            $results = $results->get();
        }
    
        return view('datakehadiran.indexadminsearch', ['results' => $results]);
    }

    public function searchindexdatakehadiran(Request $request)
    {
        $query = $request->input('query');
        $icNos = Auth::user()->ic_no;
    
        // Fetch schools associated with the given IC numbers
        $dkschools = Datakehadiranschools::whereJsonContains('icno', $icNos)->get();
    
        // Check if IC numbers exist in the Datakehadiranschools table
        if ($dkschools->isNotEmpty()) {
            // Extract matched schools
            $matchedSchools = $dkschools->pluck('schools')->toArray();
    
            // Define the columns you want to search in
            $columns = ['sekolah_institusi', 'icno_skbno', 'nama_pelajar_pengawas', 'type_pelajar_pengawas', 'hadir'];
    
            $resultsblank = Datakehadiran::where(function ($queryBuilder) use ($columns, $query) {
                foreach ($columns as $column) {
                    $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
                }
            })
            ->whereIn('sekolah_institusi', $matchedSchools)
            ->where(function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->whereNull('hadir')
                             ->orWhere('hadir', '');
                })
                ->orWhere(function ($subQuery) {
                    $subQuery->whereNull('icno_skbno')
                             ->orWhere('icno_skbno', '');
                });
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(500);

        
                 // Start building the query
            $resultsdatakehadiran = Datakehadiran::where(function ($queryBuilder) use ($columns, $query) {
                foreach ($columns as $column) {
                    $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
                }
            })->whereIn('sekolah_institusi', $matchedSchools)
            ->whereNotNull('hadir')
            ->where('hadir', '!=', '')
            ->whereNotNull('icno_skbno')
            ->where('icno_skbno', '!=', '')
                ->orderBy('created_at', 'DESC')->paginate(500); // Adjust pagination as needed

                 // Start building the query
            $resultsuniform = Datakehadiran::where(function ($queryBuilder) use ($columns, $query) {
                foreach ($columns as $column) {
                    $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
                }
            })->whereIn('sekolah_institusi', $matchedSchools)
            ->where('Kategori', '=', 'PASUKAN BERUNIFORM')
                ->orderBy('created_at', 'DESC')->paginate(500); // Adjust pagination as needed
    
            return view('datakehadiran.indexsearch', compact('resultsblank','resultsdatakehadiran','resultsuniform'));
        } 
    }
    

    
public function updateadmin(Request $request)
{
    
    $icNos = Auth::user()->ic;

    $now = Carbon::now();


    $datakehadiran=  Datakehadiran::select('data_keahadiran.*')
        ->where('id', $request->id)
        ->update([

            'kategori' => $request->kategori,
            'sekolah_institusi' => $request->sekolah_institusi,
            'nama_pelajar_pengawas' => $request->nama_pelajar_pengawas,
            'icno_skbno' => $request->icno_skbno,

            'type_pelajar_pengawas' => $request->type_pelajar_pengawas,
            'hadir' => $request->hadir,
            'pasukan' => $request->pasukan,
            'pindah' => $request->pindah,
            'catatan' => $request->catatan,
            'updated_at' => $now,
            'updated_at' => $icNos

        ]);

    return redirect()->back()
        ->with('success_message', 'Data Kehadiran berjaya dikemaskini!');
}

public function update(Request $request)
{
    
    $icNos = Auth::user()->ic;

    $now = Carbon::now();


    $datakehadiran=  Datakehadiran::select('data_kehadiran.*')
        ->where('id', $request->id)
        ->update([

            'kategori' => $request->kategori,
            'sekolah_institusi' => $request->sekolah_institusi,
            'nama_pelajar_pengawas' => $request->nama_pelajar_pengawas,
            'icno_skbno' => $request->icno_skbno,
            'type_pelajar_pengawas' => $request->type_pelajar_pengawas,
            'hadir' => $request->hadir,
            'pasukan' => $request->pasukan,
            'pindah' => $request->pindah,
            'catatan' => $request->catatan,
            'updated_at' => $now,
            'updated_at' => $icNos

        ]);

       

    return redirect()->back()
        ->with('success_message', 'Data Kehadiran berjaya dikemaskini!');
}

public function storeicnumber(Request $request, $id) {
    try {
        $dkschools = Datakehadiranschools::findOrFail($id);
        $icFileNames = $dkschools->icno !== null ? json_decode($dkschools->icno, true) : null;

        // Update the school name
        $dkschools->schools = $request->input('schools');

        // Handle removing IC numbers
        if ($request->has('remove_icno')) {
            $removeIcnoIndexes = $request->input('remove_icno');
            $icFileCount = count($icFileNames);

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
            $icFileNames = array_values($icFileNames);
        }

        // Handle uploaded IC numbers
        if ($request->has('icno')) {
            $uploadedIcNos = $request->input('icno');

            foreach ($uploadedIcNos as $icno) {
                // Store the new IC number in the existing array
                $icFileNames[] = $icno;
            }
        }

        // Save the updated IC numbers in the model after encoding as JSON
        if ($icFileNames !== null) {
        $dkschools->icno = json_encode($icFileNames);
        }
        $dkschools->save();

        return redirect()->back()->with('success', 'IC Number was updated!');
    } catch (Exception $e) {
        // Handle exceptions if necessary
        return back()->with('error_message', 'An error occurred.');
    }
}

public function hadir($id)
{
    $datakehadirans = Datakehadiran::findOrFail($id);
    $datakehadirans->update(['hadir' => 1]);

    return redirect()->route('datakehadiran.datakehadiran.index')
        ->with('success_message', 'Rekod berjaya dikemaskini!');
}

public function tidakhadir($id)
{
    $datakehadirans = Datakehadiran::findOrFail($id);
    $datakehadirans->update(['hadir' => 'x']);

    return redirect()->route('datakehadiran.datakehadiran.index')
        ->with('success_message', 'Rekod berjaya dikemaskini!');
}



public function exportdatakehadiranToExcel()
{
    // Fetch your data
    $data = DataKehadiran::all();

    // Define the file name
    $fileName = 'data_kehadiran.csv';

    // Define CSV content
    $csv = "Kategori,Sekolah_Institusi,Nama,ICNO_SKBNO,Pelajar_Pengawas,Status,Catatan\n";

    // Add data rows
    foreach ($data as $row) {
        $pelajarPengawas = "";
        if (strcasecmp($row->type_pelajar_pengawas, "p") === 0 || strcasecmp($row->type_pelajar_pengawas, "ph") === 0) {
            $pelajarPengawas = "Pelajar";
        } elseif (strcasecmp($row->type_pelajar_pengawas, "g") === 0 || strcasecmp($row->type_pelajar_pengawas, "gh") === 0 || strcasecmp($row->type_pelajar_pengawas, "gp") === 0) {
            $pelajarPengawas = "Pengawas";
        } elseif (strcasecmp($row->type_pelajar_pengawas, "pu") === 0) {
            $pelajarPengawas = "Pegawai Uniform";
        }

        $status = "";
        if (!empty($row->hadir)) {
             $status = $row->hadir === "1" ? "Hadir" : (strtolower($row->status) === "x" ? "Tidak hadir" : "");
        }

        $csv .= '"' . str_replace('"', '""', $row->kategori) . '","' .
                str_replace('"', '""', $row->sekolah_institusi) . '","' .
                str_replace('"', '""', $row->nama_pelajar_pengawas) . '","' .
                str_replace('"', '""', $row->icno_skbno) . '","' .
                $pelajarPengawas . '","' .
                $status . '","' .
                str_replace('"', '""', $row->catatan) . "\"\n";
    }

    // Generate response
    return Response::make($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
    ]);
}

public function exportschoolstat()
{
    // Fetch your data
    $dkschools = Datakehadiranschools::all();

    // Define the file name
    $fileName = 'dkschools.csv';

    // Define CSV content
    $csv = "Sekolah / Institusi,Status\n";

    // Add data rows
    foreach ($dkschools as $dkschool) {
        $status = 'completed';
        $dataKehadiran = Datakehadiran::where('sekolah_institusi', $dkschool->schools)
            ->where(function($query) {
                $query->whereNull('icno_skbno')
                    ->orWhere('icno_skbno', '')
                    ->orWhereNull('hadir')
                    ->orWhere('hadir', '');
            })
            ->exists();
        if ($dataKehadiran) {
            $status = 'in-progress';
        }
        $csv .= '"' . str_replace('"', '""', $dkschool->schools) . '","' .
            $status . "\"\n";
    }

    // Generate response
    return Response::make($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
    ]);
}



public function exportExcelBySchool()
{
    // Retrieve IC number of the authenticated user
    $icNos = Auth::user()->ic_no;

    // Fetch schools associated with the given IC numbers
    $dkschools = Datakehadiranschools::whereJsonContains('icno', $icNos)->get();

    // Check if no schools are found for the user
    if ($dkschools->isEmpty()) {
        // Return empty CSV response
        return response()->make('', 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="empty_data_kehadiran.csv"',
        ]);
    }

    // Fetch data_kehadiran entries related to the extracted schools
    $datakehadiranindividual = Datakehadiran::select('data_kehadiran.*')
        ->where(function ($query) use ($dkschools) {
            foreach ($dkschools as $dkschool) {
                $query->orWhere('sekolah_institusi', 'like', '%' . $dkschool->schools . '%');
            }
        })
        ->orderBy('created_at', 'DESC')
        ->get();

    // Define the file name
    $fileName = 'data_kehadiran_by_school.csv';

    // Define CSV content
    $csv = "Kategori,Sekolah_Institusi,Nama,icno_skb,Pelajar_Pengawas,Status,Catatan\n";

    // Add data rows
    foreach ($datakehadiranindividual as $row) {
        $pelajar_pengawas = '';
        if (in_array(strtoupper($row->type_pelajar_pengawas), ['P', 'PH'])) {
            $pelajar_pengawas = 'Pelajar';
        } elseif (in_array(strtoupper($row->type_pelajar_pengawas), ['G', 'GH', 'GP'])) {
            $pelajar_pengawas = 'Pengawas';
        } elseif (strtoupper($row->type_pelajar_pengawas) === 'PU') {
            $pelajar_pengawas = 'Pegawai Uniform';
        }

        $status = '';
        if ($row->hadir === '1') {
            $status = 'Hadir';
        } elseif ($row->hadir === 'x') {
            $status = 'Tidak hadir';
        }

        $csv .= '"' . str_replace('"', '""', $row->kategori) . '","' .
                str_replace('"', '""', $row->sekolah_institusi) . '","' .
                str_replace('"', '""', $row->nama_pelajar_pengawas) . '","' .
                str_replace('"', '""', $row->icno_skbno) . '","' .
                $pelajar_pengawas . '","' .
                $status . '","' .
                str_replace('"', '""', $row->catatan) . "\"\n";
    }

    // Generate response
    return response()->make($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
    ]);
}


public function exportExcelByUniform()
{
    // Retrieve IC number of the authenticated user
    $icNos = Auth::user()->ic_no;

    // Fetch schools associated with the given IC numbers
    $dkschools = Datakehadiranschools::whereJsonContains('icno', $icNos)->get();

    // Fetch data_kehadiran entries related to the extracted schools and Pasukan Beruniform category
    $datakehadiranindividual = Datakehadiran::select('data_kehadiran.*')
        ->where('kategori', 'Pasukan Beruniform')
        ->orderBy('created_at', 'DESC')
        ->get();

    // Define the file name
    $fileName = 'data_kehadiran_by_uniform.csv';

    // Define CSV content
    $csv = "Kategori,Nama,ICNO_SKBNO,Pelajar_Pengawas,Status,Catatan\n";

    // Add data rows
    foreach ($datakehadiranindividual as $row) {
        $pelajarPengawas = "";
        if (strcasecmp($row->type_pelajar_pengawas, "p") === 0 || strcasecmp($row->type_pelajar_pengawas, "ph") === 0) {
            $pelajarPengawas = "Pelajar";
        } elseif (strcasecmp($row->type_pelajar_pengawas, "g") === 0 || strcasecmp($row->type_pelajar_pengawas, "gh") === 0 || strcasecmp($row->type_pelajar_pengawas, "gp") === 0) {
            $pelajarPengawas = "Pengawas";
        } elseif (strcasecmp($row->type_pelajar_pengawas, "pu") === 0) {
            $pelajarPengawas = "Pegawai Uniform";
        }

        $status = "";
        if (!empty($row->hadir)) {
            $status = $row->hadir === "1" ? "Hadir" : ($row->status === "x" ? "Tidak hadir" : "");
        }

        $csv .= '"' . str_replace('"', '""', $row->kategori) . '","' .
                str_replace('"', '""', $row->nama_pelajar_pengawas) . '","' .
                str_replace('"', '""', $row->icno_skbno) . '","' .
                $pelajarPengawas . '","' .
                $status . '","' .
                str_replace('"', '""', $row->catatan) . "\"\n";
    }

    // Generate response
    return Response::make($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
    ]);
}

public function exportExcelByHadrah()
{
    // Retrieve IC number of the authenticated user
    $icNos = Auth::user()->ic_no;

    // Fetch schools associated with the given IC numbers
    $dkschools = Datakehadiranschools::whereJsonContains('icno', $icNos)->get();

    // Fetch data_kehadiran entries related to the extracted schools and Pasukan Beruniform category
    $datakehadiranindividual = Datakehadiran::select('data_kehadiran.*')
        ->where('pasukan', 'Pasukan Hadrah')
        ->orderBy('created_at', 'DESC')
        ->get();

    // Define the file name
    $fileName = 'data_kehadiran_by_Hadrah.csv';

    // Define CSV content
    $csv = "id,Kategori,Sekolah_Institusi,Nama,ICNO_SKBNO,Pelajar_Pengawas,Status,Catatan\n";

    // Add data rows
    foreach ($datakehadiranindividual as $row) {
        $pelajarPengawas = "";
        if (strcasecmp($row->type_pelajar_pengawas, "p") === 0 || strcasecmp($row->type_pelajar_pengawas, "ph") === 0) {
            $pelajarPengawas = "Pelajar";
        } elseif (strcasecmp($row->type_pelajar_pengawas, "g") === 0 || strcasecmp($row->type_pelajar_pengawas, "gh") === 0 || strcasecmp($row->type_pelajar_pengawas, "gp") === 0) {
            $pelajarPengawas = "Pengawas";
        } elseif (strcasecmp($row->type_pelajar_pengawas, "pu") === 0) {
            $pelajarPengawas = "Pegawai Uniform";
        }

        $status = "";
        if (!empty($row->hadir)) {
            $status = $row->hadir === "1" ? "Hadir" : ($row->status === "x" ? "Tidak hadir" : "");
        }

        $csv .= '"' . str_replace('"', '""', $row->id) . '","' .
                str_replace('"', '""', $row->kategori) . '","' .
                str_replace('"', '""', $row->sekolah_institusi) . '","' .
                str_replace('"', '""', $row->nama_pelajar_pengawas) . '","' .
                str_replace('"', '""', $row->icno_skbno) . '","' .
                $pelajarPengawas . '","' .
                $status . '","' .
                str_replace('"', '""', $row->catatan) . "\"\n";
    }

    // Generate response
    return Response::make($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
    ]);
}

public function exportExcelBypegawai()
{
    // Retrieve IC number of the authenticated user
    $icNos = Auth::user()->ic_no;

    // Fetch schools associated with the given IC numbers
    $dkschools = Datakehadiranschools::whereJsonContains('icno', $icNos)->get();

    // Fetch data_kehadiran entries related to the extracted schools and Pasukan Beruniform category
    $datakehadiranindividual = Datakehadiran::select('data_kehadiran.*')
        ->where('kategori', 'PEGAWAI & KAKITANGAN')
        ->orderBy('created_at', 'DESC')
        ->get();

    // Define the file name
    $fileName = 'data_kehadiran_by_pegawai.csv';

    // Define CSV content
    $csv = "Kategori,Nama,ICNO_SKBNO,Pelajar_Pengawas,Status,Catatan\n";

    // Add data rows
    foreach ($datakehadiranindividual as $row) {
        $pelajarPengawas = "";
        if (strcasecmp($row->type_pelajar_pengawas, "p") === 0 || strcasecmp($row->type_pelajar_pengawas, "ph") === 0) {
            $pelajarPengawas = "Pelajar";
        } elseif (strcasecmp($row->type_pelajar_pengawas, "g") === 0 || strcasecmp($row->type_pelajar_pengawas, "gh") === 0 || strcasecmp($row->type_pelajar_pengawas, "gp") === 0) {
            $pelajarPengawas = "Pengawas";
        } elseif (strcasecmp($row->type_pelajar_pengawas, "pu") === 0) {
            $pelajarPengawas = "Pegawai Uniform";
        }

        $status = "";
        if (!empty($row->hadir)) {
            $status = $row->hadir === "1" ? "Hadir" : ($row->status === "x" ? "Tidak hadir" : "");
        }

        $csv .= '"' . str_replace('"', '""', $row->kategori) . '","' .
                str_replace('"', '""', $row->nama_pelajar_pengawas) . '","' .
                str_replace('"', '""', $row->icno_skbno) . '","' .
                $pelajarPengawas . '","' .
                $status . '","' .
                str_replace('"', '""', $row->catatan) . "\"\n";
    }

    // Generate response
    return Response::make($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
    ]);
}






public function storecreatedebug(Request $request)
{
    // Get the data from the request
    $kategori = (array) $request->input('kategori');
    $sekolah_institusi = (array) $request->input('sekolah_institusi');
    $nama_pelajar_pengawas = (array) $request->input('nama_pelajar_pengawas');
    $icno_skbno = (array) $request->input('icno_skbno');
    $type_pelajar_pengawas = (array) $request->input('type_pelajar_pengawas');
    $hadir = (array) $request->input('hadir');
    $pasukan = (array) $request->input('pasukan');
    $pindah = (array) $request->input('pindah');
    $catatan = (array) $request->input('catatan');

    // Debugging: Output received data
    dd([
        'kategori' => $kategori,
        'sekolah_institusi' => $sekolah_institusi,
        'nama_pelajar_pengawas' => $nama_pelajar_pengawas,
        'icno_skbno' => $icno_skbno,
        'type_pelajar_pengawas' => $type_pelajar_pengawas,
        'hadir' => $hadir,
        'pasukan' => $pasukan,
        'pindah' => $pindah,
        'catatan' => $catatan
    ]);

    // Further code for saving data
}


public function storecreate(Request $request)
{

    $icNos = Auth::user()->ic_no;

    // Get the data from the request
    $kategori = (array) $request->input('kategori');
    $sekolah_institusi = (array) $request->input('sekolah_institusi');
    $nama_pelajar_pengawas = (array) $request->input('nama_pelajar_pengawas');
    $icno_skbno = (array) $request->input('icno_skbno');
    $type_pelajar_pengawas = (array) $request->input('type_pelajar_pengawas');
    $hadir = (array) $request->input('hadir');
    $pasukan = (array) $request->input('pasukan');
    $pindah = (array) $request->input('pindah');
    $catatan = (array) $request->input('catatan');

    $now = now(); // Current timestamp

    $insert_data = []; // Initialize the array before the loop

    foreach ($kategori as $key => $value) {
        $data = array(
            'kategori' => $value,
            'sekolah_institusi' => $sekolah_institusi[$key] ?? null,
            'nama_pelajar_pengawas' => $nama_pelajar_pengawas[$key] ?? null,
            'icno_skbno' => $icno_skbno[$key] ?? null,
            'type_pelajar_pengawas' => $type_pelajar_pengawas[$key] ?? null,
            'pasukan' => $pasukan[$key] ?? null,
            'pindah' => $pindah[$key] ?? null,
            'catatan' => $catatan[$key] ?? null,
            'updated_by' => $icNos,
            'created_at' => $now,
            'updated_at' => $now
        );

        $insert_data[] = $data;
    }

    // Save the data
    Datakehadiran::insert($insert_data);

    return redirect()->route('datakehadiran.datakehadiran.indexadmin')
        ->with('success_message', 'Data records were successfully added!');
}


public function storein(Request $request)
{

    $icNos = Auth::user()->ic_no;

    // Get the data from the request
    $kategori = (array) $request->input('kategori');
    $sekolah_institusi = (array) $request->input('sekolah_institusi');
    $nama_pelajar_pengawas = (array) $request->input('nama_pelajar_pengawas');
    $icno_skbno = (array) $request->input('icno_skbno');
    $type_pelajar_pengawas = (array) $request->input('type_pelajar_pengawas');
    $hadir = (array) $request->input('hadir');
    $pasukan = (array) $request->input('pasukan');
    $pindah = (array) $request->input('pindah');
    $catatan = (array) $request->input('catatan');

    $now = now(); // Current timestamp

    $insert_data = []; // Initialize the array before the loop

    foreach ($kategori as $key => $value) {
        $data = array(
            'kategori' => $value,
            'sekolah_institusi' => $sekolah_institusi[$key] ?? null,
            'nama_pelajar_pengawas' => $nama_pelajar_pengawas[$key] ?? null,
            'icno_skbno' => $icno_skbno[$key] ?? null,
            'type_pelajar_pengawas' => $type_pelajar_pengawas[$key] ?? null,
            'pasukan' => $pasukan[$key] ?? null,
            'pindah' => $pindah[$key] ?? null,
            'catatan' => $catatan[$key] ?? null,
            'updated_by' => $icNos,
            'created_at' => $now,
            'updated_at' => $now
        );

        $insert_data[] = $data;
    }

    // Save the data
    Datakehadiran::insert($insert_data);

    return redirect()->route('datakehadiran.datakehadiran.index')
        ->with('success_message', 'Data records were successfully added!');
}

public function storecreateparticipate(Request $request)
{

    $icNos = Auth::user()->ic_no;

    // Get the data from the request
    $kategori = (array) $request->input('kategori');
    $sekolah_institusi = (array) $request->input('sekolah_institusi');
    $nama_pelajar_pengawas = (array) $request->input('nama_pelajar_pengawas');
    $icno_skbno = (array) $request->input('icno_skbno');
    $type_pelajar_pengawas = (array) $request->input('type_pelajar_pengawas');
    $hadir = (array) $request->input('hadir');
    $pasukan = (array) $request->input('pasukan');
    $pindah = (array) $request->input('pindah');
    $catatan = (array) $request->input('catatan');

    $now = now(); // Current timestamp

    $insert_data = []; // Initialize the array before the loop

    foreach ($kategori as $key => $value) {
        $data = array(
            'kategori' => $value,
            'sekolah_institusi' => $sekolah_institusi[$key] ?? null,
            'nama_pelajar_pengawas' => $nama_pelajar_pengawas[$key] ?? null,
            'icno_skbno' => $icno_skbno[$key] ?? null,
            'type_pelajar_pengawas' => $type_pelajar_pengawas[$key] ?? null,
            'pasukan' => $pasukan[$key] ?? null,
            'pindah' => $pindah[$key] ?? null,
            'catatan' => $catatan[$key] ?? null,
            'updated_by' => $icNos,
            'created_at' => $now,
            'updated_at' => $now
        );

        $insert_data[] = $data;
    }

    // Save the data
    Datakehadiran::insert($insert_data);

    return redirect()->route('datakehadiran.datakehadiran.indexuniform')
        ->with('success_message', 'Data records were successfully added!');
}

public function storehadrah(Request $request)
{

    $icNos = Auth::user()->ic_no;

    // Get the data from the request
    $kategori = (array) $request->input('kategori');
    $sekolah_institusi = (array) $request->input('sekolah_institusi');
    $nama_pelajar_pengawas = (array) $request->input('nama_pelajar_pengawas');
    $icno_skbno = (array) $request->input('icno_skbno');
    $type_pelajar_pengawas = (array) $request->input('type_pelajar_pengawas');
    $hadir = (array) $request->input('hadir');
    $pasukan = (array) $request->input('pasukan');
    $pindah = (array) $request->input('pindah');
    $catatan = (array) $request->input('catatan');

    $now = now(); // Current timestamp

    $insert_data = []; // Initialize the array before the loop

    foreach ($kategori as $key => $value) {
        $data = array(
            'kategori' => $value,
            'sekolah_institusi' => $sekolah_institusi[$key] ?? null,
            'nama_pelajar_pengawas' => $nama_pelajar_pengawas[$key] ?? null,
            'icno_skbno' => $icno_skbno[$key] ?? null,
            'type_pelajar_pengawas' => $type_pelajar_pengawas[$key] ?? null,
            'pasukan' => $pasukan[$key] ?? null,
            'pindah' => $pindah[$key] ?? null,
            'catatan' => $catatan[$key] ?? null,
            'updated_by' => $icNos,
            'created_at' => $now,
            'updated_at' => $now
        );

        $insert_data[] = $data;
    }

    // Save the data
    Datakehadiran::insert($insert_data);

    return redirect()->route('datakehadiran.datakehadiran.indexhadrah')
        ->with('success_message', 'Data records were successfully added!');
}

public function destroy($id){
    try {

    $datakehadiran = Datakehadiran::where('id', $id)->delete();

    // $ssmpermohonansalinanicnos = Moeevent::where('event', $id)->delete();

    return redirect()->back()->with('success_message', 'Record deleted successfully.');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
    }
}

public function destroyadmin($id){
    try {

    $datakehadiran = Datakehadiran::where('id', $id)->delete();

    // $ssmpermohonansalinanicnos = Moeevent::where('event', $id)->delete();

    return redirect()->back()->with('success_message', 'Record deleted successfully.');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
    }
}

public function destroyadminsearch($id){
    try {

    $datakehadiran = Datakehadiran::where('id', $id)->delete();


       
        return redirect()->back()->with('success_message', 'Record deleted successfully.');
           
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
    }
}

public function destroyuniform($id){
    try {

    $datakehadiran = Datakehadiran::where('id', $id)->delete();

    

    return redirect()->back()->with('success_message', 'Record deleted successfully.');
           
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
    }

}

public function destroyhadrah($id){
    try {

    $datakehadiran = Datakehadiran::where('id', $id)->delete();

    

    return redirect()->back()->with('success_message', 'Record deleted successfully.');
           
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
    }

}








}
