<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContohEmailDua extends Mailable
{
    use Queueable, SerializesModels;

    public $notf_NamaApprover;
    public $notf_Nama;
    public $notf_jabatan;
    public $notf_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notf_NamaApprover,$notf_Nama, $notf_jabatan,$notf_id)
    {
        $this->notf_NamaApprover = $notf_NamaApprover;
        $this->notf_Nama = $notf_Nama;
        $this->notf_jabatan = $notf_jabatan;
        $this->notf_id = $notf_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('staging.email-v2')->subject('[Action Required] Verification of New User');
    }
}
