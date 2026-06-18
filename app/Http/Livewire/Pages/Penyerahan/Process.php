<?php

namespace App\Http\Livewire\Pages\Penyerahan;

use App\Models\IMS\Siv;
use App\Models\IMS\User;
use App\Models\IMS\Asset;
use Livewire\Component;
use App\Mail\AssetReceipt;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\BukuDaftar;
use App\Models\IMS\Notification;
use App\Models\IMS\LejarSimpanan;
use App\Models\IMS\SivAssetEntry;
use App\Mail\CancelPenyerahan;
use App\Models\IMS\BukuDaftarEntry;
use App\Models\IMS\AssetEntryRequest;
use App\Models\IMS\AssetEntrySetItem;
use App\Models\IMS\BorangPenyerahans;
use App\Models\IMS\BukuDaftarRequest;
use App\Mail\ReceiverAssetReceipt;
use App\Models\IMS\LejarSimpananEntry;
use App\Models\IMS\LejarSimpananRequest;
use Illuminate\Support\Facades\Mail;
use App\Models\IMS\BukuDaftarEntryRequest;
use App\Models\IMS\AssetEntrySetItemRequest;
use App\Models\IMS\LejarSimpananEntryRequest;
use App\Models\IMS\PurchaseOrder;

class Process extends Component
{
    public $siv;
    public $bpId;
    public $users;
    public $assets;
    public $remark;
    public $sivAssets;
    public $sivAssetsToReturn;
    public $untamperedSivAssets;
    public $filterName;
    public $bukuDaftarEntry;
    public $borangPenyerahan;
    public $lejarSimpananEntry;
    public $sivAssetEntry;
    public $supervisors;
    public $lejarSimpanans;
    public $bukuDaftars;

    public $oneLevelSivAssets;

    public function mount($id)
    {

        // Grab and set ID from Route
        $this->bpId = $id;
        $this->borangPenyerahan = BorangPenyerahans::where('id', $id)->with('siv')->first();

        $this->filterName = "asc";

        $this->siv = Siv::where('id', $this->borangPenyerahan->siv_id)
            ->with('sivAssetEntries', 'receiver.receiverLocation')->first();

        // Check if user is next form processor
        if (
            ($this->borangPenyerahan->receiver_processed == null) && (
                (($this->borangPenyerahan->siv->deploy_to == "external") && (auth()->guard('ims')->user()->id == $this->borangPenyerahan->siv->tt_id) && ($this->borangPenyerahan->tt_response !== "cancel")) ||
                (($this->borangPenyerahan->siv->deploy_to == "internal") && (auth()->guard('ims')->user()->id == $this->borangPenyerahan->siv->mmsd_id) && ($this->borangPenyerahan->mmsd_response !== "cancel"))
            )
        ){

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

            $this->untamperedSivAssets = $this->sivAssets;

            // Data from DB
            $this->users = User::all();
            $this->assets = Asset::all();
            $this->lejarSimpanans = LejarSimpanan::all();
            $this->lejarSimpananEntry = LejarSimpananEntry::with('lejarSimpanan')->get();
            $this->bukuDaftars = BukuDaftar::all();
            $this->bukuDaftarEntry = BukuDaftarEntry::with('bukuDaftar')->get();
            $this->sivAssetEntry = SivAssetEntry::all();

        } else {

            // ---------------------------------------------------------------
            // WARNING MESSAGE
            // ---------------------------------------------------------------

            $prevData = [
                'position' => 'top-right',
                'type' => 'warning',
                'message' => 'Warning',
                'description' => "You are not the form's next processor!",
            ];

            return redirect()->route('ims.ViewPenyerahan')->with('warning', $prevData);

        }

    }

    public function return($sivAssetKey, $subAssetKey) {

        // ------------------------------------------------------------------------------------------------
        // Info:
        // ------------------------------------------------------------------------------------------------
        // Basically remove the value from $sivAssets array, and insert into $sivAssetsToReturn
        // ------------------------------------------------------------------------------------------------

        // Check if the outer value (i.e. Asset Number) exists in $this->sivAssets[$sivAssetKey]
        if (isset($this->sivAssets[$sivAssetKey])) {

            // Check if the inner value (i.e. 0 => Asset Details) exists
            if (isset($this->sivAssets[$sivAssetKey][$subAssetKey])) {

                // Check if the key already exists in the destinationArray
                if (array_key_exists($sivAssetKey, $this->sivAssetsToReturn)) {
                    // If it exists, push the value onto the existing array
                    $this->sivAssetsToReturn[$sivAssetKey][] = $this->sivAssets[$sivAssetKey][$subAssetKey];
                } else {
                    // If it doesn't exist, create a new array with the value
                    $this->sivAssetsToReturn[$sivAssetKey] = [$this->sivAssets[$sivAssetKey][$subAssetKey]];
                }

                // Remove from $sivAssets
                unset($this->sivAssets[$sivAssetKey][$subAssetKey]);

                // If there is no value in array, remove the whole thing.
                if(count($this->sivAssets[$sivAssetKey]) == 0){

                    unset($this->sivAssets[$sivAssetKey]);

                }

            }

        }

    }

