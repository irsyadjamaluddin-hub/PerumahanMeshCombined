<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailApprover2Register extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $notf_NamaApprover2;
    public string  $notf_Nama;
    public string  $notf_jabatan;
    public string $notf_id;

    public int $tries   = 3;
    public int $backoff = 30;

    public function __construct(
        string $notf_NamaApprover2,
        string  $notf_Nama,
        string  $notf_jabatan,
        string $notf_id,
    ) {
        $this->notf_NamaApprover2 = $notf_NamaApprover2;
        $this->notf_Nama          = $notf_Nama;
        $this->notf_jabatan       = $notf_jabatan;
        $this->notf_id            = $notf_id;

        $this->afterCommit(); // <-- avoid redeclaring $afterCommit
    }

    public function build()
    {
        return $this->subject('[ACTION REQUIRED] DevOps Verification')
        ->view('emails.notification.EmailApprover2Register');
    }
}