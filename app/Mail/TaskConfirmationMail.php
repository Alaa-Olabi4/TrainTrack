<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $confirmationCode;

    public function __construct($confirmationCode)
    {
        $this->confirmationCode = $confirmationCode;
    }

    public function build()
    {
        return $this->subject('Your Task Confirmation Code')
            ->view('emails.task_confirmation')
            ->with('confirmationCode', $this->confirmationCode);
    }
}
