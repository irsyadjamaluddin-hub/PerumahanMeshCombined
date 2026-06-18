<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerifiedAccount extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $notf_Nama;
    public string $notf_jabatan;
    public string $notf_id;

    public int $tries = 3;
    public int $backoff = 30;
    // ❌ remove: public bool $afterCommit = true;

    public function __construct(string $notf_Nama, ?string $notf_jabatan = null, string $notf_id)
    {
        $this->notf_Nama = $notf_Nama;
        $this->notf_jabatan = $notf_jabatan ?? 'Unknown Department';
        $this->notf_id = $notf_id;
        $this->afterCommit();
    }

    public function build()
    {
        return $this->subject('[VERIFIED] MESH Registration')
                    ->view('emails.notification.EmailVerifiedAccount');
    }
}
