<?php

namespace App\Http\Controllers;

use App\Jobs\ArtisanQueueWorkJob;
use App\Jobs\BookingSincronizationJob;
use App\Jobs\GetTypoBookingsJob;
use App\Models\Booking;
use App\Models\Typo;
use App\Models\TypoBiancCsPeriodo;
use App\Models\TypoCHouse;
use App\Models\TypoHouses;
use App\Models\TypoRange;
use App\Models\TypoRangeMM;
use App\Models\TypoUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $month = now()->month;
        $bookings = Typo::where('CType','mask_db_alg_pren')
            ->where('hidden', 0)
            ->where('deleted', 0)
            ->where(Typo::raw('MONTH(FROM_UNIXTIME(tstamp))'), '=', $month)
            ->orderBy('uid', 'desc')
            ->get();




        return Booking::find(1525);

    }

    public function force()
    {
//        $bookings = Typo::where('CType','mask_db_alg_pren')
//            ->where('hidden', 0)
//            ->where('deleted', 0)
//            ->orderBy('uid', 'desc')
//            ->get();
//
//        $bookings->each(function($booking) {
//            BookingSincronizationJob::dispatch($booking);
//        });

        BookingSincronizationJob::dispatch();

        Artisan::call('queue:work',['--stop-when-empty' => 1]);

        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
