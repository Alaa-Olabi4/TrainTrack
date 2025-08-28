<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RepliedInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry_id;


    /**
     * Create a new message instance.
     */
    public function __construct($inquiry_id)
    {
        $this->inquiry_id = $inquiry_id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Replied Inquiry Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.repliedInquiry',
        )->with([
            'inquiryUrl' => 'http://traintrack.com/details/' . $this->inquiry_id
        ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
