<?php

namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailRegister extends Mailable
{
    use Queueable, SerializesModels;

    use Queueable, SerializesModels;

    public $notf_Nama;
    public $notf_jabatan;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notf_Nama, $notf_jabatan)
    {
        $this->notf_Nama = $notf_Nama;
        $this->notf_jabatan = $notf_jabatan;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification.EmailRegister')->subject('[SUBMITTED] Registration Successfull');
    }
}
