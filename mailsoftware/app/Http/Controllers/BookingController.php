<?php

namespace App\Http\Controllers;

use App\Jobs\ArtisanQueueWorkJob;
use App\Jobs\BookingSincronizationJob;
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
        return $booking = Booking::find(1525);

        $user = TypoUser::where('uid',$booking->tx_mask_t1_op_pulizie)->first();

        $id_op_pulizie = [$booking->tx_mask_t1_op_pulizie];

        $data_format = Carbon::createFromFormat('d-m-Y', $booking->tx_mask_p_data_arrivo)->format('Y-m-d');

        if($user->deleted != 1){
            $c_house = TypoCHouse::select([TypoCHouse::raw('IFNULL(tx_mask_c_cod_costo_orario_operatore, 19) costo_orario_operatore'), 'tt_content.tx_mask_t7_pulizie_metodo', 'tt_content.tx_mask_t3_govout_c_cout', 'tt_content.tx_mask_t3_govout_ritiro_immondizia', 'tt_content.tx_mask_t3_govout_ritiro_soldi',
                'tt_content.tx_mask_t2_lav_c_cambio_b_cout', 'tt_content.tx_mask_t2_lav_prep_kit_cliente', 'tt_content.tx_mask_t2_lav_costo_dotazione_casa', 'tt_content.tx_mask_t2_lav_prep_kit_dotazione_casa',
                'tt_content.tx_mask_t7_cert_covid', 'tt_content.tx_mask_t7_costo_prod_pul', 'tt_content.tx_mask_t7_pul_stracci', 'tt_content.tx_mask_t5_supervisor_c_fornitura_kit_serv', 'tt_content.tx_mask_t7_fisso_pul'])
                ->join('tx_mask_c_cos_periodo', 'tx_mask_c_cos_periodo.parentid', '=', 'tt_content.uid')
                ->whereIn('tt_content.tx_mask_c_cod_feuser', $id_op_pulizie)
                ->where('tt_content.tx_mask_c_cod_casa', 'like', '%'. $booking->tx_mask_p_casa .'%')
                ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_from', '<=', $data_format)
                ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_to', '>=', $data_format)
                ->where('tt_content.deleted', '=', 0)
                ->first();

            if($c_house){
                $sum = $c_house->tx_mask_t3_govout_c_cout + $c_house->tx_mask_t3_govout_ritiro_immondizia + $c_house->tx_mask_t3_govout_ritiro_soldi + $c_house->tx_mask_t2_lav_c_cambio_b_cout + $c_house->tx_mask_t2_lav_prep_kit_cliente + $c_house->tx_mask_t2_lav_costo_dotazione_casa + $c_house->tx_mask_t2_lav_prep_kit_dotazione_casa;
                $sum_pulizie = $c_house->tx_mask_t7_cert_covid + $c_house->tx_mask_t7_costo_prod_pul + $c_house->tx_mask_t7_pul_stracci + $c_house->tx_mask_t5_supervisor_c_fornitura_kit_serv + $c_house->tx_mask_t7_fisso_pul;

                if ($booking->tx_mask_t1_ore_pulizie > 0){
                    $total = ($this->attributes['tx_mask_t1_ore_pulizie'] * $c_house->costo_orario_operatore);

                    $check_co = Typo::select('uid')
                        ->where('tt_content.CType', 'mask_db_alg_pren')
                        ->where('tt_content.hidden', '=', 0)
                        ->where('tt_content.deleted', '=', 0)
                        ->where('tt_content.tx_mask_p_casa', $booking->tx_mask_p_casa)
                        ->where('tt_content.tx_mask_p_data_partenza', $data_format)
                        ->where('tt_content.tx_mask_t1_op_checkout', $booking->tx_mask_t1_op_pulizie)
                        ->first();

                    if($check_co) {
                        $total = $total - $sum;
                    }
                    echo $total;
                } else {
                    switch ($c_house->tx_mask_t7_pulizie_metodo){
                        case 1: // RANGE
                            $id_house = $booking->tx_mask_p_casa;
                            $range = TypoRange::select('uid', 'header', 'tx_mask_r_casa', 'tx_mask_r_dal', 'tx_mask_r_al', 'tx_mask_r_mm')
                                ->where('tx_mask_r_casa', 'like', '%'. $id_house .'%')
                                ->where('hidden', 0)
                                ->where('deleted', 0)
                                ->first();

                            $range_mm = TypoRangeMM::select('tx_mask_r_mm_min', 'tx_mask_r_mm_max','tx_mask_r_mm_importo')
                                ->where('parentid', $range['uid'])
                                ->where('tx_mask_r_mm_max','>=', $booking->tx_mask_t3_p_stay)
                                ->first();
                            echo $range_mm['tx_mask_r_mm_importo'];
                            break;
                        case 2: // IMPORTO FISSO
                            if($sum_pulizie == 0)
                                return 0;

                            echo $sum_pulizie;
                            break;
                        default:
                            echo 0;
                            break;
                    }
                }
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function force()
    {
        $bookings = Typo::where('CType','mask_db_alg_pren')
            ->where('hidden', 0)
            ->where('deleted', 0)
            ->orderBy('uid', 'desc')
            ->get();

        $bookings->each(function($booking) {
            BookingSincronizationJob::dispatch($booking);
        });

        ArtisanQueueWorkJob::dispatch();

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
