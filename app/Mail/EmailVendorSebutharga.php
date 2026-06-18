<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVendorSebutharga extends Mailable
{
    use Queueable, SerializesModels;

    public $notf_userEmail;
    public $notf_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notf_userEmail, $notf_id)
    {
        $this->notf_userEmail = $notf_userEmail;
        $this->notf_id = $notf_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification.EmailVendorSebutharga')
                    ->subject('Senarai Agihan dan Pengesahan Penerimaan Bahan');
    }
}
