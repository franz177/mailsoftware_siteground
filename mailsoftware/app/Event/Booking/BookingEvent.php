<?php

namespace App\Event\Booking;

use App\Models\Booking;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $booking;
    public $message;
    public $uid;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($booking, $message, $uid)
    {
        $this->booking = $booking;
        $this->message = $message;
        $this->uid = $uid;
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
