<?php

namespace App\Jobs;

use App\Mail\RepliedInquiryMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class SendRepliedInquiryEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $inquiryId, $recipientEmail;

    /**
     * Create a new job instance.
     */
    public function __construct($inquiryId, $recipientEmail)
    {
        $this->inquiryId = $inquiryId;
        $this->recipientEmail = $recipientEmail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->recipientEmail)
            ->send(new RepliedInquiryMail($this->inquiryId));
    }
}
