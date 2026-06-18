<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailEmemoAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $notf_Nama;
    public $notf_jabatan;
    public $notf_Jenis;
    public $notf_MemoDaripada;
    public $notf_Perkara;
    public $notf_Tarikh;
    public $notf_Icno;

    public function __construct(
        $notf_Nama,
        $notf_jabatan,
        $notf_Jenis,
        $notf_MemoDaripada,
        $notf_Perkara,
        $notf_Tarikh,
        $notf_Icno
    ) {
        $this->notf_Nama          = $notf_Nama;
        $this->notf_jabatan       = $notf_jabatan;
        $this->notf_Jenis         = $notf_Jenis;
        $this->notf_MemoDaripada  = $notf_MemoDaripada;
        $this->notf_Perkara       = $notf_Perkara;
        $this->notf_Tarikh        = $notf_Tarikh;
        $this->notf_Icno          = $notf_Icno;
    }

    public function build()
    {
        return $this->subject('Notifikasi E-Memo Baharu')
                    ->view('emails.notification.EmailEmemoAdmin');
    }
}
