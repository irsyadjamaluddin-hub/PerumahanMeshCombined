<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class BorangPenerimaanMail extends Mailable
{
    use Queueable, SerializesModels;
    public $inventory;
    public $recipientName;

    public function __construct($inventory, $recipientName)
    {
        $this->inventory = $inventory;
        $this->recipientName = $recipientName;
    }

    public function build()
    {
        return $this->subject('[Pengesahan] -Buku telah Dihantar')
                    ->view('emails.inventory.pengesahansebutharga');
    }


}
