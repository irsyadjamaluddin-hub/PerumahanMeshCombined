<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

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


public function indexadmin()
{
    $departments = Department::pluck('id', 'label')->all();
    $borangs = SlipKedatangan::select('slipkedatangan.*')->orderBy('created_at', 'DESC')->get();
    $skperkara = SKPerkara::select('skperkara.*')->orderBy('id', 'DESC')->get();
    $perkaradropdown = SKPerkara::pluck('label', 'label')->all();

    return view('slipkedatangan.indexadmin', compact('departments','borangs','skperkara','perkaradropdown'));
}

public function isiborang()
{
    // Fetch departments
    $departments = Department::pluck('label', 'id')->all();

    // Find the index of ID 7
    $index = array_search(7, array_keys($departments));

    if ($index !== false) {
        // Insert the new item before ID 7
        $newDepartments = array_slice($departments, 0, $index, true) +
                          [199 => 'Pejabat Timbalan Setiausaha Tetap (Dasar dan Korporat)'] +
                          array_slice($departments, $index, null, true);
        
        $departments = $newDepartments;
    }    $perkara = SKPerkara::pluck('label','id')->all();

    return view('slipkedatangan', compact('departments','perkara'));
}

public function storeperkara(Request $request){

        $skperkara = new SKPerkara;

        $skperkara-> label = $request->label;

        $skperkara->save();

        return redirect()->route('sk.slipkedatangan.indexadmin')
                ->with('success_message', 'Perkara was updated!');

    }


public function store(Request $request)
{
    $request->validate([
        'perkara' => 'required',
        'jabatan' => 'required',
        'nama' => 'required',
        // 'rolelabel' => 'required',
        // 'jawatan' => 'required',
        // 'email' => 'required',
        // 'remark' => 'required',
]);
 
    $borang = new SlipKedatangan;

        $borang->perkara = $request->perkara;
        $borang->jabatan = $request->jabatan;
        $borang->nama = $request->nama;
        $borang->rolelabel = $request->rolelabel;
        // $borang->jawatan = $request->jawatan;
        $borang->email = $request->email;
        $borang->telefon = $request->telefon;
        $borang->remark = $request->remark;
        
        // $borang->file_name = $request->file_image->getClientOriginalName();
        // $borang-> file_image = $request->file('file_image')->store('borang', 'public');

        $borang->save();

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

    // Loop through your filtered data and add it to the Excel file
    $row = 2;
    foreach ($filteredData as $borang) {
        $sheet->setCellValue('A' . $row, $borang->perkara);
        $sheet->setCellValue('B' . $row, $borang->nama);
        $sheet->setCellValue('C' . $row, $borang->jabatan);
        $sheet->setCellValue('D' . $row, $borang->created_at);
        $sheet->setCellValue('E' . $row, $borang->remark);
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

    // Apply the filter to your query to get the filtered data
    $filteredData = SlipKedatangan::where('perkara', 'like', "%$filter%")->get();

    // Create a new PDF document
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    // HTML content for the PDF
    $pdfContent = '<html><head><style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
        }
    </style></head><body>';
    $pdfContent .= '<table>';
    $pdfContent .= '<tr><th>Perkara</th><th>Nama</th><th>Jabatan</th><th>Tarikh</th><th>Catatan</th></tr>';

    foreach ($filteredData as $borang) {
        $pdfContent .= '<tr>';
        $pdfContent .= '<td>' . $borang->perkara . '</td>';
        $pdfContent .= '<td>' . $borang->nama . '</td>';
        $pdfContent .= '<td>' . $borang->jabatan . '</td>';
        $pdfContent .= '<td>' . $borang->created_at . '</td>';
        $pdfContent .= '<td>' . $borang->remark . '</td>';
        $pdfContent .= '</tr>';
    }

    $pdfContent .= '</table></body></html>';

    // Load the HTML content into Dompdf
    $dompdf->loadHtml($pdfContent);

    // Set paper size and orientation (e.g., 'A4', 'portrait')
    $dompdf->setPaper('A4', 'portrait');

    // Render the PDF (first step)
    $dompdf->render();

    // Stream the PDF to the client
    return Response::stream(
        function () use ($dompdf) {
            $dompdf->stream('exported_data.pdf', [
                'Attachment' => true,
            ]);
        },
        200,
        [
            'Content-Type' => 'application/pdf',
        ]
    );
}


}