    public function returnAll($sivAssetKey) {

        // Check if the outer value (i.e. Asset Number) exists in $this->sivAssets[$sivAssetKey]
        if (isset($this->sivAssets[$sivAssetKey])) {

            $innerArrays = $this->sivAssets[$sivAssetKey];

            foreach ($innerArrays as $innerArray) {

                // Check if the key already exists in the destinationArray
                if (array_key_exists($sivAssetKey, $this->sivAssetsToReturn)) {

                    // If it exists, push the value onto the existing array
                    $this->sivAssetsToReturn[$sivAssetKey][] = $innerArray;

                } else {

                    // If it doesn't exist, create a new array with the value
                    $this->sivAssetsToReturn[$sivAssetKey] = [$innerArray];

                }

            }

            // Remove from $sivAssets
            unset($this->sivAssets[$sivAssetKey]);

        }

    }

    public function restore($sivAssetKey, $subAssetKey)
    {

        // dd('hei' . '-'. $sivAssetKey . '-' . $subAssetKey);

        // ------------------------------------------------------------------------------------------------
        // Info:
        // ------------------------------------------------------------------------------------------------
        // Basically remove the value from $sivAssets array, and insert into $sivAssetsToReturn
        // ------------------------------------------------------------------------------------------------

        // Check if the outer value (i.e. Asset Number) exists in $this->sivAssets[$sivAssetKey]
        if (isset($this->sivAssetsToReturn[$sivAssetKey])) {

            // Check if the inner value (i.e. 0 => Asset Details) exists
            if (isset($this->sivAssetsToReturn[$sivAssetKey][$subAssetKey])) {

                // Check if the key already exists in the destinationArray
                if (array_key_exists($sivAssetKey, $this->sivAssets)) {
                    // If it exists, push the value onto the existing array
                    $this->sivAssets[$sivAssetKey][] = $this->sivAssetsToReturn[$sivAssetKey][$subAssetKey];
                } else {
                    // If it doesn't exist, create a new array with the value
                    $this->sivAssets[$sivAssetKey] = [$this->sivAssetsToReturn[$sivAssetKey][$subAssetKey]];
                }

                // Remove from $sivAssets
                unset($this->sivAssetsToReturn[$sivAssetKey][$subAssetKey]);

                // If there is no value in array, remove the whole thing.
                if(count($this->sivAssetsToReturn[$sivAssetKey]) == 0){

                    unset($this->sivAssetsToReturn[$sivAssetKey]);

                }

            }

        }
    }

    public function restoreAll($sivAssetKey)
    {
        // Check if the outer value (i.e. Asset Number) exists in $this->sivAssets[$sivAssetKey]
        if (isset($this->sivAssetsToReturn[$sivAssetKey])) {

            $innerArrays = $this->sivAssetsToReturn[$sivAssetKey];

            foreach ($innerArrays as $innerArray) {

                // Check if the key already exists in the destinationArray
                if (array_key_exists($sivAssetKey, $this->sivAssets)) {

                    // If it exists, push the value onto the existing array
                    $this->sivAssets[$sivAssetKey][] = $innerArray;

                } else {

                    // If it doesn't exist, create a new array with the value
                    $this->sivAssets[$sivAssetKey] = [$innerArray];

                }

            }

            // Remove from $sivAssets
            unset($this->sivAssetsToReturn[$sivAssetKey]);

        }
    }

