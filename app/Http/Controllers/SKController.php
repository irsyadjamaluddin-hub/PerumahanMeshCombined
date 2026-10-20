<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Biodata;
use App\Models\Employment;
use App\Models\User;
use App\Models\Feedback;
// use App\Models\PeruntukanBersara;
use App\Models\Terminationtype;
use App\Models\Retirementposition;

// use App\Models\Employment;
use App\Models\Department;
use App\Models\SKPerkara;
// use App\Models\Borang;
use App\Models\SlipKedatangan;


use Log;
use Carbon\Carbon;

use App\Exports\ExportExcel; // Import your export class
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet; // Add this import statement
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Dompdf\Options;


class SKController extends Controller
{
    /**
 * Display a listing of the Biodata applications.
 *
 * @return Illuminate\View\View
 */


public function index()
{             
    $departments = Department::pluck('id', 'label')->all();

    return view('slipkedatangan.index', compact('departments'));
}


// public function indexadmin()
// {
//     $departments = Department::pluck('id', 'label')->all();
//     $borangs = SlipKedatangan::select('slipkedatangan.*')->orderBy('created_at', 'DESC')->get();
//     $skperkaras = SKPerkara::all();
//     $perkaradropdown = SKPerkara::pluck('label', 'label')->all();

//     return view('slipkedatangan.indexadmin', compact('departments','borangs','skperkaras', 'perkaradropdown'));
// }


#==========================================================

public function indexadmin()
{

    $user = Auth::user();


    $departments = Department::pluck('id','label')->all();


    if($user && $user->role == 'admin')
    {

        // get admin department from biodata

        $jabatan = Biodata::where('ic_no',$user->ic_no)
                          ->value('jabatan');


        // only show same department

        $borangs = SlipKedatangan::where('jabatan',$jabatan)
                    ->orderBy('created_at','DESC')
                    ->get();

    }
    else
    {

        // normal user sees everything

        $borangs = SlipKedatangan::orderBy('created_at','DESC')
                    ->get();

    }



    if ($user && $user->hasRole('ROLE_SUPERADMIN')) {

        // Superadmin sees every Perkara, across all departments

        $skperkaras = SKPerkara::all();

    } else {

        // Everyone else only sees Perkara belonging to their own department

        $jabatan = null;

        if ($user) {
            $employment = Employment::where('ic_no', $user->ic_no)->first();
            $jabatan = $employment ? Department::where('id', $employment->department_id)->value('label') : null;
        }

        $skperkaras = SKPerkara::where('jabatan', $jabatan)->get();

    }


    $perkaradropdown = SKPerkara::pluck('label','label')->all();



    return view(
        'slipkedatangan.indexadmin',
        compact(
            'departments',
            'borangs',
            'skperkaras',
            'perkaradropdown'
        )
    );

}

#====== NEWLY ADDED ========
#================ SHARE PERKARA BY IC NO. — "SHARED WITH ME" (mirrors FileSystemController@showSharedFolders) ================
# Lists every Perkara whose shared_with column contains the current user's IC No.
# Reached from the "Shared With Me" button on slipkedatangan/indexadmin.blade.php.

public function sharedWithMe()
{
    $user = Auth::user();

    $sharedPerkaras = $user
        ? SKPerkara::where('shared_with', 'like', '%' . $user->ic_no . '%')->get()
        : collect();

    return view('slipkedatangan.sharedperkara', compact('sharedPerkaras'));
}
#====== ========.

#===============================================================================

#===============================================================================

public function showslip(SKPerkara $skperkara) {
    $slips = $skperkara->slipkedatangans()->get();
    $statuses = ['active', 'inactive'];

    return view('slipkedatangan.showslip', compact('skperkara', 'slips', 'statuses'));
}

#====== NEWLY ADDED ========
#================ SHARE PERKARA BY IC NO. — "GRANT ACCESS" (mirrors FileSystemController) ================
# This whole block is the "cc someone by their IC No." feature: it lets an admin give another
# user (identified only by IC No., stored as a CSV string in SKPerkara.shared_with) visibility
# into a Perkara's attendance slips, without changing that user's role or department.
# Views: slipkedatangan/accessske.blade.php (grant form), slipkedatangan/access_users.blade.php
#        (manage/revoke), slipkedatangan/sharedperkara.blade.php (recipient's "Shared With Me" list)

# Shows the "Grant Access" form (list of IC Nos. already shared, plus room to add more).
public function grantAccess(SKPerkara $skperkara)
{
    $icNos = $skperkara->shared_with ? explode(',', $skperkara->shared_with) : [];

    return view('slipkedatangan.accessske', compact('skperkara', 'icNos'));
}

// Merges newly-submitted IC Nos. into the existing shared_with CSV (deduped via array_unique).
public function storeAccess(Request $request, SKPerkara $skperkara)
{
    $request->validate([
        'ic_no' => 'required|array',
        'ic_no.*' => 'required|digits:8|exists:users,ic_no',
    ]);

    $sharedWith = $skperkara->shared_with ? explode(',', $skperkara->shared_with) : [];

    $newIcNos = $request->input('ic_no');

    $mergedIcNos = array_unique(array_merge($sharedWith, $newIcNos));

    $skperkara->update(['shared_with' => implode(',', $mergedIcNos)]);

    return redirect()->route('sk.slipkedatangan.showAccessUsers', $skperkara->id)
        ->with('success_message', 'Access granted successfully.');
}

// Lists the IC Nos. currently shared on a Perkara, each with a revoke button.
public function showAccessUsers(SKPerkara $skperkara)
{
    $sharedUsers = $skperkara->shared_with ? explode(',', $skperkara->shared_with) : [];

    return view('slipkedatangan.access_users', compact('skperkara', 'sharedUsers'));
}

// Removes one IC No. from the shared_with CSV (array_diff), revoking that user's access.
public function revokeAccess(SKPerkara $skperkara, $icNo)
{
    if ($skperkara->shared_with) {
        $sharedWith = explode(',', $skperkara->shared_with);

        $updatedSharedWith = array_diff($sharedWith, [$icNo]);

        $skperkara->update(['shared_with' => implode(',', $updatedSharedWith)]);
    }

    return redirect()->route('sk.slipkedatangan.showAccessUsers', $skperkara->id)
        ->with('success_message', 'Access revoked successfully.');
}

// AJAX endpoint used by accessske/access_users' JS to validate a typed IC No. exists in `users` before submit.
public function checkIcExists(Request $request)
{
    $icNo = $request->query('ic_no');

    $exists = $icNo ? User::where('ic_no', $icNo)->exists() : false;

    return response()->json(['exists' => $exists]);
}
#====== ========.

public function createevent() {
    $skperkaras = SKPerkara::all();
    $statuses = ['active', 'inactive'];
    return view('slipkedatangan.createevent', compact('skperkaras', 'statuses'));
}

public function updateslip(SKPerkara $skperkara) {
    $tarikh_bermula = request('tarikh_bermula');
    $tarikh_berakhir = request('tarikh_berakhir');

    // Convert to proper format: 'Y-m-d H:i:s'
    $formatted_tarikh_bermula = $tarikh_bermula ? date('Y-m-d H:i:s', strtotime($tarikh_bermula)) : null;
    $formatted_tarikh_berakhir = $tarikh_berakhir ? date('Y-m-d H:i:s', strtotime($tarikh_berakhir)) : null;

    $skperkara->update([
        'label' => request('label'),
        'tarikh_bermula' => $formatted_tarikh_bermula,
        'tarikh_berakhir' => $formatted_tarikh_berakhir,
        'status' => request('status'),
    ]);

    return redirect()->route('sk.slipkedatangan.showslip', $skperkara->id)
        ->with('success_message', 'Updated successfully.');
}


public function isiborang()
{
    $currentDate = Carbon::now();
    
    // Fetch departments
    $skperkaras = SKPerkara::where('tarikh_berakhir', '>=', $currentDate)->get();
    $departments = Department::all();

    $peranans = [
        'Pengerusi',
        'Ahli',
        'Setiausaha',
        'Urusetia',
        'Ketua Jabatan',
        'Wakil Jabatan',
        'Hadir'
    ];

    return view('slipkedatangan', compact('departments','skperkaras', 'peranans'));
}


public function storeperkara(){
    request()->validate([
        'label' => 'required',
    ], [
        'label.required' => 'Please fill in Perkara!'
    ]);

    $tarikh_bermula = request('tarikh_bermula');
    $tarikh_berakhir = request('tarikh_berakhir');

    $formatted_tarikh_bermula = $tarikh_bermula ? date('Y-m-d H:i:s', strtotime($tarikh_bermula)) : null;
    $formatted_tarikh_berakhir = $tarikh_berakhir ? date('Y-m-d H:i:s', strtotime($tarikh_berakhir)) : null;

    SKPerkara::create([
        'label' => request('label'),
        'tarikh_bermula' => $formatted_tarikh_bermula,
        'tarikh_berakhir' => $formatted_tarikh_berakhir,
        'status' => request('status'),
    ]);

    return redirect()->route('sk.slipkedatangan.indexadmin')
            ->with('success_message', 'Perkara was updated!');
}



// public function store()
public function store(Request $request)
{
    $skperkara = SKPerkara::where('label', request('perkara'))->first();
    
    request()->validate([
        'perkara' => 'required',
        'jabatan' => 'required',
        'nama' => 'required',
        'rolelabel' => 'required',
        'cc_ic' => 'nullable|string',           #======================= NEWLY ADDED ================
        // 'jawatan' => 'required',
        // 'email' => 'required',
        // 'remark' => 'required',
]);


    $borang = SlipKedatangan::create([
        'perkara' => request('perkara'),
        'jabatan' => request('jabatan'),
        'nama' => request('nama'),
        'rolelabel' => request('rolelabel'),
        'email' => request('email'),
        'telefon' => request('telefon'),
        'remark' => request('remark'),
        's_k_perkara_id' => $skperkara->id,
    ]);

    // Seed the Perkara's own jabatan from its first submitter, if not already set
    if ($skperkara && empty($skperkara->jabatan)) {
        $skperkara->update(['jabatan' => request('jabatan')]);
    }


    #====================  NEWLY ADDED ======================================


// CC PEOPLE USING IC NUMBER

if(Auth::check() && Auth::user()->role == 'admin' && $request->filled('cc_ic'))
{

    // Split IC numbers
    $icNumbers = array_map(
        'trim',
        explode(',', $request->cc_ic)
    );


    // Find users from biodata table
    $ccUsers = Biodata::whereIn('ic_no', $icNumbers)
                      ->get();



    foreach($ccUsers as $user)
    {

        // Send CC email
        Mail::raw(
            "You have been CCed for Slip Kehadiran: ".$request->perkara,
            
            function($message) use ($user){

                $message->to($user->email)
                        ->subject('Slip Kehadiran Notification');

            }
        );


    }

}

#===============================================================================


    return redirect()->route('slipkehadiran')
        ->with('success_message', 'Borang telah berjaya dihantar');
}

public function showadmin(Request $request, $id)
    {
        $borangs = SlipKedatangan::select('slipkedatangan.*')
            ->where('id', $id)
            ->first();

        $departments = Department::pluck('id', 'label')->all();

        return view('slipkedatangan.showadmin', compact('departments','borangs'));
    }

