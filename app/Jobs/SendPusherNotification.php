<?php

// app/Jobs/SendPusherNotification.php
namespace App\Jobs;

use Pusher\Pusher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;


class SendPusherNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $channel;
    public $event;
    public $message;

    public function __construct($channel, $event, $message)
    {
        $this->channel = $channel;
        $this->event = $event;
        $this->message = $message;
    }

    public function handle()
    {
        $pusher = new Pusher(
            "7e128d7214eddf18c6d0",
            "36b32569fb0299435f99",
            "1442095",
            ['cluster' => 'ap2']
        );

        $pusher->trigger($this->channel, $this->event, ['message' => $this->message]);
    }
}
