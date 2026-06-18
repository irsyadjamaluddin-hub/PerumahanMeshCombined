<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorrespondenceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $notf_services;
    public $notf_nofolio;
    public $notf_kod;
    public $notf_ulasanpass;
    public $notf_tindakanpass;

    /**
     * Create a new message instance.
     *
     * @return void
    */
    public function __construct($notf_services, $notf_nofolio, $notf_kod,  $notf_ulasanpass, $notf_tindakanpass)
    {
        $this->notf_services        = $notf_services;
        $this->notf_nofolio         = $notf_nofolio;
        $this->notf_kod             = $notf_kod;
        $this->notf_ulasanpass      = $notf_ulasanpass;
        $this->notf_tindakanpass    = $notf_tindakanpass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject($this->notf_services)
        ->markdown('emails.notification.correspondenceemail');
    }
}
