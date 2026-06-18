<?php

// P3 - 345, 342
// P2 - 338
// Internal

// P3 - 346
// P5 - 353


namespace App\Http\Livewire\Pages\Siv;

use Carbon\Carbon;
use App\Models\IMS\Siv;
use App\Models\IMS\User;
use App\Models\IMS\Asset;
use App\Models\IMS\BinCard;
use Livewire\Component;
use App\Models\IMS\Receiver;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\BinCardEntry;
use App\Models\IMS\Notification;
use App\Models\IMS\SivAssetEntry;
use App\Models\IMS\ReceiverLocation;
use Illuminate\Support\Facades\Auth;

class CreateRequest extends Component
{
    public $assets;
    public $storekeepers;

    public $stepOneSearchInput;
    public $stepOneSearchResults;

    public $selectedAssets = [];
    public $selectedAssetMessage;
    public $selectedSubAssets = [];
    public $selectedSubAssetMessage;
    public $selectedAllSubAssets = [];

    public $selectedSubAssetCounter = [];

    public $setItemOpen = [];

    public $deployToInternal;
    public $deployToExternal;

    public $referenceForRequest;
    public $otherLocationDetails;
    public $receiverPhoneNo;
    public $receiverEmailAddress;
    public $receiverLocationMessage;

    public $searchReceiverLocationInput;
    public $searchReceiverLocationResults;
    public $searchReceiverLocationId;

    public $receiverLocationExists;
    public $receiverLocationIdDB;
    public $receiverLocationNameDB;
    public $receiverPhoneDB;
    public $receiverEmailDB;
    public $receiverOtherLocDetails;

    public $receiverExists;
    public $searchReceiverNameInput;
    public $searchReceiverNameResults;
    public $searchReceiverNameId;
    public $receiverNameMessage;

    public $preBinEntry = [];


    // ------------------------------------------------------------------------------------------
    // STEP 1
    // ------------------------------------------------------------------------------------------

    public function mount()
    {
        $this->assets = Asset::with('assetCategoryCode', 'assetEntries.lejarSimpananEntry.lejarSimpanan.purchaseOrder', 'assetEntries.bukuDaftarEntry.bukuDaftar.purchaseOrder')->get();

        $this->deployToInternal = true;
        $this->deployToExternal = false;

        $this->receiverExists = false;
        $this->receiverLocationExists = false;

        $this->storekeepers = User::whereHas('userRoles.role', function ($query) {
            $query->where('role_id', 4);
        })->where('id', '!=', auth()->guard('ims')->user()->id)->get();

    }

    public function warningToast($prevData)
    {
        $data = [
            'position' => 'top-right',
            'type' => 'warning',
            'message' => $prevData['message'],
            'description' => $prevData['description'],
        ];

        $this->dispatchBrowserEvent('toast-show', $data);
    }

    public function stepOneSearch()
    {
        $explodedKeyword = explode(" ", $this->stepOneSearchInput);
        $assets = Asset::query();

        foreach ($explodedKeyword as $name) {
            $assets->orWhere(function ($query) use ($name) {
                $query->where('name', 'like', "%$name%")->get()->take(10);
            });
        }

        $this->stepOneSearchResults = $assets->get();

    }

    public function clearStepOneSearch()
    {
        $this->stepOneSearchInput = null;
        $this->stepOneSearchResults = null;
    }

    public function selectAsset($assetId)
    {
        array_push($this->selectedAssets, $assetId);
    }

    public function removeAsset($selectedAssetId)
    {
        $assetEntries = AssetEntry::where('asset_id', $selectedAssetId)->pluck('id')->toArray();

        foreach($this->selectedSubAssets as $selectedSubAsset){

            if(in_array($selectedSubAsset, $assetEntries)){

                $key = array_search($selectedSubAsset, $this->selectedSubAssets);
                unset($this->selectedSubAssets[$key]);
            }

        }

        $key = array_search($selectedAssetId, $this->selectedAssets);
        unset($this->selectedAssets[$key]);
    }

