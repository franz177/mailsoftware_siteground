<?php

namespace App\Listeners\Booking;

use App\Event\Booking\BookingErrorEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogBookingErrorListener implements ShouldQueue
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
     * @param  BookingErrorEvent  $event
     * @return void
     */
    public function handle(BookingErrorEvent $event)
    {
        Log::channel('booking_error')->info('Booking '.$event->message.':' , [
            'UID: '      => $event->uid,
            'Error: '   => $event->error,
        ]);
    }
}
