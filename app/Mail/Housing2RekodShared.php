<?php

namespace App\Mail;

use App\Models\Housing2Rekod as Rekod;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class Housing2RekodShared extends Mailable
{
    use Queueable, SerializesModels;

    public Rekod $rekod;
    public string $ic;
    public string $pdfContent;
    public array $cfg;

    public function __construct(Rekod $rekod, string $ic, string $pdfContent, array $cfg)
    {
        $this->rekod = $rekod;
        $this->ic = $ic;
        $this->pdfContent = $pdfContent;
        $this->cfg = $cfg;
    }

    public function build()
    {
        return $this->subject('Rekod Perumahan Anda — '.$this->rekod->tajuk())
            ->view('emails.housing2.share')
            ->attachData($this->pdfContent, Str::slug($this->rekod->tajuk()).'.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
