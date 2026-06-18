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

use BaconQrCode\Writer;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\PNG;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;


class LinkupController extends Controller
{

private function svgToPng($svgContent, $outputPath, $width = 300, $height = 300)
{
    $image = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $white);

    $svg = new \SimpleXMLElement($svgContent);

    foreach ($svg->rect as $rect) {
        $x = intval($rect['x']);
        $y = intval($rect['y']);
        $w = intval($rect['width']);
        $h = intval($rect['height']);

        $colorAttr = (string)$rect['fill'];
        sscanf($colorAttr, "#%02x%02x%02x", $r, $g, $b);

        $color = imagecolorallocate($image, $r, $g, $b);
        imagefilledrectangle($image, $x, $y, $x + $w, $y + $h, $color);
    }

    imagepng($image, $outputPath);
    imagedestroy($image);
}

    public function __construct()
    {
    }

public function index(Request $request)
{
    $icNos = Auth::user()->ic_no;

    $employments = Employment::where('ic_no', $icNos)->get();
    $biodatas = Biodata::where('ic_no', $icNos)->get();
    $contacts = Contact::where('ic_no', $icNos)->get();

    // THIS MUST RETURN A COLLECTION
    $linkup = Linkup::where('ic_no', $icNos)
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
    
        // Validate uploaded file
        if (!$request->hasFile('file') || $request->file('file')->getSize() > 12 * 1024 * 1024) {
            return redirect()->route('linkup.index')
                ->with('error_message', 'Tidak sah atau tidak memenuhi keperluan fail.');
        }
    
        $originalFilename = $request->file('file')->getClientOriginalName();
    
        // Prevent duplicate files
        $existingFile = Linkup::where('file', 'like', '%' . $originalFilename)->first();
        if ($existingFile) {
            return redirect()->route('linkup.index')
                ->with('error_message', 'Fail yang dihantar sudah wujud.');
        }
    
        // Store uploaded file
        $filePath = $request->file('file')->storeAs('linkup', $originalFilename, 'public');
    
        $linkupItem = new Linkup();
        $linkupItem->name = $request->name;
        $linkupItem->ic_no = $icNos;
        $linkupItem->file = $filePath;
    
        // ---------------------------
        // 1. Correct QR code URL
        // ---------------------------
        // LIVE URL WITHOUT storage/linkup
        $url = url('/' . $originalFilename);
    
        $filenameOnly = pathinfo($originalFilename, PATHINFO_FILENAME);
    
        // ---------------------------
        // 2. Generate SVG QR code
        // ---------------------------
        $svg = QrCode::format('svg')->size(300)->generate($url);
    
        $svgFilename = $filenameOnly . '_qrcode.svg';
        $svgPath = storage_path('app/public/linkup/' . $svgFilename);
        file_put_contents($svgPath, $svg);
    
        // Save relative path
        $linkupItem->qr_svg = 'linkup/' . $svgFilename;
    
        // ---------------------------
        // 3. Save PDF QR code
        // ---------------------------
        $pdfFilename = $filenameOnly . '_qrcode.pdf';
        $pdfPath = storage_path('app/public/linkup/' . $pdfFilename);
    
        $pdf = PDF::loadView('linkup.qrcode', [
            'qrCode' => $svg,
            'originalFilename' => $originalFilename
        ]);
        $pdf->save($pdfPath);
    
        $linkupItem->qr_code = 'storage/linkup/' . $pdfFilename;
    
        // ---------------------------
        // 4. Save record
        // ---------------------------
        $linkupItem->save();
    
        return redirect()->route('linkup.index')
            ->with('success_message', 'Fail telah ditambah!');
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

