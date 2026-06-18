<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Siv;
use App\Models\User;
use App\Models\Receiver;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\BorangPenyerahans;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;

class ProcessEmail extends Controller
{

    public function assetReceipt(Request $request, $sivId, $receiverId, $emailReceiverId)
    {

        $dateTimeNow = Carbon::now()->timezone('Asia/Brunei')->format('Y-m-d H:i:s');

        $siv = SIV::where('id', $sivId)->first();

        // --------------------------------------------------------------------------------
        // Check if the URL has valid signature.
        // --------------------------------------------------------------------------------
        //
        // Valid signature = Link not tampered = details in link and signature matches.
        //
        // --------------------------------------------------------------------------------

        if ($request->hasValidSignature()) {

            // Internal or External
            if($siv->deploy_to == "internal"){

                // --------------------------------------------------------------------------------
                // Check if this has already been processed before
                // --------------------------------------------------------------------------------

                if(!isset($siv->mmsd_confirmed) && ($siv->mmsd_confirmed !== "yes")){

                    // ---------------------------------------------------------------
                    // Delete other MMSDs Notification
                    // ---------------------------------------------------------------

                    // Storekeeper
                    $deleteOtherNotification = Notification::where('reference_type', 'siv')
                        ->where('reference_id', $sivId)
                        ->where('receiver_role_id', 4)
                        ->where('receiver_id', '!=', auth()->user()->id)
                        ->delete();

                    // Technical-team
                    $deleteOtherNotification = Notification::where('reference_type', 'siv')
                        ->where('reference_id', $sivId)
                        ->where('receiver_role_id', 5)
                        ->where('receiver_id', '!=', auth()->user()->id)
                        ->delete();

                    // ---------------------------------------------------------------
                    // UPDATE SIV
                    // ---------------------------------------------------------------

                    $siv = Siv::find($sivId);
                    $siv->mmsd_id = $emailReceiverId;
                    $siv->mmsd_confirmed = "yes";
                    $siv->mmsd_confirm_date = $dateTimeNow;
                    $siv->updated_at = $dateTimeNow;
                    $siv->save();

                    // ---------------------------------------------------------------
                    // CREATE NEW NOTIFICATION (FOR SUPERVISOR WHO PROCESSED FORM ON STEP-2)
                    // ---------------------------------------------------------------

                    $mmsd = User::where('id', $emailReceiverId)->first();

                    $notification = new Notification();
                    $notification->sender_id = $emailReceiverId;
                    $notification->receiver_id = $siv->supervisor_id;
                    $notification->receiver_role_id = 3;
                    $notification->message =
                        "Ledger and consumables receipt for " . $siv->siv_no . " confirmed by " . $mmsd->full_name .
                        ". Process completed. The SIV form is now downloadable. Click here to view and download.";
                    $notification->read = "no";
                    $notification->reference_type = "siv-download";
                    $notification->reference_id = $siv->id;
                    $notification->save();

                    // ---------------------------------------------------------------
                    // CREATE NEW NOTIFICATION (FOR MMSD)
                    // ---------------------------------------------------------------

                    $notification = new Notification();
                    $notification->sender_id = $emailReceiverId;
                    $notification->receiver_id = $siv->mmsd_id;
                    // $notification->receiver_role_id = 5;
                    $notification->message =
                        "Ledger and consumables receipt for " . $siv->siv_no . " confirmed by " . $mmsd->full_name .
                        ". Process completed. The SIV form is now downloadable. Click here to view and download.";
                    $notification->read = "no";
                    $notification->reference_type = "siv-download";
                    $notification->reference_id = $siv->id;
                    $notification->save();


                    // ---------------------------------------------------------------
                    // CREATE NEW NOTIFICATION (FOR SK)
                    // ---------------------------------------------------------------

                    $mmsd = User::where('id', $emailReceiverId)->first();

                    $notification = new Notification();
                    $notification->sender_id = $emailReceiverId;
                    $notification->receiver_id = $siv->storekeeper_id;
                    $notification->receiver_role_id = 4;
                    $notification->message =
                        "Ledger and consumables receipt for " . $siv->siv_no . " confirmed by " . $mmsd->full_name .
                        ". Process completed. The SIV form is now downloadable. Click here to view and download.";
                    $notification->read = "no";
                    $notification->reference_type = "siv-download";
                    $notification->reference_id = $siv->id;
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
                    $borangPenyerahan->siv_id = $siv->id;
                    $borangPenyerahan->bp_no = $bpNo;
                    $borangPenyerahan->save();

                    // ---------------------------------------------------------------
                    // SEND NEW NOTIFICATION (ABOUT BORANG PENYERAHAN) TO (MMSD)
                    // ---------------------------------------------------------------

                    $user = User::where('id', auth()->user()->id)->with('userRoles', 'roles')->first();

                    foreach($user->roles as $role){

                        $notification = new Notification();
                        $notification->sender_id = auth()->user()->id;
                        $notification->receiver_id = auth()->user()->id;
                        $notification->receiver_role_id = $role->id;
                        $notification->message =
                        "A new Borang Penyerahan has been created from " . $siv->siv_no .
                        ". Click here to initiate the form update and processing.";
                        $notification->read = "no";
                        $notification->reference_type = "pre-penyerahan";
                        $notification->reference_id = $borangPenyerahan->id; ;
                        $notification->save();

                    }

                    // ---------------------------------------------------------------
                    // SEND SIV FORM COPY (PDF), IN-SYSTEM, TO (MMSD), (SK), (SUPERVISOR)
                    // ---------------------------------------------------------------

                    $title = "Receipt Confirmed!";
                    $description = "Thank you for responding.";

                } else {

                    $title = "We regret to inform you that this form has previously undergone a confirmation process.";
                    $description = "";

                }

            } elseif($siv->deploy_to == "external") {

                if(!isset($siv->tt_signed) && ($siv->tt_signed !== "yes")){

                    $title = "Receipt Confirmed!";
                    $description = "Thank you for responding.";

                    // ---------------------------------------------------------------
                    // UPDATE SIV
                    // ---------------------------------------------------------------

                    $siv = Siv::find($sivId);
                    $siv->tt_signed = 'yes';
                    $siv->tt_signature_date = $dateTimeNow;
                    $siv->updated_at = $dateTimeNow;
                    $siv->save();

                    // ---------------------------------------------------------------
                    // CREATE NEW NOTIFICATION (FOR SUPERVISOR WHO PROCESSED FORM ON STEP-2)
                    // ---------------------------------------------------------------

                    $tt = User::where('id', $emailReceiverId)->first();

                    $notification = new Notification();
                    $notification->sender_id = $emailReceiverId;
                    $notification->receiver_id = $siv->supervisor_id;
                    $notification->receiver_role_id = 3;
                    $notification->message =
                        "Ledger and consumables receipt for " . $siv->siv_no . " confirmed by " . $tt->full_name .
                        ". Process completed. The SIV form is now downloadable. Click here to view and download.";
                    $notification->read = "no";
                    $notification->reference_type = "siv-download";
                    $notification->reference_id = $siv->id;
                    $notification->save();

                    // ---------------------------------------------------------------
                    // CREATE NEW NOTIFICATION (FOR SK)
                    // ---------------------------------------------------------------

                    $notification = new Notification();
                    $notification->sender_id = $emailReceiverId;
                    $notification->receiver_id = $siv->storekeeper_id;
                    $notification->receiver_role_id = 4;
                    $notification->message =
                        "Ledger and consumables receipt for " . $siv->siv_no . " confirmed by " . $tt->full_name .
                        ". Process completed. The SIV form is now downloadable. Click here to view and download.";
                    $notification->read = "no";
                    $notification->reference_type = "siv-download";
                    $notification->reference_id = $siv->id;
                    $notification->save();

                    // ---------------------------------------------------------------
                    // CREATE NEW NOTIFICATION (FOR TT)
                    // ---------------------------------------------------------------

                    $notification = new Notification();
                    $notification->sender_id = $emailReceiverId;
                    $notification->receiver_id = $siv->tt_id;
                    $notification->receiver_role_id = 5;
                    $notification->message =
                        "Ledger and consumables receipt for " . $siv->siv_no . " confirmed by " . $tt->full_name .
                        ". Process completed. The SIV form is now downloadable. Click here to view and download.";
                    $notification->read = "no";
                    $notification->reference_type = "siv-download";
                    $notification->reference_id = $siv->id;
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
                    $borangPenyerahan->siv_id = $siv->id;
                    $borangPenyerahan->bp_no = $bpNo;
                    $borangPenyerahan->save();

                    // ---------------------------------------------------------------
                    // SEND NEW NOTIFICATION (ABOUT BORANG PENYERAHAN) TO (TT)
                    // ---------------------------------------------------------------

                    $user = User::where('id', $siv->tt_id)->with('userRoles', 'roles')->first();

                    foreach($user->roles as $role){

                        $notification = new Notification();
                        $notification->sender_id = auth()->user()->id;
                        $notification->receiver_id = $siv->tt_id;
                        $notification->receiver_role_id = $role->id;
                        $notification->message =
                        "A new Borang Penyerahan has been created from " . $siv->siv_no .
                        ". Click here to initiate the form update and processing.";
                        $notification->read = "no";
                        $notification->reference_type = "pre-penyerahan";
                        $notification->reference_id = $borangPenyerahan->id; ;
                        $notification->save();

                    }

                } else {

                    $title = "We regret to inform you that this form has previously undergone a confirmation process.";
                    $description = "";

                }

            }

            return view('emails.processEmail')->with('title', $title)->with('description', $description);

        } else {

            abort(403, 'Invalid URL signature.');

        }


    }

}
