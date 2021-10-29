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

        $booking = Booking::find(996);
//        return $booking;

        $arrivo = Carbon::createFromFormat('d-m-y', $booking->tx_mask_p_data_arrivo)->format('Y-m-d');

        $c_house = TypoCHouse::select('tx_mask_t4_govin_cin_base','tx_mask_t4_govin_cin_specializzato', 'tx_mask_t4_govin_cin_loco')
            ->join('tx_mask_c_cos_periodo', 'tx_mask_c_cos_periodo.parentid', '=', 'tt_content.uid')
            ->whereIn('tt_content.tx_mask_c_cod_feuser', [$booking->tx_mask_t1_op_chechin])
            ->where('tt_content.tx_mask_c_cod_casa', 'like', '%'. $booking->tx_mask_p_casa .'%')
            ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_from', '<=', $arrivo)
            ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_to', '>=', $arrivo)
            ->where('tt_content.deleted', '=', 0)
            ->first();
        return $c_house;

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