    public function deployInternal()
    {
        $this->deployToInternal = true;
        $this->deployToExternal = false;
    }

    public function deployExternal()
    {
        $this->deployToInternal = false;
        $this->deployToExternal = true;
    }

    // ------------------------------------------------------------------------------------------
    // STEP 2
    // ------------------------------------------------------------------------------------------

    public function selectSubAsset($assetEntryId, $selectedAssetId)
    {
        // If Select-All
        if(in_array($selectedAssetId, $this->selectedAllSubAssets)){

            // Un-Select All
            $keyOne = array_search($selectedAssetId, $this->selectedAllSubAssets);
            unset($this->selectedAllSubAssets[$keyOne]);

            // Un-Select Single SubAsset
            if(in_array($assetEntryId, $this->selectedSubAssets)){

                $key = array_search($assetEntryId, $this->selectedSubAssets);
                unset($this->selectedSubAssets[$key]);

            }

        }

        // If Not Select-All
        else {

            // If Already Selected
            // Un-Select Single SubAsset
            if(in_array($assetEntryId, $this->selectedSubAssets)){

                $key = array_search($assetEntryId, $this->selectedSubAssets);
                unset($this->selectedSubAssets[$key]);

            } else {

                // Select Single SubAsset
                array_push($this->selectedSubAssets, $assetEntryId);

            }

        }

    }

    public function selectAllSubAsset($selectedAssetId)
    {
        // Un-Select All
        if(in_array($selectedAssetId, $this->selectedAllSubAssets)){

            $keyOne = array_search($selectedAssetId, $this->selectedAllSubAssets);
            unset($this->selectedAllSubAssets[$keyOne]);

            // Individual
            foreach($this->assets->where('id', $selectedAssetId)->first()->assetEntries->where('asset_status_id', 1) as $assetEntry){

                if(in_array($assetEntry->id, $this->selectedSubAssets)){

                    $key = array_search($assetEntry->id, $this->selectedSubAssets);
                    unset($this->selectedSubAssets[$key]);

                }
            }

        }

        // Select All
        else {
            array_push($this->selectedAllSubAssets, $selectedAssetId);

            // Individual
            foreach($this->assets->where('id', $selectedAssetId)->first()->assetEntries->where('asset_status_id', 1) as $assetEntry){

                if(!in_array($assetEntry->id, $this->selectedSubAssets)){

                    array_push($this->selectedSubAssets, $assetEntry->id);

                }
            }
        }

    }

    // ------------------------------------------------------------------------------------------
    // STEP 3
    // ------------------------------------------------------------------------------------------

    public function searchReceiverName()
    {
        $explodedName = explode(" ", $this->searchReceiverNameInput);
        $receiverNames = Receiver::query();

        foreach ($explodedName as $name) {
            $receiverNames->orWhere(function ($query) use ($name) {
                $query->where('name', 'like', "%$name%")->get()->take(10);
            });
        }

        $this->searchReceiverNameResults = $receiverNames->get();
    }

    public function selectReceiverName($id, $name)
    {
        $this->receiverNameMessage = null;
        $this->searchReceiverNameId = $id;
        $this->searchReceiverNameInput = ucwords($name);

        $this->receiverExists = true;

        $receiverDB = Receiver::with('receiverLocation')->where('id', $id)->first();

        $this->receiverLocationIdDB = $receiverDB->receiverLocation->id;
        $this->receiverLocationNameDB = $receiverDB->receiverLocation->name;
        $this->receiverPhoneDB = $receiverDB->phone_no;
        $this->receiverEmailDB = $receiverDB->email;
        $this->receiverOtherLocDetails = $receiverDB->other_details;

        // Other_details @ receivers table. store room no disini. make sure filled properly.
    }

    public function removeReceiverName()
    {
        $this->searchReceiverNameId = null;
        $this->searchReceiverNameInput = "";

        $this->receiverExists = false;
    }

