<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class MailtrapExample extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Build the message.
     *
     * @return $this
     */
public function build()
    {
        return $this->subject('MesH Registration')
            ->markdown('mails.exmpl')
            ->with([
                'name' => 'New MesH User',
                'link' => 'http://10.96.122.125'
            ]);
    }
}