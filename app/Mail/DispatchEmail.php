<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DispatchEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $notf_services;
    public $notf_jabatan;
    public $notf_perkara;
    public $notf_kod;
    public $notf_norujukan;
    public $notf_catt;

    /**
     * Create a new message instance.
     *
     * @return void
    */
    public function __construct($notf_services, $notf_jabatan, $notf_perkara, $notf_kod,  $notf_norujukan, $notf_catt)
    {
        $this->notf_services    = $notf_services;
        $this->notf_jabatan     = $notf_jabatan;
        $this->notf_perkara     = $notf_perkara;
        $this->notf_kod         = $notf_kod;
        $this->notf_norujukan   = $notf_norujukan;
        $this->notf_catt        = $notf_catt;
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
        ->markdown('emails.notification.dispatchemail');
    }
}
