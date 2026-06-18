<?php

namespace App\Http\Livewire\Pages\Penyerahan;

use Carbon\Carbon;
use App\Models\IMS\Siv;
use App\Models\IMS\User;
use App\Models\IMS\Asset;
use Livewire\Component;
use App\Models\IMS\BukuDaftar;
use Illuminate\Http\Request;
use App\Models\IMS\LejarSimpanan;
use App\Models\IMS\SivAssetEntry;
use App\Models\IMS\BukuDaftarEntry;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\IMS\BorangPenyerahans;
use App\Models\IMS\BukuDaftarRequest;

use App\Models\IMS\LejarSimpananEntry;
use Illuminate\Support\Facades\URL;
use App\Models\IMS\LejarSimpananRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Request as LivewireRequest;
use App\Mail\ReceiverCopyOfBorangPenyerahan;

class ReceiverProcess extends Component
{
    // From Route Parameters (web.php)
    public $bp_id;
    public $penyerahan_type;

    public $borangPenyerahan;
    public $updatedBorangPenyerahan;
    public $siv;

    public $filterName;

    public $sivAssets;
    public $sivAssetsToReturn;
    public $untamperedSivAssets;

    public $users;
    public $assets;
    public $lejarSimpanans;
    public $lejarSimpananEntry;
    public $bukuDaftars;
    public $bukuDaftarEntry;
    public $sivAssetEntry;
    public $borangPenyerahans;

    public $fileName;
    public $signFileName;