    public function cancelDeployment()
    {

        // ------------------------------------------------------------------------------------------------------
        // 1. Notify PA about cancellation
        // ------------------------------------------------------------------------------------------------------

        if(true){

            $notification = new Notification();
            $notification->sender_id = auth()->guard('ims')->user()->id;
            $notification->receiver_id = $this->siv->supervisor_id;
            $notification->receiver_role_id = 3;
            $notification->message = "The deployment for Borang Penyerahan " . $this->borangPenyerahan->bp_no . " has been cancelled.";
            $notification->read = "no";
            $notification->reference_type = "borang_penyerahan";
            $notification->reference_id = $this->borangPenyerahan->id;
            $notification->save();

        }

        // ------------------------------------------------------------------------------------------------------
        // 2. Seperate array based on 'assetType', group it based on 'referenceId'
        // ------------------------------------------------------------------------------------------------------

        if(true){

            $lejarSimpananArray = [];
            $bukuDaftarArray = [];

            // Separate the array into two arrays based on 'assetType'
            foreach ($this->untamperedSivAssets as $untamperedSivAssets) {

                foreach($untamperedSivAssets as $untamperedSivAsset){

                    if ($untamperedSivAsset['assetType'] === 'lejarSimpanan') {
                        $lejarSimpananArray[] = $untamperedSivAsset;
                    } elseif ($untamperedSivAsset['assetType'] === 'bukuDaftar') {
                        $bukuDaftarArray[] = $untamperedSivAsset;
                    }

                }

            }

            // Group the separated arrays based on 'referenceId'. (ReferenceId = LejarSimpanan/BukuDaftar ID)
            $lejarSimpanansGrouped = collect($lejarSimpananArray)->groupBy('referenceId')->toArray();
            $bukuDaftarsGrouped = collect($bukuDaftarArray)->groupBy('referenceId')->toArray();

        }

        // ------------------------------------------------------------------------------------------------------
        // 3. Create new 'lejar simpanan request' or 'buku daftar request', based on data from arrays.
        // ------------------------------------------------------------------------------------------------------

        if(true){

            // lejarSimpanansGrouped = assets grouped into its respective 'Lejar Simpanan'.
            if(count($lejarSimpanansGrouped) > 0){

                foreach($lejarSimpanansGrouped as $lejarSimpanansGroupedKey => $lejarSimpananGrouped){

                    // Note: $lejarSimpanansGroupedKey = lejarSimpanan ID
                    $lejarSimpananId = $lejarSimpanansGroupedKey;
                    $oldLejarSimpananDetails = $this->lejarSimpanans->where('id', $lejarSimpananId)->first();

                    // ------------------------------------------------------------------------------------------------
                    // 3.1. Create new 'Lejar Simpanan Request'
                    // ------------------------------------------------------------------------------------------------
                    $lejarSimpananRequest = new LejarSimpananRequest();
                    $lejarSimpananRequest->vendor_id = $oldLejarSimpananDetails->vendor_id;
                    $lejarSimpananRequest->purchase_order_id = $oldLejarSimpananDetails->purchase_order_id;
                    $lejarSimpananRequest->delivery_order_id = $oldLejarSimpananDetails->delivery_order_id;
                    $lejarSimpananRequest->invoice_id = $oldLejarSimpananDetails->invoice_id;
                    $lejarSimpananRequest->moe_reference = $oldLejarSimpananDetails->moe_reference;
                    $lejarSimpananRequest->srv_id = $oldLejarSimpananDetails->srv_id;
                    $lejarSimpananRequest->borang_penyerahan_id = $this->bpId;
                    $lejarSimpananRequest->created_by = auth()->guard('ims')->user()->id;
                    $lejarSimpananRequest->sk_id = $this->siv->storekeeper_id;
                    $lejarSimpananRequest->sk_confirmed = "no";
                    $lejarSimpananRequest->save();

                    // Note: $lejarSimpananGrouped = assetEntries under one lejarSimpanan
                    foreach($lejarSimpananGrouped as $assetDetail){

                        // ------------------------------------------------------------------------------------------------
                        // 3.1.1 Create new 'Asset Entry Request'
                        // ------------------------------------------------------------------------------------------------
                        $assetEntryRequest = new AssetEntryRequest();
                        $assetEntryRequest->asset_id = $assetDetail['assetId'];
                        $assetEntryRequest->serial_no = $assetDetail['serialNo'];
                        $assetEntryRequest->moe_reference = $assetDetail['moeReference'];
                        $assetEntryRequest->asset_status_id = 1;
                        $assetEntryRequest->unit_price = $assetDetail['pricePerUnit'];
                        $assetEntryRequest->save();

                        // ------------------------------------------------------------------------------------------------
                        // 3.1.2 Get the old 'Asset Entry Set Item'
                        // ------------------------------------------------------------------------------------------------
                        $oldSetItems = AssetEntrySetItem::where('asset_entry_id', $assetDetail['assetEntryId'])->get();

                        // ------------------------------------------------------------------------------------------------
                        // 3.1.3 Insert the old 'Asset Entry Set Item'
                        // ------------------------------------------------------------------------------------------------
                        if(count($oldSetItems) > 0){

                            foreach($oldSetItems as $oldSetItem){

                                $setItemRequest =  new AssetEntrySetItemRequest();
                                $setItemRequest->asset_entry_request_id = $assetEntryRequest->id;
                                $setItemRequest->name = $oldSetItem->name;
                                $setItemRequest->moe_reference = $oldSetItem->moe_reference;
                                $setItemRequest->serial_no = $oldSetItem->serial_no;
                                $setItemRequest->asset_category_code_id = $oldSetItem->asset_category_code_id;
                                $setItemRequest->save();

                            }

                        }

                        // ------------------------------------------------------------------------------------------------
                        // 3.1.4 Create new 'Lejar Simpanan Entry Request'
                        // ------------------------------------------------------------------------------------------------
                        $lejarSimpananEntryRequest = new LejarSimpananEntryRequest();
                        $lejarSimpananEntryRequest->lejar_simpanan_request_id = $lejarSimpananRequest->id;
                        $lejarSimpananEntryRequest->asset_entry_request_id = $assetEntryRequest->id;
                        $lejarSimpananEntryRequest->save();

                    }

                    // ------------------------------------------------------------------------------------------------
                    // 3.2. Notify Storekeeper of New Ledger Requests Creation
                    // ------------------------------------------------------------------------------------------------

                    $notification = new Notification();
                    $notification->sender_id = auth()->guard('ims')->user()->id;
                    $notification->receiver_id = $this->siv->storekeeper_id;
                    $notification->receiver_role_id = 4;
                    $notification->message = "A new Request for Stock Ledger form " . $lejarSimpananRequest->moe_reference . " has been created.";
                    $notification->read = "no";
                    $notification->reference_type = "request-lejar-simpanan";
                    $notification->reference_id = $lejarSimpananRequest->id;
                    $notification->save();

                }

            }

            // bukuDaftarsGrouped = assets grouped into its respective 'Buku Daftar'.
            if(count($bukuDaftarsGrouped) > 0) {

                foreach($bukuDaftarsGrouped as $bukuDaftarsGroupedKey => $bukuDaftarGrouped){

                    // Note: $bukuDaftarsGroupedKey = bukuDaftar ID
                    $bukuDaftarId = $bukuDaftarsGroupedKey;
                    $oldBukuDaftarDetails = $this->bukuDaftars->where('id', $bukuDaftarId)->first();

                    // ------------------------------------------------------------------------------------------------
                    // Create new 'Buku Daftar Request'
                    // ------------------------------------------------------------------------------------------------
                    $bukuDaftarRequest = new BukuDaftarRequest();
                    $bukuDaftarRequest->buku_daftar_type_id = $oldBukuDaftarDetails->buku_daftar_type_id;
                    $bukuDaftarRequest->vendor_id = $oldBukuDaftarDetails->vendor_id;
                    $bukuDaftarRequest->purchase_order_id = $oldBukuDaftarDetails->purchase_order_id;
                    $bukuDaftarRequest->delivery_order_id = $oldBukuDaftarDetails->delivery_order_id;
                    $bukuDaftarRequest->invoice_id = $oldBukuDaftarDetails->invoice_id;
                    $bukuDaftarRequest->moe_reference = $oldBukuDaftarDetails->moe_reference;
                    $bukuDaftarRequest->srv_id = $oldBukuDaftarDetails->srv_id;
                    $bukuDaftarRequest->created_by = auth()->guard('ims')->user()->id;
                    $bukuDaftarRequest->sk_id = $this->siv->storekeeper_id;
                    $bukuDaftarRequest->sk_confirmed = "no";
                    $bukuDaftarRequest->save();

                    // Note: $bukuDaftarGrouped = assetEntries under one bukuDaftar
                    foreach($bukuDaftarGrouped as $assetDetail){

                        // ------------------------------------------------------------------------------------------------
                        // Create new 'Asset Entry Request'
                        // ------------------------------------------------------------------------------------------------
                        $assetEntryRequest = new AssetEntryRequest();
                        $assetEntryRequest->asset_id = $assetDetail['assetId'];
                        $assetEntryRequest->serial_no = $assetDetail['serialNo'];
                        $assetEntryRequest->moe_reference = $assetDetail['moeReference'];
                        $assetEntryRequest->asset_status_id = 1;
                        $assetEntryRequest->unit_price = $assetDetail['pricePerUnit'];
                        $assetEntryRequest->save();

                        // ------------------------------------------------------------------------------------------------
                        // Get the old 'Asset Entry Set Item'
                        // ------------------------------------------------------------------------------------------------
                        $oldSetItems = AssetEntrySetItem::where('asset_entry_id', $assetDetail['assetEntryId'])->get();

                        // ------------------------------------------------------------------------------------------------
                        // Insert the old Asset Entry 'Asset Entry Set Item'
                        // ------------------------------------------------------------------------------------------------
                        if(count($oldSetItems) > 0){

                            foreach($oldSetItems as $oldSetItem){

                                // Create New Set Item
                                $setItemRequest = new AssetEntrySetItemRequest();
                                $setItemRequest->asset_entry_request_id = $assetEntryRequest->id;
                                $setItemRequest->name = $oldSetItem->name;
                                $setItemRequest->moe_reference = $oldSetItem->moe_reference;
                                $setItemRequest->serial_no = $oldSetItem->serial_no;
                                $setItemRequest->asset_category_code_id = $oldSetItem->asset_category_code_id;
                                $setItemRequest->save();

                            }

                        }

                        // ------------------------------------------------------------------------------------------------
                        // Create new 'Buku Daftar Entry Request'
                        // ------------------------------------------------------------------------------------------------
                        $bukuDaftarEntryRequest = new BukuDaftarEntryRequest();
                        $bukuDaftarEntryRequest->buku_daftar_request_id = $bukuDaftarRequest->id;
                        $bukuDaftarEntryRequest->asset_entry_request_id = $assetEntryRequest->id;
                        $bukuDaftarEntryRequest->save();

                    }

                    // ------------------------------------------------------------------------------------------------
                    // Notify Storekeeper of New Buku Daftar Requests Creation
                    // ------------------------------------------------------------------------------------------------

                    $notification = new Notification();
                    $notification->sender_id = auth()->guard('ims')->user()->id;
                    $notification->receiver_id = $this->siv->storekeeper_id;
                    $notification->receiver_role_id = 4;
                    $notification->message = "A new Request for Buku Daftar form " . $bukuDaftarRequest->moe_reference . " has been created.";
                    $notification->read = "no";
                    $notification->reference_type = "request-lejar-simpanan";
                    $notification->reference_id = $bukuDaftarRequest->id;
                    $notification->save();

                }

            }

        }

        // ------------------------------------------------------------------------------------------------------
        // 4. Update 'Borang Penyerahan'
        // ------------------------------------------------------------------------------------------------------

        if(true){

            $borangPenyerahan = BorangPenyerahans::find($this->borangPenyerahan->id);
            $formattedDate = now()->format('Y-m-d H:i:s');

            if($this->borangPenyerahan->siv->deploy_to == "external"){

                $borangPenyerahan->tt_processed = 'yes';
                $borangPenyerahan->tt_response = 'cancel';
                $borangPenyerahan->tt_process_date = $formattedDate;

            } elseif($this->borangPenyerahan->siv->deploy_to == "internal") {

                $borangPenyerahan->mmsd_processed = 'yes';
                $borangPenyerahan->mmsd_response = 'cancel';
                $borangPenyerahan->mmsd_process_date = $formattedDate;

            }

            $borangPenyerahan->remark = $this->remark;
            $borangPenyerahan->save();
        }

        // -----------------
        // TT Response
        // -----------------
        // 1. cancel
        // 2. partial
        // 3. full
        // -----------------

        // ------------------------------------------------------------------------------------------------------
        // 5. Notify 'Receiver' About Cancellation.
        // ------------------------------------------------------------------------------------------------------

        if(true){

            $deployTo = $this->borangPenyerahan->siv->deploy_to;
            $receiverId = $this->borangPenyerahan->siv->receiver_id;
            $ttId = $this->borangPenyerahan->siv->tt_id;
            $mmsdId = $this->borangPenyerahan->siv->mmsd_id;
            $bpNo = $this->borangPenyerahan->bp_no;

            try {

                if($deployTo == "internal"){

                    $details = [
                        'siv_no' => $this->borangPenyerahan->siv->siv_no,
                        'bp_no' => $bpNo,
                        'remark' => $this->remark,
                    ];

                    $email = auth()->user()->email;

                    Mail::to($email)->send(new CancelPenyerahan($details));
                }

                elseif($deployTo == "external") {

                    $details = [
                        'siv_no' => $this->borangPenyerahan->siv->siv_no,
                        'bp_no' => $bpNo,
                        'remark' => $this->remark,
                    ];

                    $email = $this->siv->techteam->email;

                    Mail::to($email)->send(new CancelPenyerahan($details));

                }

                // ---------------------------------------------------------------
                // END OF FUNCTION
                // ---------------------------------------------------------------

                $prevData = [
                    'message' => 'Success',
                    'description' => 'Borang Penyerahan form ' . $bpNo . ' successfully processed!',
                ];

                return redirect()->route('ims.ViewPenyerahan')->with('success', $prevData);

            } catch (\Exception $e) {

                $prevData = [
                    'message' => 'Success',
                    'description' => 'Borang Penyerahan form ' . $bpNo . ' successfully processed!. But, email failed to send. The mail relay might be blocked by your firewall.',
                ];

                return redirect()->route('ims.ViewPenyerahan')->with('warning', $prevData);

            }

        }

    }

