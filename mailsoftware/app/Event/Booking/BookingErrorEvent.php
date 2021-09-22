<?php

namespace App\Event\Booking;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingErrorEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $uid;
    public $error;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $uid, $error)
    {
        $this->message = $message;
        $this->uid = $uid;
        $this->error = $error;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
