<?php

namespace App\Http\Livewire\Pages\Siv;

use Carbon\Carbon;
use App\Models\IMS\Siv;
use App\Models\IMS\User;
use App\Models\IMS\Asset;
use App\Models\IMS\BinCard;
use Livewire\Component;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\BinCardEntry;
use App\Models\IMS\Notification;
use App\Models\IMS\SivAssetEntry;
use Illuminate\Support\Facades\Auth;

class ProcessRequest extends Component
{
    public $selectableAssets;
    public $newSelectedAssets;

    public $siv;
    public $sivId;
    public $assets;
    public $supervisors;
    public $assetEntries;

    public $stepOneSearchInput;
    public $stepOneSearchResults;

    // public $selectedAssets = [];
    public $selectedAssetMessage;
    public $selectedSubAssets = [];
    public $selectedSubAssetMessage;
    public $selectedAllSubAssets = [];

    // New
    public $selectedAssetEntries = [];
    public $selectedAssets = [];

    public $selectedSubAssetCounter = [];

    public $setItemOpen = [];

    public $deployToInternal;
    public $deployToExternal;

    public $referenceForRequest;
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

    public $receiverExists;
    public $searchReceiverNameInput;
    public $searchReceiverNameResults;
    public $searchReceiverNameId;
    public $receiverNameMessage;

    public $preBinEntry = [];

