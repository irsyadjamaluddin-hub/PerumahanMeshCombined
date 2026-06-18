<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailPermohonanBahanKurikulum extends Mailable
{
    use Queueable, SerializesModels;

    public $notf_userEmail;
    public $notf_namagb;
    public $notf_sekolah;
    public $notf_nama;
    public $notf_date;
    public $notf_id;
  


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notf_userEmail,$notf_namagb,$notf_sekolah,$notf_nama,$notf_date,$notf_id)
    {
        $this->notf_userEmail = $notf_userEmail;
        $this->notf_namagb = $notf_namagb;
        $this->notf_sekolah = $notf_sekolah;
        $this->notf_nama = $notf_nama;
        $this->notf_date = $notf_date;
        $this->notf_id = $notf_id;
    }


      
      
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification.EmailPermohonanBahanKurikulum')
                    ->subject('[Pengesahan] Permohonan Bahan-Bahan Kurikulum');
    }
}

