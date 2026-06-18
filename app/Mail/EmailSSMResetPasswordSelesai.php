<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailSSMResetPasswordSelesai extends Mailable
{
    use Queueable, SerializesModels;

    public $notf_Nama;
    public $notf_latestID;
    public $notf_otp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notf_Nama, $notf_latestID, $notf_otp)
    {
        $this->notf_Nama = $notf_Nama;
        $this->notf_latestID = $notf_latestID;
        $this->notf_otp = $notf_otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification.EmailSSMResetPasswordSelesai')
                    ->subject('MESH Moe SSM - Reset Password (Selesai)');
    }
}
