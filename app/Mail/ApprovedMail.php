<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inventory;

    public function __construct($inventory)
    {
        $this->inventory = $inventory;
    }

    public function build()
    {
        return $this->subject('Permohonan Diluluskan - ' . ($this->inventory->nama_sch ?? 'Permohonan BBK'))
                    ->view('emails.approved')
                    ->with([
                        'inventory' => $this->inventory
                    ]);
    }
}