<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Session;
use DB;
use Log;
use Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

use App\Exports\ExportExcel; // Import your export class
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet; // Add this import statement
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\SuspendedCompany;
use App\Models\SuspendedCompanyHistory;


class SuspendedCompanyController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $user = Auth::user();

        $icNos = Auth::user()->ic_no;

        $suspendedcompany = SuspendedCompany::select('suspended_company.*')
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('msc.mscindex', compact('user','suspendedcompany'));
    }

    public function admin()
    {
        $user = Auth::user();

        $icNos = Auth::user()->ic_no;

        $suspendedcompany = SuspendedCompany::select('suspended_company.*')
        ->orderBy('created_at', 'DESC')
        ->get();

        $suspendedhistory = SuspendedCompanyHistory::select('suspended_company_history.*')
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('msc.mscadmin', compact('user','suspendedcompany','suspendedhistory'));
    }

    public function mscform()
    {
        $user = Auth::user();

        return view('msc.mscform', compact('user'));
    }

    public function store(Request $request)
    {

        // Get the data from the request
        $nama_syarikat = $request->input('nama_syarikat');
        $kementerian = $request->input('kementerian');
        $tempoh_bulanan = $request->input('tempoh_bulanan');
        $bil_rujukan = $request->input('bil_rujukan');
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');
        $sebab = $request->input('sebab');

        $now = now(); // Current timestamp

        $insert_data = []; // Initialize the array before the loop

        for ($i = 0; $i < count($nama_syarikat); $i++) {
            $data = array(
                'nama_syarikat' => $nama_syarikat[$i],
                'kementerian' => $kementerian[$i],
                'tempoh_bulanan' => $tempoh_bulanan[$i],
                'bil_rujukan' => $bil_rujukan[$i],
                'date_start' => $date_start[$i],
                'date_end' => $date_end[$i],
                'sebab' => $sebab[$i],
                'created_at' => $now,
                'updated_at' => $now
            );

            $insert_data[] = $data;
        }

        // Save the data
        SuspendedCompany::insert($insert_data);

        return redirect()->route('msc.mscadmin')
            ->with('success_message', 'Data records were successfully added!');
    }

    public function destroy(Request $request, $id)
    {

        $icNos = Auth::user()->ic_no;

        try {
            // Find the SuspendedCompany record to delete
            $suspendedcompany = SuspendedCompany::findOrFail($id);

            // Create a new SuspendedCompanyHistory instance
            $history = new SuspendedCompanyHistory;

            $sebab_delete = $request->input('sebab_delete');

            // Copy the data from SuspendedCompany to SuspendedCompanyHistory
            $history->ic_no = $icNos;
            $history->nama_syarikat = $suspendedcompany->nama_syarikat;
            $history->kementerian = $suspendedcompany->kementerian;
            $history->bil_rujukan = $suspendedcompany->bil_rujukan;
            $history->sebab = $suspendedcompany->sebab;
            $history->date_start = $suspendedcompany->date_start;
            $history->date_end = $suspendedcompany->date_end;
            $history->sebab_delete = $sebab_delete;
            $history->created_at = now();

            // Save the data to the SuspendedCompanyHistory table
            $history->save();

            // Delete the data from the SuspendedCompany model
            $suspendedcompany->delete();

            return redirect()->back()
                            ->with('success_message', 'Company ID was successfully deleted!');
        } catch (Exception $exception) {
            return back()->withInput()
                        ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function exportToExcel(Request $request)
    {

        $suspendedcompany = SuspendedCompany::select('suspended_company.*')
        ->orderBy('id', 'ASC')
        ->get();

        // Create a new spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'nama_syarikat');
        $sheet->setCellValue('C1', 'kementerian');
        $sheet->setCellValue('D1', 'tempoh_bulanan');
        $sheet->setCellValue('E1', 'bil_rujukan');
        $sheet->setCellValue('F1', 'sebab');
        $sheet->setCellValue('G1', 'date_start');
        $sheet->setCellValue('H1', 'date_end');
        $sheet->setCellValue('I1', 'created_at');
        $sheet->setCellValue('J1', 'updated_at');

        $row=2;
        foreach ($suspendedcompany as $borang) {
            $sheet->setCellValue('A' . $row, $borang->id);
            $sheet->setCellValue('B' . $row, $borang->nama_syarikat);
            $sheet->setCellValue('C' . $row, $borang->kementerian);
            $sheet->setCellValue('D' . $row, $borang->tempoh_bulanan);
            $sheet->setCellValue('E' . $row, $borang->bil_rujukan);
            $sheet->setCellValue('F' . $row, $borang->sebab);
            $sheet->setCellValue('G' . $row, $borang->date_start->format('d/m/Y'));
            $sheet->setCellValue('H' . $row, $borang->date_end->format('d/m/Y'));
            $sheet->setCellValue('I' . $row, $borang->created_at);
            $sheet->setCellValue('J' . $row, $borang->updated_at);
            $row++;
        }

        // Set date format for columns G and H
        $sheet->getStyle('G2:G' . $row)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
        $sheet->getStyle('H2:H' . $row)->getNumberFormat()->setFormatCode('dd/mm/yyyy');

        // Generate a filename with the current datetime
        $currentDatetime = now()->format('d-m-Y');
        $filename = 'Tegahan_Excell_Data_' . $currentDatetime . '.xlsx';

        // Create the Excel file
        $writer = new Xlsx($spreadsheet);

        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }

}
