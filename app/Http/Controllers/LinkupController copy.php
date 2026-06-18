<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Session;
use DB;
use Log;
use Hash;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

use App\Models\Employment;
use App\Models\Biodata;
use App\Models\Contact;
use App\Models\Linkup;


class LinkupController extends Controller
{


    public function __construct()
    {
    }

    public function index()
    {

        $icNos = Auth::user()->ic_no;

        $employments = Employment::all()
        ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
        ->where('ic_no', '=', $icNos);

        $linkup = Linkup::select('linkup.*')
        ->where('ic_no', '=', $icNos)
        ->orderBy('created_at', 'DESC')
        ->get();
    

        return view('linkup.index', compact('employments','biodatas','contacts','linkup'));
    }

    public function indexsadmin()
    {

        $icNos = Auth::user()->ic_no;

        $employments = Employment::all()
        ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
        ->where('ic_no', '=', $icNos);

        $linkup = Linkup::select('linkup.*')
        ->orderBy('created_at', 'DESC')
        ->get();
    

        return view('linkup.indexsadmin', compact('employments','biodatas','contacts','linkup'));
    }

    public function store(Request $request)
    {
        $icNos = Auth::user()->ic_no;

        // Check if a file was provided
        if (!$request->hasFile('file') ||
            $request->file('file')->getSize() > 12 * 1024 * 1024) {
            return redirect()->route('linkup.index')->with('error_message', 'Tidak sah atau tidak memenuhi keperluan fail.');
        }

        // Check if a file with the same name already exists
        $existingFile = Linkup::where('file', 'like', '%' . $request->file('file')->getClientOriginalName())->first();

        if ($existingFile) {
            return redirect()->route('linkup.index')->with('error_message', 'Fail yang dihantar sudah wujud.');
        }

        $linkup = new Linkup;
        $linkup->name = $request->name;
        $linkup->ic_no = $icNos;

        // Get the original filename
        $originalFilename = $request->file('file')->getClientOriginalName();

        // Use storeAs to specify the desired filename for the original file
        $linkup->file = $request->file('file')->storeAs('public/linkup', $originalFilename);

        $linkup->save();

        // Generate QR Code
        $qrCode = QrCode::size(300)->generate(route('linkup.serve', ['filename' => $originalFilename]));

        // Save QR Code as PDF
        $pdf = PDF::loadView('linkup.qrcode', compact('qrCode', 'originalFilename'));
        $pdf->save(public_path('storage-defunct/linkup/qrcodes/' . pathinfo($originalFilename, PATHINFO_FILENAME) . 'qrcode.pdf'));

        // Save QR Code path to the database
        $linkup->qr_code = 'public/linkup/qrcodes/' . pathinfo($originalFilename, PATHINFO_FILENAME) . 'qrcode.pdf';

        $linkup->save();

        return redirect()->route('linkup.index')->with('success_message', 'Fail telah ditambah!');
    }

    public function serveFile($filename)
    {
        // Construct the full file path
        $filePath = public_path('storage-defunct/linkup/' . $filename);
        $qrCodePdfFilePath = public_path('storage/linkup/qrcodes/' . $filename);

        // Check if the original document exists
        if (file_exists($filePath)) {
            // Determine the content type based on the file's extension
            $contentType = mime_content_type($filePath);
            // Serve the original document with a proper Content-Type
            return response()->file($filePath, ['Content-Type' => $contentType]);
        }

        // Check if the QR Code PDF exists
        if (file_exists($qrCodePdfFilePath)) {
            // Determine the content type based on the file's extension
            $contentType = mime_content_type($qrCodePdfFilePath);
            // Serve the QR Code PDF with a proper Content-Type
            return response()->file($qrCodePdfFilePath, ['Content-Type' => $contentType]);
        }

        // Handle the case when neither the original document nor the QR Code PDF exists
        return abort(404);
    }

    public function destroy($id)
    {
        try {
            $linkup = Linkup::findOrFail($id);

            // Delete the file from the storage
            if ($linkup->file) {
                Storage::delete($linkup->file);
            }

            if ($linkup->qr_code) {
                Storage::delete($linkup->qr_code);
            }

            $linkup->delete();

            return redirect()->route('linkup.index')
                            ->with('success_message', 'Fail telah berjaya dipadamkan!');
        } catch (Exception $exception) {
            return back()->withInput()
                        ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

}
