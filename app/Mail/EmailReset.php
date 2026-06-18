<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailReset extends Mailable
{
 

    use Queueable, SerializesModels;

    public $notf_userEmail;
    public $notf_Icno;
    public $notf_SecurityCode;
    public $notf_id;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notf_userEmail, $notf_Icno,$notf_SecurityCode,$notf_id)
    {
        $this->notf_userEmail = $notf_userEmail;
        $this->notf_Icno = $notf_Icno;
        $this->notf_SecurityCode = $notf_SecurityCode;
        $this->notf_id = $notf_id;



    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification.EmailReset')->subject('RESET PASSWORD ACCOUNT MESH');
    }
}
