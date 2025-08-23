<?php

namespace App\Jobs;

use App\Mail\NewInquiryMail;
use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNewInquiryEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $inquiryId, $recipientEmail, $username;

    public function __construct($inquiryId, $recipientEmail, $username)
    {
        $this->inquiryId = $inquiryId;
        $this->recipientEmail = $recipientEmail;
        $this->username = $username;
    }

    public function handle()
    {
        Mail::to($this->recipientEmail)
            ->send(new NewInquiryMail($this->inquiryId, $this->username));
    }
}
