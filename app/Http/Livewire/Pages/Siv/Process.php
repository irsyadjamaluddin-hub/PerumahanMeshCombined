<?php

namespace App\Http\Livewire\Pages\Siv;

use Carbon\Carbon;
use App\Models\IMS\Siv;
use App\Models\IMS\User;
use App\Models\IMS\Asset;
use Livewire\Component;
use App\Models\IMS\Receiver;
use App\Mail\AssetReceipt;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\Notification;
use App\Models\IMS\SivAssetEntry;
use App\Models\IMS\BukuDaftarEntry;
use App\Models\IMS\BorangPenyerahans;
use App\Models\IMS\LejarSimpananEntry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Process extends Component
{
    public $selectableAssets;
    public $newSelectedAssets;

    public $tts;
    public $siv;
    public $users;
    public $mmsds;
    public $sivId;
    public $assets;
    public $storekeepers;
    public $assetEntries;

    public $deployToInternal;
    public $deployToExternal;

    public $lejarSimpananEntry;
    public $bukuDaftarEntry;

    public function mount($id)
    {
        // $this->siv = Siv::where('siv_no', 'SIVA011')->first();

        // $user = User::where('id', $this->siv->mmsd_id)->with('userRoles', 'roles')->first();

        // foreach($user->roles as $role){

        //     dd($role->id);

        // }

        $this->users = User::all();

        // Grab and set ID from Route
        $this->sivId = $id;
        $this->siv = Siv::where('id', $id)->first();

        $this->lejarSimpananEntry = LejarSimpananEntry::with('lejarSimpanan')->get();
        $this->bukuDaftarEntry = BukuDaftarEntry::with('bukuDaftar')->get();

        $this->assets = Asset::with('assetCategoryCode', 'assetEntries.lejarSimpananEntry.lejarSimpanan.purchaseOrder', 'assetEntries.bukuDaftarEntry.bukuDaftar.purchaseOrder')->get();
        $this->assetEntries = AssetEntry::all();

        $this->storekeepers = User::whereHas('userRoles.role', function ($query) {
            $query->where('role_id', 4);
        })->where('id', '!=', auth()->guard('ims')->user()->id)->get();

        // Final Step: If form completed, forward user to view all SIV page. Prevent user from accessing form after SIV completed.
        if(($this->siv->deploy_to == "internal" && ($this->siv->mmsd_confirmed !== null || $this->siv->mmsd_confirmed == "yes")) || ($this->siv->deploy_to == "external" && ($this->siv->tt_signed !== null || $this->siv->tt_signed == "yes"))){

            return redirect()->route('ims.viewSiv');
        }

        // Step 2: Check if form is already verified by Supervisor
        elseif($this->siv->supervisor_verified == "yes"){

            // Is barang to be deployed for 'Internal' or 'External'?
            if($this->siv->deploy_to == "internal"){

                // MMSD
                // Check if user is not the requester
                if(Auth::guard('ims')->user()->id !== $this->siv->receiver_id){

                    // Check if user is TT or SK
                    if(Auth::guard('ims')->user()->hasRole('technical-team') || Auth::guard('ims')->user()->hasRole('storekeeper')){

                        // Good

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

            } elseif($this->siv->deploy_to == "external"){

                // TT
                // Check if user is the requester
                if(Auth::guard('ims')->user()->id == $this->siv->tt_id){

                    // Check if user is TT
                    if(Auth::guard('ims')->user()->hasRole('technical-team')){

                        //Good

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

        // Step 1: Only show if form have not been processed by Supervisor
        elseif($this->siv->supervisor_verified == "no" || !isset($this->siv->supervisor_verified)){

            // Check if user's role is Supervisor
            if(Auth::guard('ims')->user()->hasRole('supervisor') || Auth::guard('ims')->user()->hasRole('network-asset-supervisor')){
                // Good
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

        else {
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

    public function sendEmail()
    {
        $deployTo = $this->siv->deploy_to;
        $receiverId = $this->siv->receiver_id;
        $ttId = $this->siv->tt_id;

        if($deployTo == "internal"){

            // Send email to TTs or SKs, other than final receiver.
            $this->mmsds = User::where(function ($query) {
                $query->whereHas('userRoles.role', function ($query) {
                    // Storekeepers
                    $query->where('role_id', 4);
                })->orWhereHas('userRoles.role', function ($query) {
                    // Technical Team
                    $query->where('role_id', 5);
                });
            })->where('id', '!=', $this->siv->receiver_id)->get();

            foreach($this->mmsds as $mmsd){

                $details = [
                    'siv_id' => $this->siv->id,
                    'receiver_id' => $receiverId,
                    'email_receiver_id' => $mmsd->id,
                ];

                $email = $mmsd->email;

                Mail::to($email)->send(new AssetReceipt($details));

            }
        }

        elseif($deployTo == "external") {

            // Send email to TT (first siv_requester)
            $details = [
                'siv_id' => $this->siv->id,
                'receiver_id' => $receiverId,
                'email_receiver_id' => $this->siv->tt_id,
            ];

            $email = $this->siv->techteam->email;

            Mail::to($email)->send(new AssetReceipt($details));

        }

    }

    // ------------------------------------------------------------------------------------------
    // BUTTON
    // ------------------------------------------------------------------------------------------

    public function saveAndSubmit()
    {
        // Current logged in user == mmsd
        $user = User::where('id', auth()->guard('ims')->user()->id)->with('userRoles', 'roles')->first();

        $dateTimeNow = Carbon::now()->timezone('Asia/Brunei')->format('Y-m-d H:i:s');

        // Step 2 (Final): Supervisor (PA) already verified. TT (external) or MMSD (internal) process next.
        if ($this->siv->supervisor_verified !== null){

            // Internal or External
            if($this->siv->deploy_to == "internal"){

                // ---------------------------------------------------------------
                // Delete other MMSDs Notification
                // ---------------------------------------------------------------

                // Storekeeper
                $deleteOtherNotification = Notification::where('reference_type', 'siv')
                    ->where('reference_id', $this->sivId)
                    ->where('receiver_role_id', 4)
                    ->where('receiver_id', '!=', auth()->guard('ims')->user()->id)
                    ->delete();

                // Technical-team
                $deleteOtherNotification = Notification::where('reference_type', 'siv')
                    ->where('reference_id', $this->sivId)
                    ->where('receiver_role_id', 5)
                    ->where('receiver_id', '!=', auth()->guard('ims')->user()->id)
                    ->delete();

                // ---------------------------------------------------------------
                // UPDATE SIV
                // ---------------------------------------------------------------

                $siv = Siv::find($this->siv->id);
                $siv->mmsd_id = auth()->guard('ims')->user()->id;
                $siv->mmsd_confirmed = "yes";
                $siv->mmsd_confirm_date = $dateTimeNow;
                $siv->updated_at = $dateTimeNow;
                $siv->save();

                // ---------------------------------------------------------------
                // CREATE NEW NOTIFICATION (FOR SUPERVISOR WHO PROCESSED FORM ON STEP-2)
                // ---------------------------------------------------------------

                // $mmsd = User::where('id', $this->siv->)->first();

                $notification = new Notification();
                $notification->sender_id = auth()->guard('ims')->user()->id;
                $notification->receiver_id = $this->siv->supervisor_id;
                $notification->receiver_role_id = 3;
                $notification->message =
                    "Ledger and consumables receipt for " . $this->siv->siv_no . " confirmed by " . auth()->user()->full_name .
                    ". Process completed. The SIV form is now downloadable. Click here to view and download.";
                $notification->read = "no";
                $notification->reference_type = "siv-download";
                $notification->reference_id = $siv->id;
                $notification->save();

                // ---------------------------------------------------------------
                // CREATE NEW NOTIFICATION (FOR MMSD)
                // ---------------------------------------------------------------

                $notification = new Notification();
                $notification->sender_id = auth()->guard('ims')->user()->id;
                $notification->receiver_id = $this->siv->mmsd_id;
                $notification->receiver_role_id = 5;
                $notification->message =
                    "Ledger and consumables receipt for " . $this->siv->siv_no . " confirmed by " . auth()->user()->full_name .
                    ". Process completed. The SIV form is now downloadable. Click here to view and download.";
                $notification->read = "no";
                $notification->reference_type = "siv-download";
                $notification->reference_id = $this->siv->id;
                $notification->save();

                // ---------------------------------------------------------------
                // CREATE NEW NOTIFICATION (FOR SK)
                // ---------------------------------------------------------------

                $notification = new Notification();
                $notification->sender_id = auth()->guard('ims')->user()->id;
                $notification->receiver_id = $this->siv->storekeeper_id;
                $notification->receiver_role_id = 4;
                $notification->message =
                    "Ledger and consumables receipt for " . $this->siv->siv_no . " confirmed by " . auth()->user()->full_name  .
                    ". Process completed. The SIV form is now downloadable. Click here to view and download.";
                $notification->read = "no";
                $notification->reference_type = "siv-download";
                $notification->reference_id = $this->siv->id;
                $notification->save();

                // ---------------------------------------------------------------
                // SEND SIV FORM COPY (PDF), IN-SYSTEM, TO (MMSD), (SK), (SUPERVISOR)
                // ---------------------------------------------------------------
                // TBC. For now pakai yang print-pdf -> save to pdf method, pasal yang domPdf inda
                // support css baru.

                // ---------------------------------------------------------------
                // BORANG PENYERAHAN LETTER-CODING
                // Format: BPA00X
                // ---------------------------------------------------------------

                $borangPenyerahanCount = BorangPenyerahans::count();

                if($borangPenyerahanCount > 0){

                    $latestBorangPenyerahanNo = BorangPenyerahans::latest('id')->pluck('bp_no')->first();
                    preg_match('/BP(\w)(\d{3})/', $latestBorangPenyerahanNo, $matches);
                    $letter = $matches[1];
                    $number = $matches[2];

                    if($number < 999){

                        $number++;
                        $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                        $bpNo = "BP" . $letter . $newNumber;

                    } else {

                        $letter++;
                        $number = 1;
                        $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                        $bpNo = "BP" . $letter . $newNumber;

                    }

                } else {

                    $bpNo = "BPA001";

                }

                // ---------------------------------------------------------------
                // CREATE NEW [BORANG PENYERAHAN] RECORD
                // ---------------------------------------------------------------

                $borangPenyerahan = new BorangPenyerahans();
                $borangPenyerahan->siv_id = $this->siv->id;
                $borangPenyerahan->bp_no = $bpNo;
                $borangPenyerahan->save();

                // ---------------------------------------------------------------
                // SEND NEW NOTIFICATION (ABOUT BORANG PENYERAHAN) TO (MMSD)
                // ---------------------------------------------------------------

                $user = User::where('id', auth()->guard('ims')->user()->id)->with('userRoles', 'roles')->first();

                foreach($user->roles as $role){

                    $notification = new Notification();
                    $notification->sender_id = auth()->guard('ims')->user()->id;
                    $notification->receiver_id = auth()->guard('ims')->user()->id;
                    $notification->receiver_role_id = $role->id;
                    $notification->message =
                    "A new Borang Penyerahan has been created from " . $this->siv->siv_no .
                    ". Click here to initiate the form update and processing.";
                    $notification->read = "no";
                    $notification->reference_type = "pre-penyerahan";
                    $notification->reference_id = $borangPenyerahan->id;
                    $notification->save();

                }

            } elseif($this->siv->deploy_to == "external") {

                // ---------------------------------------------------------------
                // UPDATE SIV
                // ---------------------------------------------------------------

                $siv = Siv::find($this->siv->id);
                $siv->tt_signed = 'yes';
                $siv->tt_signature_date = $dateTimeNow;
                $siv->updated_at = $dateTimeNow;
                $siv->save();

                // ---------------------------------------------------------------
                // CREATE NEW NOTIFICATION (FOR SUPERVISOR WHO PROCESSED FORM ON STEP-2)
                // ---------------------------------------------------------------

                $notification = new Notification();
                $notification->sender_id = auth()->guard('ims')->user()->id;
                $notification->receiver_id = $this->siv->supervisor_id;
                $notification->receiver_role_id = 3;
                $notification->message =
                    "Ledger and consumables receipt for " . $this->siv->siv_no . " confirmed by " . auth()->user()->full_name .
                    ". Process completed. The SIV form is now downloadable. Click here to view and download.";
                $notification->read = "no";
                $notification->reference_type = "siv-download";
                $notification->reference_id = $this->siv->id;
                $notification->save();

                // ---------------------------------------------------------------
                // CREATE NEW NOTIFICATION (FOR SK)
                // ---------------------------------------------------------------

                $notification = new Notification();
                $notification->sender_id = auth()->guard('ims')->user()->id;
                $notification->receiver_id = $this->siv->storekeeper_id;
                $notification->receiver_role_id = 4;
                $notification->message =
                    "Ledger and consumables receipt for " . $this->siv->siv_no . " confirmed by " . auth()->user()->full_name .
                    ". Process completed. The SIV form is now downloadable. Click here to view and download.";
                $notification->read = "no";
                $notification->reference_type = "siv-download";
                $notification->reference_id = $this->siv->id;
                $notification->save();

                // ---------------------------------------------------------------
                // CREATE NEW NOTIFICATION (FOR TT)
                // ---------------------------------------------------------------

                $notification = new Notification();
                $notification->sender_id = auth()->guard('ims')->user()->id;
                $notification->receiver_id = $this->siv->tt_id;
                $notification->receiver_role_id = 5;
                $notification->message =
                    "Ledger and consumables receipt for " . $this->siv->siv_no . " confirmed by " . auth()->user()->full_name .
                    ". Process completed. The SIV form is now downloadable. Click here to view and download.";
                $notification->read = "no";
                $notification->reference_type = "siv-download";
                $notification->reference_id = $this->siv->id;
                $notification->save();

                // ---------------------------------------------------------------
                // BORANG PENYERAHAN LETTER-CODING
                // Format: BPA00X
                // ---------------------------------------------------------------

                $borangPenyerahanCount = BorangPenyerahans::count();

                if($borangPenyerahanCount > 0){

                    $latestBorangPenyerahanNo = BorangPenyerahans::latest('id')->pluck('bp_no')->first();
                    preg_match('/BP(\w)(\d{3})/', $latestBorangPenyerahanNo, $matches);
                    $letter = $matches[1];
                    $number = $matches[2];

                    if($number < 999){

                        $number++;
                        $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                        $bpNo = "BP" . $letter . $newNumber;

                    } else {

                        $letter++;
                        $number = 1;
                        $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                        $bpNo = "BP" . $letter . $newNumber;

                    }

                } else {

                    $bpNo = "BPA001";

                }

                // ---------------------------------------------------------------
                // CREATE NEW [BORANG PENYERAHAN] RECORD
                // ---------------------------------------------------------------

                $borangPenyerahan = new BorangPenyerahans();
                $borangPenyerahan->siv_id = $this->siv->id;
                $borangPenyerahan->bp_no = $bpNo;
                $borangPenyerahan->save();

                // ---------------------------------------------------------------
                // SEND NEW NOTIFICATION (ABOUT BORANG PENYERAHAN) TO (TT)
                // ---------------------------------------------------------------

                $user = User::where('id', $this->siv->tt_id)->with('userRoles', 'roles')->first();

                foreach($user->roles as $role){

                    $notification = new Notification();
                    $notification->sender_id = auth()->guard('ims')->user()->id;
                    $notification->receiver_id = $this->siv->tt_id;
                    $notification->receiver_role_id = $role->id;
                    $notification->message =
                    "A new Borang Penyerahan has been created from " . $this->siv->siv_no .
                    ". Click here to initiate the form update and processing.";
                    $notification->read = "no";
                    $notification->reference_type = "pre-penyerahan";
                    $notification->reference_id = $borangPenyerahan->id;
                    $notification->save();

                }

            }

        }

        // Step 1: Storekeeper (SK) already signed. PA process next.
        elseif($this->siv->storekeeper_signed !== null && $this->siv->supervisor_verified == null){

            // Delete other PAs notification for this SIV.
            $deleteOtherNotification = Notification::where('reference_type', 'siv')
                ->where('reference_id', $this->sivId)
                ->where('receiver_role_id', 3)
                ->where('receiver_id', '!=', auth()->guard('ims')->user()->id)
                ->delete();

            // ---------------------------------------------------------------
            // UPDATE SIV
            // ---------------------------------------------------------------

            $siv = Siv::find($this->sivId);
            $siv->request_accepted = 'yes';
            $siv->supervisor_id = auth()->guard('ims')->user()->id;
            $siv->supervisor_verified = 'yes';
            $siv->supervisor_verification_date = $dateTimeNow;
            $siv->updated_at = $dateTimeNow;
            $siv->save();

            // ---------------------------------------------------------------
            // CREATE NEW NOTIFICATION FOR SK
            // ---------------------------------------------------------------

            $notification = new Notification();
            $notification->sender_id = auth()->guard('ims')->user()->id;
            $notification->receiver_id = $this->siv->storekeeper_id;
            $notification->receiver_role_id = 4;
            $notification->message = auth()->user()->full_name . " (PA) has verified the SIV form " . $siv->siv_no . ". Please proceed with the ledger/consumable handover for " . $siv->siv_no . ".";
            $notification->read = "no";
            $notification->reference_type = "siv";
            $notification->reference_id = $siv->id;
            $notification->save();

            // ---------------------------------------------------------------
            // CREATE NEW NOTIFICATION FOR TT
            // ---------------------------------------------------------------

            $notification = new Notification();
            $notification->sender_id = auth()->guard('ims')->user()->id;
            $notification->receiver_id = $this->siv->tt_id;
            $notification->receiver_role_id = 5;
            $notification->message = auth()->user()->full_name . " (PA) has verified the SIV form " . $siv->siv_no . ". Please confirm the receipt on your email or by clicking here.";
            $notification->read = "no";
            $notification->reference_type = "siv";
            $notification->reference_id = $siv->id;
            $notification->save();


            // ---------------------------------------------------------------
            // SEND EMAIL
            // ---------------------------------------------------------------

            $this->sendEmail();

        }

        // ---------------------------------------------------------------
        // SUCCESS MESSAGE
        // ---------------------------------------------------------------

        $prevData = [
            'message' => 'Success',
            'description' => 'SIV form successfully processed!',
        ];

        return redirect()->route('ims.viewSiv')->with('success', $prevData);

    }

    public function render()
    {
        return view('livewire.pages.siv.process');
    }
}
