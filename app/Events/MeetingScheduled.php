<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Queue\SerializesModels;

class MeetingScheduled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $meeting;

    public function __construct($meeting)
    {
        $this->meeting = $meeting;
    }

    public function broadcastOn()
    {
        return new Channel('meetings');
    }

    public function toBroadcast()
    {
        return new BroadcastMessage([
            'meeting' => $this->meeting,
        ]);
    }
}
