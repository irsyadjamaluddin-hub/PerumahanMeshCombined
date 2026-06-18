<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailApprover2Register extends Mailable
{
    use Queueable, SerializesModels;

    public $notf_NamaApprover2;
    public $notf_Nama;
    public $notf_jabatan;
    public $notf_id;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notf_NamaApprover2,$notf_Nama, $notf_jabatan,$notf_id)
    {
        $this->notf_NamaApprover2 = $notf_NamaApprover2;
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
        return $this->view('emails.notification.EmailApprover2Register');
    }
}
