<?php

namespace App\Http\Livewire\Pages\Siv;

// use PDF;
use Mpdf\Mpdf;
use Dompdf\Dompdf;
// use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\IMS\Siv;
use App\Models\IMS\User;
use Livewire\Livewire;
// use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\Facade as PDF;
// use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use App\Models\IMS\BukuDaftarEntry;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\IMS\LejarSimpananEntry;
use Illuminate\Support\Facades\App;
// use Spatie\LaravelPdf\Facades\Pdf;
// use Spatie\Browsershot\Browsershot;
// use Illuminate\Support\Facades\App;
// use Spatie\Browsershot\Browsershot;
// use Illuminate\Support\Facades\Storage;

class showPdf extends Component
{
    public $lejarSimpananEntry;
    public $bukuDaftarEntry;

    public $users;

    public $sivId;
    public $siv;

    public function mount($id)
    {
        $this->sivId = $id;

        $this->lejarSimpananEntry = LejarSimpananEntry::with('lejarSimpanan')->get();
        $this->bukuDaftarEntry = BukuDaftarEntry::with('bukuDaftar')->get();

        $this->siv = Siv::where('id', $this->sivId)
            ->with('sivAssetEntries', 'receiver.receiverLocation')->first();

        $this->users = User::all();

    }

    public function downloadPdf()
    {

        // instantiate and use the dompdf class
        $data = [
            'lejarSimpananEntry' => $this->lejarSimpananEntry,
            'bukuDaftarEntry' => $this->bukuDaftarEntry,
            'siv' => $this->siv,
            'users' => $this->users,
        ];

        $filename = $this->siv->siv_no . '_' . time() . '.pdf';

        $pdf = PDF::loadView('livewire.pages.siv.save-pdf', $data)->setPaper('a4', 'landscape')->setWarnings(false);

        return response()->streamDownload(function () use($pdf) {
            echo  $pdf->stream();
        }, $filename);

    }

    // public function generatePdf()
    // {
    //     dd('ah?');
    // }

    public function generatePdf()
    {
        $data = [
            'lejarSimpananEntry' => $this->lejarSimpananEntry,
            'bukuDaftarEntry' => $this->bukuDaftarEntry,
            'siv' => $this->siv,
            'users' => $this->users,
        ];

        $pdf = Pdf::loadView('livewire.pages.siv.save-pdf', $data)->setPaper('a4', 'landscape')->setWarnings(false);

        $filename = $this->siv->siv_no . '_' . time() . '.pdf';

        // Save the PDF as a temporary file
        $tempFilePath = storage_path($filename);
        $pdf->save($tempFilePath);

    }

    // public function generatePDF()
    // {

        // $data = [
        //     'foo' => 'bar'
        // ];

        // $pdf = PDF::loadView('livewire.pages.siv.show-pdf', $data);
        // return $pdf->stream('document.pdf');

        // -------------------------------------------------------------------------
        // STREAM - works in non-livewire
        // -------------------------------------------------------------------------
        // $pdf = App::make('dompdf.wrapper');

        // $pdf->loadHTML('

        //     <h1 style="color:red;">Test</h1>

        // ');

        // return $pdf->stream();

        // session()->flash('message', 'Post successfully updated.');

        // $data = [
        //     'title' => 'Test Title',
        //     'date' => date('m/d/Y')
        // ];

        // return redirect()->route('ims.downloadMe')->with('printData', $data);

        // --------------------------------------------------------------------------------------
        // DOWNLOAD
        // --------------------------------------------------------------------------------------
        // Notes:
        // 1) Dapat direct download, tapi batah loading and CSS inda dapat.
        // --------------------------------------------------------------------------------------
        //
        // $data = [
        //     'title' => 'Welcome to CodeSolutionStuff.com',
        //     'date' => date('m/d/Y')
        // ];
        //
        // $pdfContent = PDF::loadView('livewire.pages.siv.download-pdf', $data)->output();
        // return response()->streamDownload(
        //     fn () => print($pdfContent),
        //     "filename.pdf"
        // );
        //
        // --------------------------------------------------------------------------------------

    // }

    public function render()
    {

        return view('livewire.pages.siv.show-pdf');
    }
}
