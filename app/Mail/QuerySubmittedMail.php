<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuerySubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;
    public $inventory;

    public function __construct($messageContent, $inventory = null)
    {
        $this->messageContent = $messageContent;
        $this->inventory = $inventory;
    }

    public function build()
    {
        return $this->subject('New Query Submitted')
                    ->view('emails.query-submitted');
    }
}