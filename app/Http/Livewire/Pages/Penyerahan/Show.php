<?php

namespace App\Http\Livewire\Pages\Penyerahan;

use App\Models\IMS\Siv;
use App\Models\IMS\User;
use App\Models\IMS\Asset;
use Livewire\Component;
use App\Models\IMS\BukuDaftarEntry;
use App\Models\IMS\BorangPenyerahans;
use App\Models\IMS\BukuDaftarRequest;
use App\Models\IMS\LejarSimpananEntry;
use App\Models\IMS\LejarSimpananRequest;

class Show extends Component
{
    public $siv;
    public $users;
    public $bpId;
    public $assets;
    public $filterName;
    public $bukuDaftarEntry;
    public $borangPenyerahan;
    public $lejarSimpananEntry;

    public $sivAssets;
    public $sivAssetsToReturn;

    public function mount($id)
    {
        // Initiate
        $this->sivAssets = [];
        $this->sivAssetsToReturn = [];

        // Grab and set ID from Route
        $this->bpId = $id;
        $this->borangPenyerahan = BorangPenyerahans::where('id', $id)->with('siv')->first();

        $this->filterName = "asc";

        $this->siv = Siv::where('id', $this->borangPenyerahan->siv_id)
            ->with('sivAssetEntries', 'receiver.receiverLocation')->first();

        $this->users = User::all();
        $this->assets = Asset::all();

        $this->lejarSimpananEntry = LejarSimpananEntry::with('lejarSimpanan')->get();
        $this->bukuDaftarEntry = BukuDaftarEntry::with('bukuDaftar')->get();

        // Remove assets that are available in asset_entry_requests (Lejar Simpanan) from $this->sivAssets
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

        $lejarSimpananRequest = LejarSimpananRequest::with('lejarSimpananEntryRequests.assetEntryRequest')->where('borang_penyerahan_id', $this->bpId)->first();

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

        $bukuDaftarRequest = BukuDaftarRequest::with('bukuDaftarEntryRequests.assetEntryRequest')->where('borang_penyerahan_id', $this->bpId)->first();

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

        // dd($this->sivAssets);

    }

    public function render()
    {
        return view('livewire.pages.penyerahan.show');
    }
}
