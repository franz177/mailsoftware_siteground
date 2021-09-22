<?php

namespace App\Listeners\Booking;

use App\Event\Booking\BookingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogBookingListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookingEvent  $event
     * @return void
     */
    public function handle(BookingEvent $event)
    {
        Log::channel('booking')->info('Booking '.$event->message.':' , [
            'UID:' => $event->uid,
            $event->booking
        ]);
    }
}
