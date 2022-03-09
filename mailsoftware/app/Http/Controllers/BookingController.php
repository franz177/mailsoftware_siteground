<?php

namespace App\Http\Controllers;

use App\Exports\BookingsExport;
use App\Jobs\BookingSincronizationJob;
use App\Models\Booking;
use App\Models\Typo;
use App\Models\TypoCategories;
use App\Models\TypoExtra;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;

class BookingController extends Controller
{
    private $row = array();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking = Typo::where('CType','mask_db_alg_pren')
            ->where('hidden', 0)
            ->where('deleted', 0)
//            ->whereIn(Typo::raw('MONTH(FROM_UNIXTIME(tstamp))'), $months)
//            ->where(Typo::raw('YEAR(FROM_UNIXTIME(tstamp))'), '=', $year)
            ->whereNotNull('tx_mask_p_casa')
            ->whereIn('uid', [1386])
            ->where('tx_mask_cod_reservation_status', '!=', 'CANC')
            ->where(Typo::raw('YEAR(tx_mask_p_data_arrivo)'), '>=', 2020)
            ->orderBy('uid', 'desc')
            ->first();


        $arrivo = Carbon::parse($booking->tx_mask_p_data_arrivo);
        $partenza = Carbon::parse($booking->tx_mask_p_data_partenza);

        $guest = intval($booking->tx_mask_p_tot_ospiti);
        $nights = $partenza->diffInDays($arrivo);

        $extra_by_guest = 'tx_mask_t12_extra'.$guest;

        $extra = TypoExtra::select('parentid', 'tx_mask_t5_metodo_dal', 'tx_mask_t5_metodo_al', $extra_by_guest)
            ->where('parentid', $booking->tx_mask_p_casa)
            ->where('tx_mask_t5_metodo_dal', '<=', Carbon::createFromFormat('d-m-Y', $booking->tx_mask_p_data_arrivo)->format('Y-m-d'))
            ->where('tx_mask_t5_metodo_al', '>=', Carbon::createFromFormat('d-m-Y', $booking->tx_mask_p_data_arrivo)->format('Y-m-d'))
            ->where('hidden', 0)
            ->where('deleted', 0)
            ->first();

        if($booking['tx_mask_t3_p_cleaning_fee_amount'] > 0){
            $cleaning_fee_amount = $booking['tx_mask_t3_p_cleaning_fee_amount'];
        }
        $cleaning_fee_amount = $booking['tx_mask_t5_kross_cleaning_fee_amount'];

//        return (($booking['tx_mask_t3_p_stay'] - $cleaning_fee_amount) - ($extra->$extra_by_guest * $nights)) / $nights;

        $month = now()->month;
        $month_before = $month - 1;
        $months = [
            $month_before,
            $month
        ];
        $year = now()->year;

        $bookings = Typo::select('uid', 'header', 'subheader', 'tx_mask_cod_reservation_status', 'tx_mask_contatto_riferimento',
            'tx_mask_doc_inviati', 'tx_mask_p_casa', 'tx_mask_p_culla', 'tx_mask_p_data_arrivo', 'tx_mask_p_data_partenza',
            'tx_mask_p_data_prenotazione', 'tx_mask_p_note_noi', 'tx_mask_p_old_uid', 'tx_mask_p_override_perc', 'tx_mask_p_perc_importo_fisso',
            'tx_mask_p_perc_sito', 'tx_mask_p_sito', 'tx_mask_p_token', 'tx_mask_p_tot_ospiti', 'tx_mask_p_under_12',
            'tx_mask_t0_cognome', 'tx_mask_t0_country', 'tx_mask_t0_email', 'tx_mask_t0_fattura', 'tx_mask_t0_lingua',
            'tx_mask_t0_newsletter', 'tx_mask_t0_sardegna', 'tx_mask_t0_tel', 'tx_mask_t1_op_cambio_biancheria', 'tx_mask_t1_op_chechin',
            'tx_mask_t1_op_checkout', 'tx_mask_t1_op_manutentore', 'tx_mask_t1_op_note', 'tx_mask_t1_op_pulizie', 'tx_mask_t1_op_tipo_checkin',
            'tx_mask_t1_op_costo_extra_cambio_biancheria', 'tx_mask_t1_ora_checkin', 'tx_mask_t1_ora_checkout', 'tx_mask_t1_ore_pulizie', 'tx_mask_t2_p_bianc',
            'tx_mask_t2_p_c_extra_b', 'tx_mask_t2_p_c_extra_kit', 'tx_mask_t2_p_cambi_a', 'tx_mask_t2_p_cambi_aut', 'tx_mask_t2_p_cambi_l',
            'tx_mask_t2_p_metodo_b', 'tx_mask_t3_p_cash_op_cout', 'tx_mask_t3_p_cash_simo', 'tx_mask_t3_p_check_acconto', 'tx_mask_t3_p_city_tax_amount',
            'tx_mask_t3_p_cleaning_fee_amount', 'tx_mask_t3_p_cw', 'tx_mask_t3_p_cw_sconto', 'tx_mask_t3_p_extra_p', 'tx_mask_t3_p_note_cont',
            'tx_mask_t3_p_s_b', 'tx_mask_t3_p_s_checkout', 'tx_mask_t3_p_s_chin', 'tx_mask_t3_p_s_ex_checkout', 'tx_mask_t3_p_s_extra_checkin',
            'tx_mask_t3_p_saldo_ric_b', 'tx_mask_t3_p_stay', 'tx_mask_t4_azioni', 'tx_mask_t4_test_email', 'tx_mask_t5_kross_city_tax_amount',
            'tx_mask_t5_kross_cleaning_fee_amount', 'tx_mask_t5_kross_cod_channel', 'tx_mask_t5_kross_email', 'tx_mask_t5_kross_id', 'tx_mask_t5_kross_new',
            'tx_mask_t5_kross_ota_commissions_collected', 'tx_mask_t5_kross_ota_id', 'tx_mask_t5_kross_other_extra_total_amount', 'tx_mask_t5_kross_payment_total_amount', 'tx_mask_t6_assistenza_interventol_lastminute',
            'tx_mask_t6_intervento_lastminute')
            ->where('CType','mask_db_alg_pren')
            ->where('hidden', 0)
            ->where('deleted', 0)
            ->whereIn(Typo::raw('MONTH(FROM_UNIXTIME(tstamp))'), $months)
            ->where(Typo::raw('YEAR(FROM_UNIXTIME(tstamp))'), '=', $year)
            ->whereNotNull('tx_mask_p_casa')
//            ->whereIn('uid', [1386])
//            ->whereNotIn('uid', [2319,1421,195,1505])
            ->where('tx_mask_cod_reservation_status', '!=', 'CANC')
            ->where(Typo::raw('YEAR(tx_mask_p_data_arrivo)'), '>=', 2020)
            ->orderBy('uid', 'desc')
            ->limit(143)
            ->get();

//        $bookings = $bookings->pluck('uid');

        $bookings = $bookings->chunk(100);

        dd($bookings);

    }

    public function force()
    {
        BookingSincronizationJob::dispatch();

        Artisan::call('queue:work',['--stop-when-empty' => 1]);

        return back();
    }

    public function bookingsExport()
    {
        $booking_export = new BookingsExport();
        $booking_export->setFileName(now());
        return  $booking_export;
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
