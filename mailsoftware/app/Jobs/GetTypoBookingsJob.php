<?php

namespace App\Jobs;

use App\Models\Typo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetTypoBookingsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $bookings = Typo::where('CType','mask_db_alg_pren')
            ->where('hidden', 0)
            ->where('deleted', 0)
            ->orderBy('uid', 'desc')
            ->get();

        if($bookings){
            $bookings->each(function($booking) {
                BookingSincronizationJob::dispatch($booking);
            });
        }

    }
}