    public function searchReceiverLocation()
    {
        $explodedName = explode(" ", $this->searchReceiverLocationInput);
        $receiverLocations = ReceiverLocation::query();

        foreach ($explodedName as $name) {
            $receiverLocations->orWhere(function ($query) use ($name) {
                $query->where('name', 'like', "%$name%")->get()->take(10);
            });
        }

        $this->searchReceiverLocationResults = $receiverLocations->get();
    }

    public function selectReceiverLocation($id, $name)
    {
        $this->receiverLocationMessage = null;
        $this->searchReceiverLocationId = $id;
        $this->searchReceiverLocationInput = ucwords($name);

        $this->receiverLocationExists = true;
    }

    public function removeReceiverLocation()
    {
        $this->searchReceiverLocationId = null;
        $this->searchReceiverLocationInput = "";

        $this->receiverLocationExists = false;
    }

    // public function triggerToast()
    // {
    //     // Used to test toast notification

    //     $prevData = [
    //         'message' => 'Title One',
    //         'description' => 'This is an example toast description',
    //     ];

    //     return redirect()->to('/siv/request/view')->with('success', $prevData);
    // }

    // ------------------------------------------------------------------------------------------
    // BUTTON
    // ------------------------------------------------------------------------------------------

    public function saveAndSubmit()
    {

        // --------------------------------------------------------------------------------
        // 16/8/2023
        // --------------------------------------------------------------------------------
        //
        // Problem: BIN CARD count does not tally.
        // Possible solution:-
        //  1) Create-Request does not update asset_status_id in AssetEntries table. (Checked. No problem)
        //  2) Create-Request (For Internal) - Check if AssetEntries is updated.
        //
        // --------------------------------------------------------------------------------

        $dateTimeNow = Carbon::now()->timezone('Asia/Brunei')->format('Y-m-d H:i:s');

        // --------------------------------------------------------------------------------
        // Searchable Fields Error Message
        // --------------------------------------------------------------------------------

        $this->selectedAssetMessage = null;

        // ------------------------------------------------
        //  Check if there are Assets selected
        // ------------------------------------------------

        if(empty($this->selectedAssets)){

            $this->selectedAssetMessage = "No item selected.";

            $prevData = [
                'message' => 'Warning: Empty Step One',
                'description' => 'Please search and select at least one item!',
            ];

            $this->warningToast($prevData);

        } else {

            $this->selectedSubAssetMessage = null;

            // ------------------------------------------------
            //  Check if there are Sub-Assets selected
            // ------------------------------------------------

            if(empty($this->selectedSubAssets)){

                $this->selectedSubAssetMessage = "No item selected. Click 'View all' button.";

                $prevData = [
                    'message' => 'Warning: Empty Step Two',
                    'description' => 'Please click the "View all" button and select at least one item!',
                ];

                $this->warningToast($prevData);

            } else {

                // -------------------------------------------------------------------------------------------------------------------------------------
                // DEPLOY TO EXTERNAL (CHECKED)
                // -------------------------------------------------------------------------------------------------------------------------------------

                if($this->deployToExternal == true){

                    // RECEIVER EXISTS. ADD SIV + SIV_ASSET_ENTRIES + UPDATE ASSET_ENTRIES (asset_status_id) + ADD BIN_CARD_ENTRIES.
                    if($this->receiverExists == true){

                        $validatedData = $this->validate([
                            'referenceForRequest' => 'required',
                        ]);

                        // ---------------------------------------------------------------
                        // Save Data to Table: SIVS
                        // ---------------------------------------------------------------

                        $siv = new Siv;
                        $siv->reference_for_request = $validatedData['referenceForRequest'];
                        $siv->request_date = $dateTimeNow;
                        $siv->request_accepted = "no";
                        $siv->deploy_to = "external";
                        $siv->tt_id = auth()->guard('ims')->user()->id;
                        $siv->receiver_id = $this->searchReceiverNameId;
                        $siv->receiver_location_id = $this->receiverLocationIdDB;
                        $siv->save();

                        // ---------------------------------------------------------------
                        // Put SubAsset Into Array, Where The Key = MainAsset and The Value = SubAsset.
                        // ---------------------------------------------------------------

                        foreach($this->selectedAssets as $selectedAsset){

                            $this->preBinEntry[$selectedAsset] = [];

                            foreach($this->selectedSubAssets as $selectedSubAsset) {
                                $asset = $this->assets->where('id', $selectedAsset)->first();

                                if(isset($asset)){

                                    $assetEntries = $asset->assetEntries->pluck('id')->toArray();

                                    if(in_array($selectedSubAsset, $assetEntries)){

                                        array_push($this->preBinEntry[$selectedAsset], $selectedSubAsset);

                                    }
                                }
                            }
                        }

                        // ---------------------------------------------------------------
                        // Save Data to Table: SIV_ASSET_ENTRIES
                        // ---------------------------------------------------------------

                        foreach($this->selectedSubAssets as $subAssetId){

                            // ---------------------------------------------------------------
                            // Save Data to Table: SIV_ASSET_ENTRIES
                            // ---------------------------------------------------------------

                            $sivAsset = new SivAssetEntry;
                            $sivAsset->siv_id = $siv->id;
                            $sivAsset->asset_entry_id = $subAssetId;
                            $sivAsset->save();

                            // ---------------------------------------------------------------
                            // Save Asset_Status_ID on Table: ASSET_ENTRIES
                            // ---------------------------------------------------------------

                            AssetEntry::where('id', $subAssetId)
                                ->update(['asset_status_id' => 4]);

                            // Note: 'asset_status_id' with value 4 = 'Requested For Issuance'

                        }

                        // ---------------------------------------------------------------
                        // Save Data to Table: BIN_CARD_ENTRIES
                        // ---------------------------------------------------------------

                        foreach($this->selectedAssets as $selectedAsset){

                            $binCardId = BinCard::where('asset_id', $selectedAsset)->first()->id;

                            // ---------------------------------------------------------------
                            // Get latest balance_quantity
                            // ---------------------------------------------------------------

                            $latestBalanceQuantity = BinCardEntry::where('bin_card_id', $binCardId)->latest('id')->value('balance_quantity');

                            // ---------------------------------------------------------------
                            // Count the number of SubAssets selected for the Asset
                            // ---------------------------------------------------------------

                            $outQuantity = count($this->preBinEntry[$selectedAsset]);

                            // ---------------------------------------------------------------
                            // Save Data to Table: BIN_CARD_ENTRIES
                            // ---------------------------------------------------------------

                            $binCardEntry = new BinCardEntry;
                            $binCardEntry->bin_card_id = $binCardId;
                            $binCardEntry->user_type = "external-requester";
                            $binCardEntry->user_id = $this->searchReceiverNameId;
                            $binCardEntry->out_quantity = $outQuantity;
                            $binCardEntry->balance_quantity = $latestBalanceQuantity - $outQuantity;
                            $binCardEntry->officer_in_charge_id = auth()->guard('ims')->user()->id;
                            $binCardEntry->reference_type = "request-for-siv";
                            $binCardEntry->reference_id = $siv->id;
                            $binCardEntry->save();

                        }

                    }

                    // RECEIVER DOES NOT EXIST. (TYPE IN RECEIVER_NAME MANUALLY) ADD NEW RECEIVER + SIV + SIV_ASSETS + ADD BIN_CARD_ENTRIES.
                    else {

                        $this->receiverNameMessage = null;

                        if(!isset($this->searchReceiverNameInput) || empty($this->searchReceiverNameInput)){
                            $this->receiverNameMessage = "No receiver name entered or selected.";

                            $prevData = [
                                'message' => 'Warning: Empty Receiver Name',
                                'description' => 'Please select or fill in the receiver name!',
                            ];

                            $this->warningToast($prevData);
                        }

                        $this->receiverLocationMessage = null;

                        if(!isset($this->searchReceiverLocationInput) || empty($this->searchReceiverLocationInput)){
                            $this->receiverLocationMessage = "No receiver location entered or selected.";

                            $prevData = [
                                'message' => 'Warning: Empty Receiver Location',
                                'description' => 'Please select or fill in the receiver location!',
                            ];

                            $this->warningToast($prevData);
                        }

                        // IF USER SEARCHED AND SELECTED LOCATION FROM LIST/DB = ADD NEW RECEIVER, SIV & SIV_ASSET_ENTRY. + UPDATE ASSET_STATUS_ID
                        if($this->receiverLocationExists == true){

                            $validatedData = $this->validate([
                                'searchReceiverNameInput' => 'required',
                                'referenceForRequest' => 'required',
                                'receiverPhoneNo' => 'required|numeric',
                                'receiverEmailAddress' => 'required|email',
                            ]);

                            // ---------------------------------------------------------------
                            // Save Data to Table: RECEIVERS
                            // ---------------------------------------------------------------

                            $receiver = new Receiver;
                            $receiver->name = $validatedData['searchReceiverNameInput'];
                            $receiver->receiver_location_id = $this->searchReceiverLocationId;
                            $receiver->other_details = $this->otherLocationDetails;
                            $receiver->phone_no = $validatedData['receiverPhoneNo'];
                            $receiver->email = $validatedData['receiverEmailAddress'];
                            $receiver->save();

                            // ---------------------------------------------------------------
                            // Save Data to Table: SIVS
                            // ---------------------------------------------------------------

                            $siv = new Siv;
                            $siv->reference_for_request = $validatedData['referenceForRequest'];
                            $siv->request_date = $dateTimeNow;
                            $siv->request_accepted = "no";
                            $siv->deploy_to = "external";
                            $siv->tt_id = auth()->guard('ims')->user()->id;
                            $siv->receiver_id = $receiver->id;
                            $siv->receiver_location_id = $this->searchReceiverLocationId;
                            $siv->save();

                            // ---------------------------------------------------------------
                            // Put SubAsset Into Array, Where The Key = MainAsset and The Value = SubAsset.
                            // ---------------------------------------------------------------

                            foreach($this->selectedAssets as $selectedAsset){

                                $this->preBinEntry[$selectedAsset] = [];

                                foreach($this->selectedSubAssets as $selectedSubAsset) {
                                    $asset = $this->assets->where('id', $selectedAsset)->first();

                                    if(isset($asset)){

                                        $assetEntries = $asset->assetEntries->pluck('id')->toArray();

                                        if(in_array($selectedSubAsset, $assetEntries)){

                                            array_push($this->preBinEntry[$selectedAsset], $selectedSubAsset);

                                        }
                                    }
                                }
                            }

                            // ---------------------------------------------------------------
                            // Save Data to Table: SIV_ASSET_ENTRIES
                            // ---------------------------------------------------------------

                            foreach($this->selectedSubAssets as $subAssetId){

                                // ---------------------------------------------------------------
                                // Save Data to Table: SIV_ASSET_ENTRIES
                                // ---------------------------------------------------------------

                                $sivAsset = new SivAssetEntry;
                                $sivAsset->siv_id = $siv->id;
                                $sivAsset->asset_entry_id = $subAssetId;
                                $sivAsset->save();

                                // ---------------------------------------------------------------
                                // Save Asset_Status_ID on Table: ASSET_ENTRIES
                                // ---------------------------------------------------------------

                                AssetEntry::where('id', $subAssetId)
                                    ->update(['asset_status_id' => 4]);

                                // Note: 'asset_status_id' with value 4 = 'Requested For Issuance'

                            }

                            // ---------------------------------------------------------------
                            // Save Data to Table: BIN_CARD_ENTRIES
                            // ---------------------------------------------------------------

                            foreach($this->selectedAssets as $selectedAsset){

                                $binCardId = BinCard::where('asset_id', $selectedAsset)->first()->id;

                                // ---------------------------------------------------------------
                                // Get latest balance_quantity
                                // ---------------------------------------------------------------

                                $latestBalanceQuantity = BinCardEntry::where('bin_card_id', $binCardId)->latest('id')->value('balance_quantity');

                                // ---------------------------------------------------------------
                                // Count the number of SubAssets selected for the Asset
                                // ---------------------------------------------------------------

                                $outQuantity = count($this->preBinEntry[$selectedAsset]);

                                // ---------------------------------------------------------------
                                // Save Data to Table: BIN_CARD_ENTRIES
                                // ---------------------------------------------------------------

                                $binCardEntry = new BinCardEntry;
                                $binCardEntry->bin_card_id = $binCardId;
                                $binCardEntry->user_type = "external-requester";
                                $binCardEntry->user_id = $receiver->id;
                                $binCardEntry->out_quantity = $outQuantity;
                                $binCardEntry->balance_quantity = $latestBalanceQuantity - $outQuantity;
                                $binCardEntry->officer_in_charge_id = auth()->guard('ims')->user()->id;
                                $binCardEntry->reference_type = "request-for-siv";
                                $binCardEntry->reference_id = $siv->id;
                                $binCardEntry->save();

                            }

                        }

                        // IF USER TYPE IN LOCATION MANUALLY (NOT SELECT FROM LIST/DB) = ADD NEW RECEIVER_LOCATION,RECEIVER, SIV & SIV_ASSET_ENTRY. + UPDATE ASSET_STATUS_ID
                        else {

                            $validatedData = $this->validate([
                                'searchReceiverNameInput' => 'required',
                                'searchReceiverLocationInput' => 'required',
                                'receiverPhoneNo' => 'required|numeric',
                                'receiverEmailAddress' => 'required|email',
                                'referenceForRequest' => 'required',
                            ]);

                            // Check if location already exist. If yes, don't insert.
                            $receiverLocationExists = ReceiverLocation::where('name', $validatedData['searchReceiverLocationInput'])->exists();

                            if ($receiverLocationExists) {

                                $receiverLocation = ReceiverLocation::where('name', $validatedData['searchReceiverLocationInput'])->first();

                            } else {

                                // ---------------------------------------------------------------
                                // Save Data to Table: RECEIVER_LOCATIONS
                                // ---------------------------------------------------------------

                                $receiverLocation = new ReceiverLocation;
                                $receiverLocation->name = $validatedData['searchReceiverLocationInput'];
                                $receiverLocation->save();

                            }

                            // ---------------------------------------------------------------
                            // Save Data to Table: RECEIVERS
                            // ---------------------------------------------------------------

                            $receiver = new Receiver;
                            $receiver->name = $validatedData['searchReceiverNameInput'];
                            $receiver->receiver_location_id = $receiverLocation->id;
                            $receiver->other_details = $this->otherLocationDetails;
                            $receiver->phone_no = $validatedData['receiverPhoneNo'];
                            $receiver->email = $validatedData['receiverEmailAddress'];
                            $receiver->save();

                            // ---------------------------------------------------------------
                            // Save Data to Table: SIVS
                            // ---------------------------------------------------------------

                            $siv = new Siv;
                            $siv->reference_for_request = $validatedData['referenceForRequest'];
                            $siv->request_date = $dateTimeNow;
                            $siv->request_accepted = "no";
                            $siv->deploy_to = "external";
                            $siv->tt_id = auth()->guard('ims')->user()->id;
                            $siv->receiver_id = $receiver->id;
                            $siv->receiver_location_id = $receiverLocation->id;
                            $siv->save();

                            // ---------------------------------------------------------------
                            // Put SubAsset Into Array, Where The Key = MainAsset and The Value = SubAsset.
                            // ---------------------------------------------------------------

                            foreach($this->selectedAssets as $selectedAsset){

                                $this->preBinEntry[$selectedAsset] = [];

                                foreach($this->selectedSubAssets as $selectedSubAsset) {
                                    $asset = $this->assets->where('id', $selectedAsset)->first();

                                    if(isset($asset)){

                                        $assetEntries = $asset->assetEntries->pluck('id')->toArray();

                                        if(in_array($selectedSubAsset, $assetEntries)){

                                            array_push($this->preBinEntry[$selectedAsset], $selectedSubAsset);

                                        }
                                    }
                                }
                            }

                            // ---------------------------------------------------------------
                            // Save Data to Table: SIV_ASSET_ENTRIES
                            // ---------------------------------------------------------------

                            foreach($this->selectedSubAssets as $subAssetId){

                                // ---------------------------------------------------------------
                                // Save Data to Table: SIV_ASSET_ENTRIES
                                // ---------------------------------------------------------------

                                $sivAsset = new SivAssetEntry;
                                $sivAsset->siv_id = $siv->id;
                                $sivAsset->asset_entry_id = $subAssetId;
                                $sivAsset->save();

                                // ---------------------------------------------------------------
                                // Save Asset_Status_ID on Table: ASSET_ENTRIES
                                // ---------------------------------------------------------------

                                AssetEntry::where('id', $subAssetId)
                                    ->update(['asset_status_id' => 4]);

                                // Note: 'asset_status_id' with value 4 = 'Requested For Issuance'

                            }

                            // ---------------------------------------------------------------
                            // Save Data to Table: BIN_CARD_ENTRIES
                            // ---------------------------------------------------------------

                            foreach($this->selectedAssets as $selectedAsset){

                                $binCardId = BinCard::where('asset_id', $selectedAsset)->first()->id;

                                // ---------------------------------------------------------------
                                // Get latest balance_quantity
                                // ---------------------------------------------------------------

                                $latestBalanceQuantity = BinCardEntry::where('bin_card_id', $binCardId)->latest('id')->value('balance_quantity');

                                // ---------------------------------------------------------------
                                // Count the number of SubAssets selected for the Asset
                                // ---------------------------------------------------------------

                                $outQuantity = count($this->preBinEntry[$selectedAsset]);

                                // ---------------------------------------------------------------
                                // Save Data to Table: BIN_CARD_ENTRIES
                                // ---------------------------------------------------------------

                                $binCardEntry = new BinCardEntry;
                                $binCardEntry->bin_card_id = $binCardId;
                                $binCardEntry->user_type = "external-requester";
                                $binCardEntry->user_id = $receiver->id;
                                $binCardEntry->out_quantity = $outQuantity;
                                $binCardEntry->balance_quantity = $latestBalanceQuantity - $outQuantity;
                                $binCardEntry->officer_in_charge_id = auth()->guard('ims')->user()->id;
                                $binCardEntry->reference_type = "request-for-siv";
                                $binCardEntry->reference_id = $siv->id;
                                $binCardEntry->save();

                            }

                        }

                    }

                }

                // -------------------------------------------------------------------------------------------------------------------------------------
                // DEPLOY TO INTERNAL = ADD NEW SIVS + SIV ASSET ENTRIES + RECEIVER + RECEIVER LOCATIONS. + UPDATE ASSET_STATUS_ID (ASSET_ENTRY)
                // -------------------------------------------------------------------------------------------------------------------------------------
                //
                // FOR INTERNAL, REQUESTER = RECEIVER (?) => CURRENT USER / AUTO GENERATED.
                //
                // -------------------------------------------------------------------------------------------------------------------------------------

                elseif($this->deployToInternal == true){

                    // ---------------------------------------------------------------
                    // Save Data to Table: SIVS
                    // ---------------------------------------------------------------

                    $siv = new Siv;
                    $siv->request_date = $dateTimeNow;
                    $siv->request_accepted = "no";
                    $siv->deploy_to = "internal";
                    $siv->tt_id = auth()->guard('ims')->user()->id;
                    $siv->receiver_id = auth()->guard('ims')->user()->id;
                    $siv->save();

                    // ---------------------------------------------------------------
                    // Put SubAsset Into Array, Where The Key = MainAsset and The Value = SubAsset.
                    // ---------------------------------------------------------------

                    foreach($this->selectedAssets as $selectedAsset){

                        $this->preBinEntry[$selectedAsset] = [];

                        foreach($this->selectedSubAssets as $selectedSubAsset) {
                            $asset = $this->assets->where('id', $selectedAsset)->first();

                            if(isset($asset)){

                                $assetEntries = $asset->assetEntries->pluck('id')->toArray();

                                if(in_array($selectedSubAsset, $assetEntries)){

                                    array_push($this->preBinEntry[$selectedAsset], $selectedSubAsset);

                                }
                            }
                        }
                    }

                    // ---------------------------------------------------------------
                    // Save Data to Table: SIV_ASSET_ENTRIES
                    // ---------------------------------------------------------------

                    foreach($this->selectedSubAssets as $subAssetId){

                        // ---------------------------------------------------------------
                        // Save Data to Table: SIV_ASSET_ENTRIES
                        // ---------------------------------------------------------------

                        $sivAsset = new SivAssetEntry;
                        $sivAsset->siv_id = $siv->id;
                        $sivAsset->asset_entry_id = $subAssetId;
                        $sivAsset->save();

                        // ---------------------------------------------------------------
                        // Update Asset_Status_ID on Table: ASSET_ENTRIES
                        // ---------------------------------------------------------------

                        AssetEntry::where('id', $subAssetId)
                            ->update(['asset_status_id' => 4]);

                        // Note: 'asset_status_id' with value 4 = 'Requested For Issuance'

                    }

                    // ---------------------------------------------------------------
                    // Save Data to Table: BIN_CARD_ENTRIES
                    // ---------------------------------------------------------------

                    foreach($this->selectedAssets as $selectedAsset){

                        $binCardId = BinCard::where('asset_id', $selectedAsset)->first()->id;

                        // ---------------------------------------------------------------
                        // Get latest balance_quantity
                        // ---------------------------------------------------------------

                        $latestBalanceQuantity = BinCardEntry::where('bin_card_id', $binCardId)->latest('id')->value('balance_quantity');

                        // ---------------------------------------------------------------
                        // Count the number of SubAssets selected for the Asset
                        // ---------------------------------------------------------------

                        $outQuantity = count($this->preBinEntry[$selectedAsset]);

                        // ---------------------------------------------------------------
                        // Save Data to Table: BIN_CARD_ENTRIES
                        // ---------------------------------------------------------------

                        $binCardEntry = new BinCardEntry;
                        $binCardEntry->bin_card_id = $binCardId;
                        $binCardEntry->user_type = "internal-requester";
                        $binCardEntry->user_id = auth()->guard('ims')->user()->id;
                        $binCardEntry->out_quantity = $outQuantity;
                        $binCardEntry->balance_quantity = $latestBalanceQuantity - $outQuantity;
                        $binCardEntry->officer_in_charge_id = auth()->guard('ims')->user()->id;
                        $binCardEntry->reference_type = "request-for-siv";
                        $binCardEntry->reference_id = $siv->id;
                        $binCardEntry->save();

                    }

                }

                foreach($this->storekeepers as $storekeeper){

                    // ---------------------------------------------------------------
                    // Save Data to Table: NOTIFICATION
                    // ---------------------------------------------------------------

                    $notification = new Notification();
                    $notification->sender_id = auth()->guard('ims')->user()->id;
                    $notification->receiver_id = $storekeeper->id;
                    $notification->receiver_role_id = 4;
                    $notification->message = "A Technical Team member has requested the creation of new SIV Form.";
                    $notification->read = "no";
                    $notification->reference_type = "request_for_siv";
                    $notification->reference_id = $siv->id;
                    $notification->save();

                }

                // ---------------------------------------------------------------
                // SUCCESS MESSAGE
                // ---------------------------------------------------------------

                $prevData = [
                    'message' => 'Success',
                    'description' => 'Your SIV request has been submitted.',
                ];

                return redirect()->to('/siv/request/view')->with('success', $prevData);
            }

        }
    }

    public function render()
    {
        return view('livewire.pages.siv.create-request');
    }
}
