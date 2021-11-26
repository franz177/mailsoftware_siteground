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
//            ->where(Typo::raw('MONTH(FROM_UNIXTIME(tstamp))'), '=', $month)
//            ->orderBy('uid', 'desc')
//            ->get();
            ->where('uid', 996)
            ->first();

        $arrivo = Carbon::createFromFormat('d-m-Y', $bookings->tx_mask_p_data_arrivo)->format('Y-m-d');
        $partenza = Carbon::createFromFormat('d-m-Y', $bookings->tx_mask_p_data_partenza)->format('Y-m-d');

        $id_op_co = [
            $bookings['tx_mask_t1_op_chechin'] ? $bookings['tx_mask_t1_op_chechin'] : 19
        ];

        $id_house = $bookings['tx_mask_p_casa'];

        $user = TypoUser::where('uid',$id_op_co)->first();

        if($user->deleted != 1){
            $c_house = TypoCHouse::select('tt_content.uid', 'tt_content.header', 'tt_content.tx_mask_t4_govin_cin_base', 'tt_content.tx_mask_t4_govin_cin_specializzato',
                'tx_mask_t4_govin_cin_loco')
                ->join('tx_mask_c_cos_periodo', 'tx_mask_c_cos_periodo.parentid', '=', 'tt_content.uid')
//                ->where('tt_content.tx_mask_c_cod_feuser', 'like', '%'. $id_op_co .'%')
                ->whereIn('tt_content.tx_mask_c_cod_feuser', $id_op_co)
                ->where('tt_content.tx_mask_c_cod_casa', 'like', '%'. $id_house .'%')
                ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_from', '<=', $arrivo)
                ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_to', '>=', $partenza)
                ->where('tt_content.hidden', 0)
                ->where('tt_content.deleted', 0)
                ->first();

            if($c_house){
                switch ($bookings['tx_mask_t1_op_tipo_checkin']){
                    case 1:
                        $check_in = $c_house['tx_mask_t4_govin_cin_base'];
                        break;
                    case 2:
                        $check_in = $c_house['tx_mask_t4_govin_cin_specializzato'];
                        break;
                    case 3:
                        $check_in = $c_house['tx_mask_t4_govin_cin_loco'];
                        break;
                    default:
                        $check_in = 0;
                        break;
                }
            } else {
                $check_in = -1;
            }
        } else {
            $check_in = -99;
        }

        return $check_in;

        $booking = Booking::find(1421);



        return Booking::find(1421);

    }

    public function force()
    {
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
