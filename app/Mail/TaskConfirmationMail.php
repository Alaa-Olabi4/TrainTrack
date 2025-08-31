<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;


class TaskConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    // public $taskUrl;

    public function __construct()
    {
        // $this->taskUrl = $taskUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Task Assigned',
        );
    }
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $domain = env('domain');
        return new Content(
            view: 'emails.task_confirmation',
        )->with([
            'taskUrl' => 'https://d699294a5af8.ngrok-free.app/tasks/' //. $this->taskUrl,
        ]);
    }
}
