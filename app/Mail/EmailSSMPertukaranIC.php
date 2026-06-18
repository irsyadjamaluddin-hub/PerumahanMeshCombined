<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailSSMPertukaranIC extends Mailable
{
    use Queueable, SerializesModels;

    public $notf_Nama;
    public $notf_latestID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notf_Nama, $notf_latestID)
    {
        $this->notf_Nama = $notf_Nama;
        $this->notf_latestID = $notf_latestID;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification.EmailSSMPertukaranIC')
                    ->subject('MESH MOE SSM - Pertukaran No Kad Pengenalan');
    }
}
