<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class AnnouncementEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $notf_file;
    public $notf_image;
    public $notf_title;
    public $notf_date;
    public $notf_icon;
    public $notf_content;
    public $notf_userEmails;
    public $notf_services;
    public $announcement;
    public $filename; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notf_file, $notf_image, $filename, $notf_title, $notf_date, $notf_icon, $notf_content, $notf_userEmails, $notf_services,  $announcement )
    {
        $this->notf_image       = $notf_image;
        $this->filename         = $filename; // Assign the variable to the class property
        $this->notf_file        = $notf_file;
        $this->notf_title       = $notf_title;
        $this->notf_date        = $notf_date;
        $this->notf_icon        = $notf_icon;
        $this->notf_content     = $notf_content;
        $this->notf_userEmails  = $notf_userEmails;
        $this->notf_services    = $notf_services;
        $this->announcement     = $announcement;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdfFileUrls = [];

        foreach ($this->announcement as $document) {
            // Use the asset function to generate the URL without 'public' segment
            $pdfFileUrls[] = asset('storage/announcement/' . $document);
        }

        return $this
        ->subject($this->notf_services.' - ' .$this->notf_title)
        ->markdown('emails.notification.announcementemail', ['pdfFileUrls' => $pdfFileUrls]);
    }
}