    public function mount(Request $request)
    {
        $this->borangPenyerahan = BorangPenyerahans::where('id', $this->bp_id)->with('siv')->first();

        // ----------------------------------------------------------------------------------------------
        // 11th NOVEMBER 2023
        // ----------------------------------------------------------------------------------------------
        // Check if asset to issue is in asset entry request. If yes, exclude. Masukkan ke 'to return'.
        // ----------------------------------------------------------------------------------------------

        // Check if BorangPenyerahan has not been processed before
        if(!isset($this->borangPenyerahan->receiver_processed)){

            // Check if link has valid signature
            if($request->hasValidSignature()){

                $this->filterName = "asc";

                $this->siv = Siv::where('id', $this->borangPenyerahan->siv_id)
                    ->with('sivAssetEntries', 'receiver.receiverLocation')->first();

                $uniqueAssets = $this->siv->sivAssetEntries->unique('assetEntry.asset.id');

                $this->sivAssets = [];
                $this->sivAssetsToReturn = [];

                foreach ($uniqueAssets as $uniqueAsset) {

                    $assetId = $uniqueAsset->assetEntry->asset->id;

                    $this->sivAssets[$assetId] = $this->siv->sivAssetEntries
                        ->where('assetEntry.asset.id', $assetId)
                        ->map(function ($entry) {

                            $purchaseOrderNo = '';
                            $deliveryOrderNo = '';
                            $assetType = '';
                            $referenceId = '';

                            // -----------------------------------------------------------------------------------
                            // Note:
                            // -----------------------------------------------------------------------------------
                            // referenceId = lejarSimpananId or bukuDaftarId. for easy reference later.
                            // -----------------------------------------------------------------------------------

                            // Check if asset is from Lejar Simpanan or Buku Daftar
                            if ($entry->assetEntry->lejarSimpananEntry !== null) {
                                // Use 'lejarSimpananEntry' values
                                $purchaseOrderNo = $entry->assetEntry->lejarSimpananEntry->lejarSimpanan->purchaseOrder->po_no;
                                $deliveryOrderNo = $entry->assetEntry->lejarSimpananEntry->lejarSimpanan->deliveryOrder->do_no;
                                $assetType = 'lejarSimpanan';
                                $referenceId = $entry->assetEntry->lejarSimpananEntry->lejar_simpanan_id;
                            } elseif($entry->assetEntry->bukuDaftarEntry !== null) {
                                // Use 'bukuDaftarEntry' values
                                $purchaseOrderNo = $entry->assetEntry->bukuDaftarEntry->bukuDaftar->purchaseOrder->po_no;
                                $deliveryOrderNo = $entry->assetEntry->bukuDaftarEntry->bukuDaftar->deliveryOrder->do_no;
                                $assetType = 'bukuDaftar';
                                $referenceId = $entry->assetEntry->bukuDaftarEntry->buku_daftar_id;
                            }

                            return [
                                'sivAssetEntryId' => $entry->id,
                                'assetEntryId' => $entry->assetEntry->id,
                                'assetId' => $entry->assetEntry->asset_id,
                                'moeReference' => $entry->assetEntry->moe_reference,
                                'serialNo' => $entry->assetEntry->serial_no,
                                'purchaseOrderNo' => $purchaseOrderNo,
                                'deliveryOrderNo' => $deliveryOrderNo,
                                'assetType' => $assetType,
                                'referenceId' => $referenceId,
                                'pricePerUnit' => $entry->assetEntry->unit_price,
                            ];

                        })
                        ->toArray();
                }

                // --------------------------------------------------------------------------------------------------------
                // Notes:
                // --------------------------------------------------------------------------------------------------------
                // 1. Check from lejarSimpananRequests and bukuDaftarRequests if ada borang_penyerahan_id of $bp->id.
                // 2. Check if the relation-ed assetEntryRequests has the serial_no.
                // 3. If ada, remove from $this->sivAssets.
                // --------------------------------------------------------------------------------------------------------

                $lejarSimpananRequest = LejarSimpananRequest::with('lejarSimpananEntryRequests.assetEntryRequest')->where('borang_penyerahan_id', $this->borangPenyerahan->id)->first();

                // Remove assets that are available in asset_entry_requests (Lejar Simpanan) from $this->sivAssets
                if(isset($lejarSimpananRequest) && $lejarSimpananRequest !== null){

                    foreach($lejarSimpananRequest->lejarSimpananEntryRequests as $lejarSimpananEntryRequest){

                        $assetEntryRequest = $lejarSimpananEntryRequest->assetEntryRequest;

                        if(isset($assetEntryRequest)){

                            foreach ($this->sivAssets as $key => $subArray) {

                                foreach ($subArray as $subKey => $item) {
                                    if ($item['serialNo'] === $assetEntryRequest->serial_no) {
                                        $this->sivAssetsToReturn[$key][$subKey] = $item;
                                        unset($this->sivAssets[$key][$subKey]);
                                    }
                                }

                                // If the sub-array is empty after removing elements, remove the entire key
                                if (empty($this->sivAssets[$key])) {
                                    unset($this->sivAssets[$key]);
                                }
                            }

                        }

                    }

                }

                $bukuDaftarRequest = BukuDaftarRequest::with('bukuDaftarEntryRequests.assetEntryRequest')->where('borang_penyerahan_id', $this->borangPenyerahan->id)->first();

                // Remove assets that are available in asset_entry_requests (Buku Daftar) from $this->sivAssets
                if(isset($bukuDaftarRequest) && $bukuDaftarRequest !== null){

                    foreach($bukuDaftarRequest->bukuDaftarEntryRequests as $bukuDaftarEntryRequest){

                        $assetEntryRequest = $bukuDaftarEntryRequest->assetEntryRequest;

                        if(isset($assetEntryRequest)){

                            foreach ($this->sivAssets as $key => $subArray) {

                                foreach ($subArray as $subKey => $item) {
                                    if ($item['serialNo'] === $assetEntryRequest->serial_no) {
                                        $this->sivAssetsToReturn[$key][$subKey] = $item;
                                        unset($this->sivAssets[$key][$subKey]);
                                    }
                                }

                                // If the sub-array is empty after removing elements, remove the entire key
                                if (empty($this->sivAssets[$key])) {
                                    unset($this->sivAssets[$key]);
                                }
                            }


                        }

                    }

                }

                $this->untamperedSivAssets = $this->sivAssets;

                // Data from DB
                $this->users = User::all();
                $this->assets = Asset::all();
                $this->lejarSimpanans = LejarSimpanan::all();
                $this->lejarSimpananEntry = LejarSimpananEntry::with('lejarSimpanan')->get();
                $this->bukuDaftars = BukuDaftar::all();
                $this->bukuDaftarEntry = BukuDaftarEntry::with('bukuDaftar')->get();
                $this->sivAssetEntry = SivAssetEntry::all();
                $this->borangPenyerahans = BorangPenyerahans::all();

            } else {

                abort(403, 'Invalid URL signature.');

            }

        }

    }