     public function destroyperkara($id)
    {
        try {


          $pst= SKPerkara::where('id', $id)->delete();

            return redirect()->route('sk.slipkedatangan.indexadmin')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function exportToExcel(Request $request)
{
    $filter = $request->input('filter'); // Assuming you're using 'filter' as the input name
    
    // Apply the filter to your query to get the filtered data
    $filteredData = SlipKedatangan::where('perkara', 'like', "%$filter%")->get();
    // $filteredData = SlipKedatangan::where(function ($query) use ($filter) {
    //     $query->where('perkara', 'like', "%$filter%");
            
    // })->get();

    // Create a new spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Perkara');
    $sheet->setCellValue('B1', 'Nama');
    $sheet->setCellValue('C1', 'Jabatan');
    $sheet->setCellValue('D1', 'Tarikh');
    $sheet->setCellValue('E1', 'Catatan');
    $sheet->setCellValue('F1', 'Emel');

    // Loop through your filtered data and add it to the Excel file
    $row = 2;
    foreach ($filteredData as $borang) {
        $sheet->setCellValue('A' . $row, $borang->perkara);
        $sheet->setCellValue('B' . $row, $borang->nama);
        $sheet->setCellValue('C' . $row, $borang->jabatan);
        $sheet->setCellValue('D' . $row, $borang->created_at);
        $sheet->setCellValue('E' . $row, $borang->remark);
        $sheet->setCellValue('F' . $row, $borang->email);
        $row++;
    }

    // Create the Excel file
    $writer = new Xlsx($spreadsheet);
    $filename = 'exported_data.xlsx';

    return response()->stream(
        function () use ($writer) {
            $writer->save('php://output');
        },
        200,
        [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="exported_data.xlsx"',
        ]
    );
}

public function exportToPdf(Request $request)
{
    $filter = $request->input('filter');

    // Get and format dates
    $skperkaras = SKPerkara::where('label', $filter)->pluck('tarikh_bermula');

    $formattedDates = $skperkaras->map(function ($date) {
        return date('d-m-Y', strtotime($date));
    })->toArray();
    $date = $formattedDates[0] ?? ''; // Get the first date, or an empty string if none

    $formattedTimes = $skperkaras->map(function ($date) {
    $time = date('h:i A', strtotime($date));

    // Replace AM/PM with Malay versions
    $time = str_replace('AM', 'Pagi', $time);
    $time = str_replace('PM', 'Petang', $time);

    return $time;
})->toArray();

    $time = $formattedTimes[0] ?? ''; // Get the first time, or an empty string if none

    // Get filtered data
    $filteredData = SlipKedatangan::where('perkara', 'like', "%$filter%")->get();

    // Create PDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    // HTML content
    $pdfContent = '
    <html>
    <head>
        <style>
            body {
                font-family: DejaVu Sans, sans-serif;
                font-size: 12px;
            }

            .title-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .title-table td {
                padding: 4px;
                font-weight: bold;
            }

            .attendance-table {
                width: 100%;
                border-collapse: collapse;
            }

            .attendance-table th, .attendance-table td {
                border: 1px solid #000;
                padding: 5px;
            }

            .attendance-table th {
                background: #f2f2f2;
                text-align: center;
                font-weight: bold;
            }

            .center {
                text-align: center;
            }
        </style>
    </head>

    <body>

    <!-- TOP TITLE SECTION -->
    <table class="title-table">
        <tr>
            <td style="width: 20%;">TAJUK MESYUARAT</td>
            <td>:  '.$filter.'</td>
        </tr>
        <tr>
            <td>HARI / TARIKH</td>
            <td>: '.$date.'</td>
        </tr>
        <tr>
            <td>JAM</td>
            <td>: '.$time.'</td>
        </tr>
    </table>

    <!-- MAIN TABLE -->
    <table class="attendance-table">
        <tr>
            <th style="width: 10%;">BIL</th>
            <th style="width: 22.5%;">NAMA</th>
            <th style="width: 22.5;">JAWATAN</th>
            <th style="width: 22.5%;">JABATAN</th>
            <th style="width: 22.5%;">EMEL / TELEFON</th>
        </tr>';

    $bil = 1;
    foreach ($filteredData as $borang) {
        $pdfContent .= '
        <tr>
            <td class="center">'.$bil++.'</td>
            <td>'.$borang->nama.'</td>
            <td>'.$borang->rolelabel.'</td>
            <td>'.$borang->jabatan.'</td>
            <td>'.$borang->email.'</td>
        </tr>';
    }

    $pdfContent .= '
    </table>
    </body>
    </html>';

    // Output PDF
    $dompdf->loadHtml($pdfContent);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("attendance_list.pdf", ["Attachment" => false]); // Display in browser
}

// public function exportToPdf(Request $request)
// {
//     $filter = $request->input('filter');

//     // Apply the filter to your query to get the filtered data
//     $filteredData = SlipKedatangan::where('perkara', 'like', "%$filter%")->get();

//     // Create a new PDF document
//     $options = new Options();
//     $options->set('isHtml5ParserEnabled', true);
//     $options->set('isPhpEnabled', true);
//     $dompdf = new Dompdf($options);

//     // HTML content for the PDF
//     $pdfContent = '<html><head><style>
//         table {
//             width: 100%;
//             border-collapse: collapse;
//         }
//         th, td {
//             border: 1px solid #000;
//             padding: 5px;
//         }
//     </style></head><body>';
//     $pdfContent .= '<table>';
//     $pdfContent .= '<tr><th>Perkara</th><th>Nama</th><th>Jabatan</th><th>Tarikh</th><th>Catatan</th></tr>';

//     foreach ($filteredData as $borang) {
//         $pdfContent .= '<tr>';
//         $pdfContent .= '<td>' . $borang->perkara . '</td>';
//         $pdfContent .= '<td>' . $borang->nama . '</td>';
//         $pdfContent .= '<td>' . $borang->jabatan . '</td>';
//         $pdfContent .= '<td>' . $borang->created_at . '</td>';
//         $pdfContent .= '<td>' . $borang->remark . '</td>';
//         $pdfContent .= '</tr>';
//     }

//     $pdfContent .= '</table></body></html>';

//     // Load the HTML content into Dompdf
//     $dompdf->loadHtml($pdfContent);

//     // Set paper size and orientation (e.g., 'A4', 'portrait')
//     $dompdf->setPaper('A4', 'portrait');

//     // Render the PDF (first step)
//     $dompdf->render();

//     // Stream the PDF to the client
//     return Response::stream(
//         function () use ($dompdf) {
//             $dompdf->stream('exported_data.pdf', [
//                 'Attachment' => true,
//             ]);
//         },
//         200,
//         [
//             'Content-Type' => 'application/pdf',
//         ]
//     );
// }


}
