<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExportUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $fileName = "";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): ExportUserEmail
    {
        return $this->markdown('emails.export-user-email')
            ->subject("Users Export")
            ->attachFromStorageDisk('public', $this->fileName, 'users.csv');
    }
}