    public function verifyAndSignOff($isEmpty, $dataUrl)
    {
        // Check if Signature Pad is Signed
        if($isEmpty == false){

            // ------------------------------------------------------------------------
            // Save Receiver's Signature (IMG) to Storage and Data to Database
            // ------------------------------------------------------------------------

            if(true){

                // Extract the Base64 data by removing the prefix
                $base64Data = preg_replace('#^data:image/\w+;base64,#i', '', $dataUrl);

                // Decode the Base64 data
                $imageData = base64_decode($base64Data);

                // Define the directory path where you want to save the image
                $directoryPath = public_path('signatures/');

                // Create the directory if it doesn't exist
                if (!is_dir($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                $dateTimeNow = Carbon::now()->format('YmdHis');

                $this->signFileName = "receiver_" . $this->borangPenyerahan->siv->receiver_id . "_" . $dateTimeNow . ".png";

                // Define the file path for the image
                $filePath = $directoryPath . $this->signFileName;

                // Save the image to the specified location
                file_put_contents($filePath, $imageData);

            }

            // ------------------------------------------------------------------------
            // Update Borang Penyerahan
            // ------------------------------------------------------------------------

            if(true){

                $formattedDate = now()->format('Y-m-d H:i:s');

                $updateBorangPenyerahan = BorangPenyerahans::find($this->bp_id);
                $updateBorangPenyerahan->receiver_processed = $this->signFileName;
                $updateBorangPenyerahan->receiver_process_date = $formattedDate;
                $updateBorangPenyerahan->save();

            }

            // ------------------------------------------------------------------------
            // Generate PDF
            // ------------------------------------------------------------------------

            if(true){

                $this->updatedBorangPenyerahan = BorangPenyerahans::where('id', $this->bp_id)->with('siv')->first();

                $this->fileName = $this->updatedBorangPenyerahan->bp_no . '_' . time() . '.pdf';

                $details = [
                    'bp' => $this->updatedBorangPenyerahan,
                    'users' => $this->users,
                    'lejarSimpananEntry' => $this->lejarSimpananEntry,
                    'bukuDaftarEntry' => $this->bukuDaftarEntry,
                    'fileName' => $this->fileName,
                ];

                $pdf = PDF::loadView('livewire.pages.penyerahan.save-pdf', $details)->setPaper('a4', 'landscape')->setWarnings(false);

                // Save the PDF as a temporary file
                $tempFilePath = storage_path($this->fileName);
                $pdf->save($tempFilePath);

                // ------------------------------------------------------------------------
                // Update Borang Penyerahan's: PDF Name
                // ------------------------------------------------------------------------

                if(true){

                    $updateBorangPenyerahan = BorangPenyerahans::find($this->bp_id);
                    $updateBorangPenyerahan->pdf_name = $this->fileName;
                    $updateBorangPenyerahan->save();

                }

            }

            // ------------------------------------------------------------------------
            // Email PDF to Receiver
            // ------------------------------------------------------------------------

            if(true){

                try {

                    $receiverEmail = 'sadasdsda@dsfdsf.dsf';

                    $details = [
                        'bp_id' => $this->borangPenyerahan->id,
                        'bp_no' => $this->borangPenyerahan->bp_no,
                        'penyerahan_type' => 'full',
                        'fileName' => $this->fileName,
                    ];

                    Mail::to($receiverEmail)->send(new ReceiverCopyOfBorangPenyerahan($details));

                    // ---------------------------------------------------------------
                    // SUCCESS MESSAGE
                    // ---------------------------------------------------------------

                    $prevData = [
                        'message' => 'Success',
                        'description' => 'A copy of Borang Penyerahan form ' . $this->borangPenyerahan->bp_no . ' successfully emailed to receiver!.',
                    ];

                    return redirect()->route('ims.ViewPenyerahan')->with('success', $prevData);

                } catch (\Exception $e) {

                    // ---------------------------------------------------------------
                    // WARNING MESSAGE
                    // ---------------------------------------------------------------

                    $prevData = [
                        'message' => 'Warning',
                        'description' => 'Borang Penyerahan form ' . $this->borangPenyerahan->bp_no . ' successfully processed!. But, email failed to send. The mail relay might be blocked by your firewall.',
                    ];

                    return redirect()->route('ims.ViewPenyerahan')->with('warning', $prevData);

                }

            }

            // ---------------------------------------------------------------
            // SUCCESS MESSAGE
            // ---------------------------------------------------------------

            // $prevData = [
            //     'message' => 'Success',
            //     'description' => 'Borang Penyerahan successfully completed!',
            // ];

            // return redirect()->route('ims.ViewPenyerahan')->with('success', $prevData);

        } else {

            // Trigger toast

            $data = [
                'position' => 'top-right',
                'type' => 'warning',
                'message' => 'Warning',
                'description' => 'Please sign on the signature pad',
            ];

            $this->dispatchBrowserEvent('toast-show', $data);

        }

    }

    public function render()
    {
        return view('livewire.pages.penyerahan.receiver-process');
    }
}
