<?php

namespace App\Jobs;

use App\Event\Booking\BookingErrorEvent;
use App\Event\Booking\BookingEvent;
use App\Models\Booking;
use App\Models\Typo;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BookingSincronizationJob implements ShouldQueue
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
            'tx_mask_t5_kross_ota_commissions_collected', 'tx_mask_t5_kross_ota_id', 'tx_mask_t5_kross_other_extra_total_amount', 'tx_mask_t5_kross_payments', 'tx_mask_t5_kross_payment_total_amount', 'tx_mask_t6_assistenza_interventol_lastminute',
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
            ->get();

        if($bookings){
            foreach ($bookings->chunk(20) as $chunk) {
                BookingInsertUpdateJob::dispatch($chunk);
            }
        }
    }
}