    public function mount($id)
    {
        // Grab and set ID from Route
        $this->sivId = $id;
        $this->siv = Siv::where('id', $id)->first();

        //  Make sure request has not been accepted before
        if($this->siv->request_accepted == "no"){

            // Prevent sender from processing their own form
            if($this->siv->tt_id == auth()->guard('ims')->user()->id){

                // ---------------------------------------------------------------
                // WARNING MESSAGE
                // ---------------------------------------------------------------

                $prevData = [
                    'message' => 'Warning',
                    'description' => "You notty-notty.. you can't process your own request!",
                ];

                return redirect()->route('ims.viewRequestSiv')->with('warning', $prevData);

            } else {

                // ----------------------------------------------------------------------------------------------------
                // NOTES
                // ----------------------------------------------------------------------------------------------------

                // 1. oldSelectedAssets = assets selected by TT.
                // 2. selectableAssets = Asset list. (Add in oldSelectedAssets and assets where 'asset_status_id' == 1)
                // 3. newSelectedAssets = updated list, to be saved.

                // ----------------------------------------------------------------------------------------------------
                // OLD SELECTED ASSETS
                // ----------------------------------------------------------------------------------------------------

                $sivAssetEntriesFromDb = SivAssetEntry::where('siv_id', $id)->get();
                $this->selectedAssets = [];

                if(count($sivAssetEntriesFromDb) > 0){

                    foreach($sivAssetEntriesFromDb as $sivAssetEntry){

                        $assetId = $sivAssetEntry->assetEntry->asset->id;
                        $assetEntryId = $sivAssetEntry->assetEntry->id;

                        // Make an array where: 'Key' = 'AssetID' and 'Value' = array of 'AssetEntry ID'.
                        $this->selectedAssets[$assetId][] = $assetEntryId;

                    }

                }

                // ----------------------------------------------------------------------------------------------------
                // SELECTABLE ASSETS
                // ----------------------------------------------------------------------------------------------------

                // Get asset entries with 'asset_status_id' == 1
                $availableAssetEntries = AssetEntry::where('asset_status_id', 1)->get();
                $this->selectableAssets = [];

                if(count($availableAssetEntries) > 0){

                    foreach($availableAssetEntries as $availableAssetEntry){

                        $assetId = $availableAssetEntry->asset_id;
                        $assetEntryId = $availableAssetEntry->id;

                        // Make an array where: 'Key' = 'AssetID' and 'Value' = array of 'AssetEntry ID'.
                        $this->selectableAssets[$assetId][] = $assetEntryId;
                    }

                }

                // ----------------------------------------------------------------------------------------------------
                // MERGE 'SELECTED ASSETS' AND 'SELECTABLE ASSETS'
                // ----------------------------------------------------------------------------------------------------

                // Copy the values in old to new.
                $this->newSelectedAssets = $this->selectedAssets;

                // Merge the keys from both arrays
                $keys = array_unique(array_merge(array_keys($this->selectableAssets), array_keys($this->newSelectedAssets)));

                $result = [];

                foreach ($keys as $key) {
                    $values = [];

                    // Check if the key exists in selectableAssets and add its values
                    if (isset($this->selectableAssets[$key])) {
                        $values = $this->selectableAssets[$key];
                    }

                    // Check if the key exists in newSelectedAssets and add its values
                    if (isset($this->newSelectedAssets[$key])) {
                        $values = array_merge($values, $this->newSelectedAssets[$key]);
                    }

                    // Set the combined values in the result array
                    $result[$key] = $values;
                }

                $this->selectableAssets = $result;

                $this->assets = Asset::with('assetCategoryCode', 'assetEntries.lejarSimpananEntry.lejarSimpanan.purchaseOrder', 'assetEntries.bukuDaftarEntry.bukuDaftar.purchaseOrder')->get();
                $this->assetEntries = AssetEntry::all();

                $this->deployToInternal = true;
                $this->deployToExternal = false;

                $this->receiverExists = false;
                $this->receiverLocationExists = false;

                $this->supervisors = User::whereHas('userRoles.role', function ($query) {
                    $query->where('role_id', 3);
                })->where('id', '!=', auth()->guard('ims')->user()->id)->get();

            }

        } else {

            // ---------------------------------------------------------------
            // WARNING MESSAGE
            // ---------------------------------------------------------------

            $prevData = [
                'message' => 'Warning',
                'description' => "This form has already been processed before!",
            ];

            return redirect()->route('ims.viewRequestSiv')->with('warning', $prevData);

        }

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
        $this->newSelectedAssets[$assetId] = [];
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

    public function selectSubAsset($assetEntryId, $assetId)
    {

        // NOTE: $this->selectedAssets = to store data of selected assets from form initiator (TT).

        // If Select-All
        if(in_array($assetId, $this->selectedAllSubAssets)){

            // Un-Select All
            $keyOne = array_search($assetId, $this->selectedAllSubAssets);
            unset($this->selectedAllSubAssets[$keyOne]);

            // Un-Select Single SubAsset
            if(in_array($assetEntryId, $this->newSelectedAssets[$assetId])){

                $key = array_search($assetEntryId, $this->newSelectedAssets[$assetId]);
                unset($this->newSelectedAssets[$assetId][$key]);

            }

        }

        // If Not Select-All
        else {

            // If Already Selected
            // Un-Select Single SubAsset
            if(in_array($assetEntryId, $this->newSelectedAssets[$assetId])){

                $key = array_search($assetEntryId, $this->newSelectedAssets[$assetId]);
                unset($this->newSelectedAssets[$assetId][$key]);

            } else {
                // Select Single SubAsset
                array_push($this->newSelectedAssets[$assetId], $assetEntryId);
            }

        }

    }

    public function selectAllSubAsset($assetId)
    {

        // Un-Select All
        if(in_array($assetId, $this->selectedAllSubAssets)){

            $keyOne = array_search($assetId, $this->selectedAllSubAssets);
            unset($this->selectedAllSubAssets[$keyOne]);

            // Selected
            foreach($this->selectableAssets[$assetId] as $assetEntryId){

                if(in_array($assetEntryId, $this->newSelectedAssets[$assetId])){

                    $key = array_search($assetEntryId, $this->newSelectedAssets[$assetId]);
                    unset($this->newSelectedAssets[$assetId][$key]);

                }

            }

        }

        // Select All
        else {
            array_push($this->selectedAllSubAssets, $assetId);

            foreach($this->selectableAssets[$assetId] as $assetEntryId){

                if(!in_array($assetEntryId, $this->newSelectedAssets[$assetId])){

                    array_push($this->newSelectedAssets[$assetId], $assetEntryId);

                }
            }

        }

    }

    public function removeAsset($assetId)
    {
        unset($this->newSelectedAssets[$assetId]);
    }


    // Two - 406,408 => Two - 405
    // One - 400 => One - 401

    // Two - 405 => One - 402
    // Three - 410, 411 => Three - 411, 409


    // Step 1 - Bin card tally
    // Step 2 -

    // BUGGG @ View all request !!! -> TTSK can process step 2 (ONLY PA CAN)

    // BUGG @ BIN CARD ENTRY - Balance / In / Out

    // ------------------------------------------------------------------------------------------
    // BUTTON
    // ------------------------------------------------------------------------------------------

    public function saveAndSubmit()
    {

        // dd($this->sivId);
        // dd($this->selectedAssets);
        // dd($this->selectedSubAssets);
        // dd($this->newSelectedAssets);
        // dd($this->siv->sivAssetEntries);

        // MMSD
        // Check if user is not the requester
        if(Auth::guard('ims')->user()->id !== $this->siv->receiver_id){

            // Check if user is SK
            if(Auth::guard('ims')->user()->hasRole('storekeeper')){

                // Delete other SKs notification
                $deleteOtherNotification = Notification::where('reference_type', 'request_for_siv')
                    ->where('reference_id', $this->sivId)
                    ->where('receiver_role_id', 4)
                    ->where('receiver_id', '!=', auth()->guard('ims')->user()->id)
                    ->delete();

                $dateTimeNow = Carbon::now()->timezone('Asia/Brunei')->format('Y-m-d H:i:s');

                // ---------------------------------------------------------------
                // CHECK IF THERE ARE ANY SIV IN DATABASE - FOR SIV NO
                // ---------------------------------------------------------------

                $sivCount = Siv::where('request_accepted', 'yes')->count();

                if($sivCount > 0){

                    $latestSivNo = Siv::where('request_accepted', 'yes')->orderBy('siv_no', 'desc')->pluck('siv_no')->first();

                    preg_match('/SIV(\w)(\d{3})/', $latestSivNo, $matches);
                    $letter = $matches[1];
                    $number = $matches[2];

                    if($number < 999){

                        $number++;
                        $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                        $sivNo = "SIV" . $letter . $newNumber;

                    } else {

                        $letter++;
                        $number = 1;
                        $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                        $sivNo = "SIV" . $letter . $newNumber;

                    }

                } else {
                    $sivNo = "SIVA001";
                }

                // ---------------------------------------------------------------
                // UPDATE SIV
                // ---------------------------------------------------------------

                $siv = Siv::find($this->sivId);
                $siv->request_accepted = 'yes';
                $siv->siv_no = $sivNo;
                $siv->storekeeper_id = auth()->guard('ims')->user()->id;
                $siv->storekeeper_signed = 'yes';
                $siv->storekeeper_signature_date = $dateTimeNow;
                $siv->updated_at = $dateTimeNow;
                $siv->save();

                // -------------------------------------------------------------------------
                // How to refer to Bin_card_entries from SIV?
                // -------------------------------------------------------------------------
                //  Via bin_card_entries -> reference_type and reference_id.
                //  reference_type = "request-for-siv"
                //  reference_id = "siv_id (request)"
                // -------------------------------------------------------------------------

                // ---------------------------------------------------------------
                // UPDATE SIV ASSET ENTRIES
                // ---------------------------------------------------------------

                // Change the 'asset_status_id' of old values to 1. To prevent Bin Card Entries not tallying (Front and Top part)
                foreach($this->selectedAssets as $assetId => $subAssets){

                    foreach($subAssets as $subAssetId){

                        $editAssetEntry = AssetEntry::find($subAssetId);
                        $editAssetEntry->asset_status_id = 1;
                        $editAssetEntry->save();

                    }

                }

                // Delete old SIV asset entries
                SivAssetEntry::where('siv_id', $this->sivId)->delete();

                // Delete old Bin Card entries
                BinCardEntry::where('reference_type', 'request-for-siv')->where('reference_id', $this->sivId)->delete();

                $sivDeployTo = $siv->deploy_to;

                if($sivDeployTo == "internal"){
                    $binCardEntryUserType = "internal-requester";
                } elseif($sivDeployTo == "external") {
                    $binCardEntryUserType = "external-requester";
                }

                $sivReceiverId = $siv->receiver_id;

                // Insert new SIV asset entries
                foreach($this->newSelectedAssets as $assetId => $subAssets){

                    $binCardId = BinCard::where('asset_id', $assetId)->first()->id;
                    $latestBalanceQuantity = BinCardEntry::where('bin_card_id', $binCardId)->latest('id')->value('balance_quantity');
                    $outQuantity = count($subAssets);

                    // Create new bin card entry
                    $binCardEntry = new BinCardEntry();
                    $binCardEntry->bin_card_id = $binCardId;
                    $binCardEntry->user_type = $binCardEntryUserType;
                    $binCardEntry->user_id = $sivReceiverId;
                    $binCardEntry->out_quantity = $outQuantity;
                    $binCardEntry->balance_quantity = $latestBalanceQuantity - $outQuantity;
                    $binCardEntry->officer_in_charge_id = auth()->guard('ims')->user()->id;
                    $binCardEntry->reference_type = "request-for-siv";
                    $binCardEntry->reference_id = $siv->id;
                    $binCardEntry->save();

                    foreach($subAssets as $subAssetId){

                        $createNewSivAssetEntries = new SivAssetEntry;
                        $createNewSivAssetEntries->siv_id = $this->sivId;
                        $createNewSivAssetEntries->asset_entry_id = $subAssetId;
                        $createNewSivAssetEntries->save();

                        // Change the 'asset_status_id' from 1 to 4
                        $editAssetEntry = AssetEntry::find($subAssetId);
                        $editAssetEntry->asset_status_id = 4;
                        $editAssetEntry->save();

                    }

                }

                // ---------------------------------------------------------------
                // ADD NEW NOTIFICATION (FOR ALL PA)
                // ---------------------------------------------------------------

                foreach($this->supervisors as $supervisor){

                    // ---------------------------------------------------------------
                    // Save Data to Table: NOTIFICATION
                    // ---------------------------------------------------------------

                    $notification = new Notification();
                    $notification->sender_id = auth()->guard('ims')->user()->id;
                    $notification->receiver_id = $supervisor->id;
                    // 3 = supervisor
                    $notification->receiver_role_id = 3;
                    $notification->message = "You’ve received an SIV form from " . auth()->user()->full_name . ". Click here to review and verify the form.";
                    $notification->read = "no";
                    $notification->reference_type = "siv";
                    $notification->reference_id = $siv->id;
                    $notification->save();

                }

                // ---------------------------------------------------------------
                // SUCCESS MESSAGE
                // ---------------------------------------------------------------

                $prevData = [
                    'message' => 'Success',
                    'description' => 'Request for SIV form submitted successfully!',
                ];

                return redirect()->route('ims.viewSiv')->with('success', $prevData);

            } else {

                // ---------------------------------------------------------------
                // WARNING MESSAGE
                // ---------------------------------------------------------------

                $prevData = [
                    'message' => 'Warning',
                    'description' => "You are not this form's next processor!",
                ];

                return redirect()->route('ims.viewSiv')->with('warning', $prevData);

            }

        }

    }

    public function render()
    {
        return view('livewire.pages.siv.process-request');
    }
}
