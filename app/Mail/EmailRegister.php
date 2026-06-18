<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailRegister extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $notf_Nama;
    public string $notf_jabatan;

    public int $tries = 3;
    public int $backoff = 30;
    // ❌ remove: public bool $afterCommit = true;

    public function __construct(string $notf_Nama, string $notf_jabatan)
    {
        $this->notf_Nama    = $notf_Nama;
        $this->notf_jabatan = $notf_jabatan;

        // Either of these is fine:
        $this->afterCommit();      // ✅ preferred helper from the trait
        // or: $this->afterCommit = true;  // ✅ assign without redeclaring the property
    }

    public function build()
    {
        return $this->subject('[SUBMITTED] Registration Successful')
                    ->view('emails.notification.EmailRegister');
    }
}
