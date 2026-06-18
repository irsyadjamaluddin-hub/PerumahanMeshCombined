<?php

namespace App\Http\Livewire\Pages\Penyerahan;

use App\Models\IMS\Siv;
use App\Models\IMS\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IMS\BukuDaftarEntry;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\IMS\BorangPenyerahans;
use App\Models\IMS\LejarSimpananEntry;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReceiverCopyOfBorangPenyerahan;

class View extends Component
{
    use WithPagination;

    protected $finalQuery;

    public $users;
    public $searchInput;
    public $searchResult;

    public $sortBy;
    public $sortOrder;

    public $borangPenyerahans;

    public $lejarSimpananEntry;
    public $bukuDaftarEntry;

    public function mount()
    {
        $this->sortOrder = "desc";
        $this->sortBy = "updated_at";

        $this->users = User::all();
        $this->borangPenyerahans = BorangPenyerahans::all();

        $this->lejarSimpananEntry = LejarSimpananEntry::with('lejarSimpanan')->get();
        $this->bukuDaftarEntry = BukuDaftarEntry::with('bukuDaftar')->get();
    }

    public function show($id)
    {
        return redirect()->route('ims.showPenyerahan', [
            'id' => $id
        ]);
    }

    public function process($id)
    {
        $theBorangPenyerahan = $this->borangPenyerahans->where('id', $id)->first();

        // ------------------------------------------------------------------------------------
        // Check if form is to be processed by reciever
        // ------------------------------------------------------------------------------------
        if(
            (!isset($theBorangPenyerahan->receiver_processed) || empty($theBorangPenyerahan->receiver_processed)) &&
            (isset($theBorangPenyerahan->tt_response) || isset($theBorangPenyerahan->mmsd_response))
        ){

            // Check if Internal or External
            if($theBorangPenyerahan->siv->deploy_to == "internal"){

                $details = [
                    'bp_id' => $id,
                    'penyerahan_type' => $theBorangPenyerahan->mmsd_response,
                ];

            } elseif($theBorangPenyerahan->siv->deploy_to == "external") {

                $details = [
                    'bp_id' => $id,
                    'penyerahan_type' => $theBorangPenyerahan->tt_response,
                ];

            }

            $hashedUrl = URL::signedroute('ims.receiverProcess', $details);

            return redirect($hashedUrl);

        }

        else {

            return redirect()->route('ims.processPenyerahan', [
                'id' => $id
            ]);

        }

    }

    public function clearSearch()
    {
        $this->searchInput = null;
    }

    public function sortByDate()
    {
        $this->sortBy = "updated_at";

        if($this->sortOrder == "asc"){
            $this->sortOrder = "desc";
        } else {
            $this->sortOrder = "asc";
        }

        $this->applyFilters();
    }

    public function applyFilters()
    {
        if (isset($this->finalQuery)) {
            $query = $this->finalQuery;
        } else {
            $query = BorangPenyerahans::query();
        }

        // Search Bar
        if (isset($this->searchInput)) {
            $explodedKeyWord = explode(" ", $this->searchInput);

            $query->where(function ($query) use ($explodedKeyWord) {
                foreach ($explodedKeyWord as $keyWord) {
                    $query->orWhere('bp_no', 'like', "%$keyWord%");
                    $query->orWhereHas('siv.internalUser', function ($query) use ($keyWord) {
                        $query->where('full_name', 'like', "%$keyWord%");
                    });
                    $query->orWhereHas('siv.externalUser', function ($query) use ($keyWord) {
                        $query->where('name', 'like', "%$keyWord%");
                    });
                    $query->orWhereHas('siv.receiverLocation', function ($query) use ($keyWord) {
                        $query->where('name', 'like', "%$keyWord%");
                    });
                }
            });
        }

        $this->finalQuery = $query->orderBy($this->sortBy, $this->sortOrder);

    }

    public function search()
    {
        $this->applyFilters();
    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function downloadPdf($bpId)
    {
        $borangPenyerahan = $this->borangPenyerahans->where('id', $bpId)->first();

        $data = [
            'bp' => $borangPenyerahan,
            'users' => $this->users,
            'lejarSimpananEntry' => $this->lejarSimpananEntry,
            'bukuDaftarEntry' => $this->bukuDaftarEntry,
        ];

        $filename = $borangPenyerahan->bp_no . '_' . time() . '.pdf';

        $pdf = PDF::loadView('livewire.pages.penyerahan.save-pdf', $data)->setPaper('a4', 'landscape')->setWarnings(false);

        return response()->streamDownload(function () use($pdf) {
            echo  $pdf->stream();
        }, $filename);
    }

    public function resendPdfToReceiver($bpId)
    {
        $bp = $this->borangPenyerahans->where('id', $bpId)->first();

        if($bp->siv->deploy_to == "internal"){

            $receiverEmail = $bp->siv->internalUser->email;
            $penyerahanType = $bp->mmsd_response;

        } elseif($bp->siv->deploy_to == "external") {

            $receiverEmail = $bp->siv->externalUser->email;
            $penyerahanType = $bp->tt_response;

        }

        // ------------------------------------------------------------------------
        // Email PDF to Receiver
        // ------------------------------------------------------------------------

        if(true){

            try {

                $details = [
                    'bp_id' => $bp->id,
                    'bp_no' => $bp->bp_no,
                    'penyerahan_type' => $penyerahanType,
                    'fileName' => $bp->pdf_name,
                ];

                Mail::to($receiverEmail)->send(new ReceiverCopyOfBorangPenyerahan($details));

                // ---------------------------------------------------------------
                // SUCCESS MESSAGE
                // ---------------------------------------------------------------

                $prevData = [
                    'message' => 'Success',
                    'description' => 'A copy of Borang Penyerahan form ' . $bp->bp_no . ' successfully emailed to receiver!.',
                ];

                return redirect()->route('ims.ViewPenyerahan')->with('success', $prevData);

            } catch (\Exception $e) {

                // ---------------------------------------------------------------
                // WARNING MESSAGE
                // ---------------------------------------------------------------

                $prevData = [
                    'message' => 'Warning',
                    'description' => 'Borang Penyerahan form ' . $bp->bp_no . ' successfully processed!. But, email failed to send. The mail relay might be blocked by your firewall.',
                ];

                return redirect()->route('ims.ViewPenyerahan')->with('warning', $prevData);

            }

        }
    }

    public function render()
    {
        // return view('livewire.pages.penyerahan.view');

        $this->applyFilters();

        return view('livewire.pages.penyerahan.view', [
            'bps' => $this->finalQuery->paginate(10),
        ]);
    }
}
