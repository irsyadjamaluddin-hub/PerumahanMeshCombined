<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MoeEventRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $notf_Nama;
    public $notf_EventLabel;
    public $notf_jabatan;
    public $notf_EventTime;

    // Added by Amal 'Izzah (PB)
    public $notf_EventDate;
    public $notf_EventVenue;
    public $notf_tel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $notf_Nama, $notf_EventLabel, $notf_jabatan, $notf_EventTime, $notf_EventDate, $notf_EventVenue, $notf_tel)
    {
        $this->notf_Nama = $notf_Nama;
        $this->notf_EventLabel = $notf_EventLabel;
        $this->notf_jabatan = $notf_jabatan;
        $this->notf_EventTime = $notf_EventTime;
        $this->notf_tel = $notf_tel;
        $this->notf_EventDate = $notf_EventDate;
        $this->notf_EventVenue = $notf_EventVenue;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification.MOEEventRegistered');
    }
}