    public function confirmDeployment()
    {

        // -------------------------------------------------------------------------------
        // NOTES
        // -------------------------------------------------------------------------------

        if(true){

            // -------------------------------------------------------------------------------
            //
            // Check if partial or full deployment
            //      Partial = Berisi @ both $sivAssetsToReturn & $sivAssets
            //      Full = Kusung @ $sivAssetsToReturn
            //
            // Types of Penyerahan:
            // 1. Cancel
            // 2. Partial
            // 3. Full
            //
            // if(true){} is used to make the code cleaner (grouped) here. It serves no other purpose.
            //
            // Note: search asset_entry dari serial no @ asset_entry_requests utk differentiate barang yang kan direturn n deploy.
            // -------------------------------------------------------------------------------

        }

        $formattedDate = now()->format('Y-m-d H:i:s');

        // -------------------------------------------------------------------------------
        // FULL DEPLOYMENT
        // -------------------------------------------------------------------------------

        if (empty($this->sivAssetsToReturn)) {

            // ------------------------------------------------------------------------------------------------------
            // 1. Update 'Borang Penyerahan'
            // ------------------------------------------------------------------------------------------------------

            if(true){
                $borangPenyerahan = BorangPenyerahans::find($this->borangPenyerahan->id);

                if($this->borangPenyerahan->siv->deploy_to == "external"){

                    $borangPenyerahan->tt_processed = 'yes';
                    $borangPenyerahan->tt_response = 'full';
                    $borangPenyerahan->tt_process_date = $formattedDate;

                } elseif($this->borangPenyerahan->siv->deploy_to == "internal") {

                    $borangPenyerahan->mmsd_processed = 'yes';
                    $borangPenyerahan->mmsd_response = 'full';
                    $borangPenyerahan->mmsd_process_date = $formattedDate;

                }

                $borangPenyerahan->remark = $this->remark;
                $borangPenyerahan->save();
            }

            // ------------------------------------------------------------------------------------------------------
            // 2. Email 'Asset Receipt Confirmation' to Receiver
            // ------------------------------------------------------------------------------------------------------

            if(true){

                // Check If Receiver is Internal or External
                if($this->borangPenyerahan->siv->deploy_to == "external"){

                    $receiverEmail = $this->borangPenyerahan->siv->externalUser->email;

                } elseif($this->borangPenyerahan->siv->deploy_to == "internal"){

                    $receiverEmail = $this->borangPenyerahan->siv->internalUser->email;

                }

                $bpNo = $this->borangPenyerahan->bp_no;

                try {

                    $details = [
                        'bp_id' => $this->borangPenyerahan->id,
                        'penyerahan_type' => 'full',
                    ];

                    Mail::to($receiverEmail)->send(new ReceiverAssetReceipt($details));

                    $prevData = [
                        'message' => 'Success',
                        'description' => 'Borang Penyerahan form ' . $bpNo . ' successfully processed!.',
                    ];

                    return redirect()->route('ims.ViewPenyerahan')->with('success', $prevData);

                } catch (\Exception $e) {

                    $prevData = [
                        'message' => 'Warning',
                        'description' => 'Borang Penyerahan form ' . $bpNo . ' successfully processed!. But, email failed to send. The mail relay might be blocked by your firewall.',
                    ];

                    return redirect()->route('ims.ViewPenyerahan')->with('warning', $prevData);

                }

            }

        }

        // -------------------------------------------------------------------------------
        // PARTIAL DEPLOYMENT
        // -------------------------------------------------------------------------------
        else {

            // ------------------------------------------------------------------------------------------------------
            // 1. Update 'Borang Penyerahan'
            // ------------------------------------------------------------------------------------------------------

            if(true){

                $borangPenyerahan = BorangPenyerahans::find($this->borangPenyerahan->id);

                if($this->borangPenyerahan->siv->deploy_to == "external"){

                    $borangPenyerahan->tt_processed = 'yes';
                    $borangPenyerahan->tt_response = 'partial';
                    $borangPenyerahan->tt_process_date = $formattedDate;

                } elseif($this->borangPenyerahan->siv->deploy_to == "internal") {

                    $borangPenyerahan->mmsd_processed = 'yes';
                    $borangPenyerahan->mmsd_response = 'partial';
                    $borangPenyerahan->mmsd_process_date = $formattedDate;

                }

                $borangPenyerahan->remark = $this->remark;
                $borangPenyerahan->save();

            }

            // ------------------------------------------------------------------------------------------------------
            // 2. Insert Cancelled (partial) Items ($this->sivAssetsToReturn) to 'Request for Lejar Simpanan' etc
            // ------------------------------------------------------------------------------------------------------

            if(true){

                // Flatten $this->sivAssetsToReturn array
                $flattenedArray = array_reduce($this->sivAssetsToReturn, function ($carry, $item) {
                    return array_merge($carry, $item);
                }, []);

                // Convert the flattened array to a collection
                $flattenedCollection = collect($flattenedArray);

                // Group by 'assetType' (First Level)
                $groupedAssetDetails = $flattenedCollection->groupBy('assetType')->map(function ($items) {

                    // Within each 'assetType' group, group by 'purchaseOrderNo' (Second Level)
                    return $items->groupBy('purchaseOrderNo')->toArray();

                })->toArray();

                // ---------------------------------------------------------------------------------------
                // Array Structure (For future reference)
                // ---------------------------------------------------------------------------------------

                if(true){

                    // groupedAssetDetails = [
                    //     lejarSimpanan =>[
                    //         PO No. => [
                    //             0 => [
                    //                 "sivAssetEntryId" => 310
                    //                 "assetEntryId" => 547
                    //                 "assetId" => 140
                    //                 "moeReference" => "MOE/ICT/2023/FB9F23DFKDJSHS/A1/(1)/06-10"
                    //                 "serialNo" => "IGF789GGEWIUG306"
                    //                 "purchaseOrderNo" => "FB9F23DFKDJSHS"
                    //                 "deliveryOrderNo" => "ASDGH987GD"
                    //                 "assetType" => "lejarSimpanan"
                    //                 "referenceId" => 105
                    //                 "pricePerUnit" => "2300"
                    //             ]
                    //             1 => []
                    //             2 => []
                    //         ]
                    //     ]
                    //
                    //     bukuDaftar =>[
                    //         PO No. => [
                    //             0 => []
                    //             1 => []
                    //             2 => []
                    //         ]
                    //     ]
                    // ]

                }

                // Foreach 'Asset Type' (LejarSimpanan or BukuDaftar)
                foreach($groupedAssetDetails as $firstLevelKey => $firstLevels){

                    if($firstLevelKey == "lejarSimpanan"){

                        // Foreach PO No.
                        foreach($firstLevels as $secondLevelKey => $secondLevels){

                            $purchaseOrderId = PurchaseOrder::where('po_no', $secondLevelKey)->first()->id;
                            $oldLejarSimpanan = LejarSimpanan::where('purchase_order_id', $purchaseOrderId)->first();

                            // Create 'Lejar Simpanan Request'
                            $createNewLejarSimpananRequest = new LejarSimpananRequest();
                            $createNewLejarSimpananRequest->vendor_id = $oldLejarSimpanan->vendor_id;
                            $createNewLejarSimpananRequest->purchase_order_id = $oldLejarSimpanan->purchase_order_id;
                            $createNewLejarSimpananRequest->delivery_order_id = $oldLejarSimpanan->delivery_order_id;
                            $createNewLejarSimpananRequest->invoice_id = $oldLejarSimpanan->invoice_id;
                            $createNewLejarSimpananRequest->srv_id = $oldLejarSimpanan->srv_id;
                            $createNewLejarSimpananRequest->borang_penyerahan_id = $this->bpId;
                            $createNewLejarSimpananRequest->moe_reference = $oldLejarSimpanan->moe_reference;
                            $createNewLejarSimpananRequest->created_by = auth()->guard('ims')->user()->id;
                            $createNewLejarSimpananRequest->sk_id = $this->borangPenyerahan->siv->storekeeper_id;
                            $createNewLejarSimpananRequest->save();

                            // Foreach PO's Child
                            foreach($secondLevels as $thirdLevelKey => $thirdLevel){

                                // Create 'Asset Entry Request'
                                $createAssetEntryRequest = new AssetEntryRequest();
                                $createAssetEntryRequest->asset_id = $thirdLevel['assetId'];
                                $createAssetEntryRequest->serial_no = $thirdLevel['serialNo'];
                                $createAssetEntryRequest->moe_reference = $thirdLevel['moeReference'];
                                $createAssetEntryRequest->asset_status_id = 1;
                                $createAssetEntryRequest->unit_price = $thirdLevel['pricePerUnit'];
                                $createAssetEntryRequest->save();

                                // Get Old Set Items From DB
                                $oldSetItems = AssetEntrySetItem::where('asset_entry_id', $thirdLevel['assetEntryId'])->get();

                                if($oldSetItems !== null){

                                    foreach($oldSetItems as $oldSetItem){

                                        // Create 'Asset Entry Set Item Request'
                                        $createAssetEntrySetItemRequest = new AssetEntrySetItemRequest();
                                        $createAssetEntrySetItemRequest->asset_entry_request_id = $createAssetEntryRequest->id;
                                        $createAssetEntrySetItemRequest->name = $oldSetItem->name;
                                        $createAssetEntrySetItemRequest->moe_reference = $oldSetItem->moe_reference;
                                        $createAssetEntrySetItemRequest->serial_no = $oldSetItem->serial_no;
                                        $createAssetEntrySetItemRequest->asset_category_code_id  = $oldSetItem->asset_category_code_id;
                                        $createAssetEntrySetItemRequest->save();

                                    }

                                }

                                // Create 'Lejar Simpanan Entry Request'
                                $createNewLejarSimpananEntryRequest = new LejarSimpananEntryRequest();
                                $createNewLejarSimpananEntryRequest->lejar_simpanan_request_id = $createNewLejarSimpananRequest->id;
                                $createNewLejarSimpananEntryRequest->asset_entry_request_id = $createAssetEntryRequest->id;
                                $createNewLejarSimpananEntryRequest->save();

                            }

                        }

                    }

                    elseif($firstLevelKey == "bukuDaftar"){

                        // Foreach PO No.
                        foreach($firstLevels as $secondLevelKey => $secondLevels){

                            $purchaseOrderId = PurchaseOrder::where('po_no', $secondLevelKey)->first()->id;
                            $oldBukuDaftar = BukuDaftar::where('purchase_order_id', $purchaseOrderId)->first();

                            // Create 'Lejar Simpanan Request'
                            $createNewBukuDaftarRequest = new BukuDaftarRequest();
                            $createNewBukuDaftarRequest->buku_daftar_type_id = $oldBukuDaftar->buku_daftar_type_id;
                            $createNewBukuDaftarRequest->vendor_id = $oldBukuDaftar->vendor_id;
                            $createNewBukuDaftarRequest->purchase_order_id = $oldBukuDaftar->purchase_order_id;
                            $createNewBukuDaftarRequest->delivery_order_id = $oldBukuDaftar->delivery_order_id;
                            $createNewBukuDaftarRequest->invoice_id = $oldBukuDaftar->invoice_id;
                            $createNewBukuDaftarRequest->srv_id = $oldBukuDaftar->srv_id;
                            $createNewBukuDaftarRequest->borang_penyerahan_id = $this->bpId;
                            $createNewBukuDaftarRequest->moe_reference = $oldBukuDaftar->moe_reference;
                            $createNewBukuDaftarRequest->created_by = auth()->guard('ims')->user()->id;
                            $createNewBukuDaftarRequest->sk_id = $this->borangPenyerahan->siv->storekeeper_id;
                            $createNewBukuDaftarRequest->save();

                            // Foreach PO's Child
                            foreach($secondLevels as $thirdLevelKey => $thirdLevel){

                                // Create 'Asset Entry Request'
                                $createAssetEntryRequest = new AssetEntryRequest();
                                $createAssetEntryRequest->asset_id = $thirdLevel['assetId'];
                                $createAssetEntryRequest->serial_no = $thirdLevel['serialNo'];
                                $createAssetEntryRequest->moe_reference = $thirdLevel['moeReference'];
                                $createAssetEntryRequest->asset_status_id = 1;
                                $createAssetEntryRequest->unit_price = $thirdLevel['pricePerUnit'];
                                $createAssetEntryRequest->save();

                                // Get Old Set Items From DB
                                $oldSetItems = AssetEntrySetItem::where('asset_entry_id', $thirdLevel['assetEntryId'])->get();

                                if($oldSetItems !== null){

                                    foreach($oldSetItems as $oldSetItem){

                                        // Create 'Asset Entry Set Item Request'
                                        $createAssetEntrySetItemRequest = new AssetEntrySetItemRequest();
                                        $createAssetEntrySetItemRequest->asset_entry_request_id = $createAssetEntryRequest->id;
                                        $createAssetEntrySetItemRequest->name  = $oldSetItem->name;
                                        $createAssetEntrySetItemRequest->moe_reference = $oldSetItem->moe_reference;
                                        $createAssetEntrySetItemRequest->serial_no = $oldSetItem->serial_no;
                                        $createAssetEntrySetItemRequest->asset_category_code_id  = $oldSetItem->asset_category_code_id;
                                        $createAssetEntrySetItemRequest->save();

                                    }

                                }

                                // Create 'Lejar Simpanan Entry Request'
                                $createNewBukuDaftarEntryRequest = new BukuDaftarEntryRequest();
                                $createNewBukuDaftarEntryRequest->buku_daftar_request_id = $createNewBukuDaftarRequest->id;
                                $createNewBukuDaftarEntryRequest->asset_entry_request_id = $createAssetEntryRequest->id;
                                $createNewBukuDaftarEntryRequest->save();

                            }

                        }

                    }

                }

            }

            // ------------------------------------------------------------------------------------------------------
            // 3. Email 'Asset Receipt Confirmation' to Receiver
            // ------------------------------------------------------------------------------------------------------

            if(true){

                // Check If Receiver is Internal or External
                if($this->borangPenyerahan->siv->deploy_to == "external"){

                    $receiverEmail = $this->borangPenyerahan->siv->externalUser->email;

                } elseif($this->borangPenyerahan->siv->deploy_to == "internal"){

                    $receiverEmail = $this->borangPenyerahan->siv->internalUser->email;

                }

                $bpNo = $this->borangPenyerahan->bp_no;

                try {

                    $details = [
                        'bp_id' => $this->borangPenyerahan->id,
                        'penyerahan_type' => 'partial',
                    ];

                    Mail::to($receiverEmail)->send(new ReceiverAssetReceipt($details));

                    $prevData = [
                        'message' => 'Success',
                        'description' => 'Borang Penyerahan form ' . $bpNo . ' successfully processed!.',
                    ];

                    return redirect()->route('ims.ViewPenyerahan')->with('success', $prevData);

                } catch (\Exception $e) {

                    $prevData = [
                        'message' => 'Warning',
                        'description' => 'Borang Penyerahan form ' . $bpNo . ' successfully processed!. But, email failed to send. The mail-relay might be blocked by your firewall.',
                    ];

                    return redirect()->route('ims.ViewPenyerahan')->with('warning', $prevData);

                }

            }

        }

    }

    public function render()
    {
        return view('livewire.pages.penyerahan.process');
    }
}
