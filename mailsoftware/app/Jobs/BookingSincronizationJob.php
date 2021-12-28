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
        $bookings = Typo::where('CType','mask_db_alg_pren')
            ->where('hidden', 0)
            ->where('deleted', 0)
//            ->whereIn(Typo::raw('MONTH(FROM_UNIXTIME(tstamp))'), $months)
//            ->where(Typo::raw('YEAR(FROM_UNIXTIME(tstamp))'), '=', $year)
            ->whereNotNull('tx_mask_p_casa')
            ->whereIn('uid', [1386])
            ->where('tx_mask_cod_reservation_status', '!=', 'CANC')
            ->where(Typo::raw('YEAR(tx_mask_p_data_arrivo)'), '>=', 2020)
            ->orderBy('uid', 'desc')
            ->get();

        if($bookings){
            $bookings->each(function ($booking) {
                try {
                    $store = Booking::updateOrCreate(
                        ['uid' => $booking['uid']],
                        [
                            'hidden' => $booking['hidden'], 'deleted' => $booking['deleted'],
                            'header' => $booking['header'], 'subheader' => $booking['subheader'],
                            'tx_mask_cod_reservation_status' => $booking['tx_mask_cod_reservation_status'], 'tx_mask_contatto_riferimento' => $booking['tx_mask_contatto_riferimento'],
                            'tx_mask_doc_inviati' => $booking['tx_mask_doc_inviati'], 'tx_mask_p_casa' => $booking['tx_mask_p_casa'],
                            'tx_mask_p_culla' => $booking['tx_mask_p_culla'], 'tx_mask_p_data_arrivo' => $booking['tx_mask_p_data_arrivo'],
                            'tx_mask_p_data_partenza' => $booking['tx_mask_p_data_partenza'], 'tx_mask_p_data_prenotazione' => $booking['tx_mask_p_data_prenotazione'],
                            'tx_mask_p_note_noi' => $booking['tx_mask_p_note_noi'], 'tx_mask_p_old_uid' => $booking['tx_mask_p_old_uid'],
                            'tx_mask_p_override_perc' => $booking['tx_mask_p_override_perc'], 'tx_mask_p_perc_importo_fisso' => $booking['tx_mask_p_perc_importo_fisso'],
                            'tx_mask_p_perc_sito' => $booking['tx_mask_p_perc_sito'], 'tx_mask_p_sito' => $booking['tx_mask_p_sito'],
                            'tx_mask_p_token' => $booking['tx_mask_p_token'], 'tx_mask_p_tot_ospiti' => $booking['tx_mask_p_tot_ospiti'],
                            'tx_mask_p_under_12' => $booking['tx_mask_p_under_12'], 'tx_mask_t0_cognome' => $booking['tx_mask_t0_cognome'],
                            'tx_mask_t0_country' => $booking['tx_mask_t0_country'], 'tx_mask_t0_email' => $booking['tx_mask_t0_email'],
                            'tx_mask_t0_fattura' => $booking['tx_mask_t0_fattura'], 'tx_mask_t0_lingua' => $booking['tx_mask_t0_lingua'],
                            'tx_mask_t0_newsletter' => $booking['tx_mask_t0_newsletter'], 'tx_mask_t0_sardegna' => $booking['tx_mask_t0_sardegna'],
                            'tx_mask_t0_tel' => $booking['tx_mask_t0_tel'], 'tx_mask_t1_op_cambio_biancheria' => $booking['tx_mask_t1_op_cambio_biancheria'],
                            'tx_mask_t1_op_chechin' => $booking['tx_mask_t1_op_chechin'], 'tx_mask_t1_op_checkout' => $booking['tx_mask_t1_op_checkout'],
                            'tx_mask_t1_op_manutentore' => $booking['tx_mask_t1_op_manutentore'], 'tx_mask_t1_op_note' => $booking['tx_mask_t1_op_note'],
                            'tx_mask_t1_op_pulizie' => $booking['tx_mask_t1_op_pulizie'], 'tx_mask_t1_op_tipo_checkin' => $booking['tx_mask_t1_op_tipo_checkin'],
                            'tx_mask_t1_op_costo_extra_cambio_biancheria' => $booking['tx_mask_t1_op_costo_extra_cambio_biancheria'],
                            'tx_mask_t1_ora_checkin' => $booking['tx_mask_t1_ora_checkin'], 'tx_mask_t1_ora_checkout' => $booking['tx_mask_t1_ora_checkout'],
                            'tx_mask_t1_ore_pulizie' => $booking['tx_mask_t1_ore_pulizie'],
                            'tx_mask_t2_p_bianc' => $booking['tx_mask_t2_p_bianc'], 'tx_mask_t2_p_c_extra_b' => $booking['tx_mask_t2_p_c_extra_b'],
                            'tx_mask_t2_p_c_extra_kit' => $booking['tx_mask_t2_p_c_extra_kit'], 'tx_mask_t2_p_cambi_a' => $booking['tx_mask_t2_p_cambi_a'],
                            'tx_mask_t2_p_cambi_aut' => $booking['tx_mask_t2_p_cambi_aut'], 'tx_mask_t2_p_cambi_l' => $booking['tx_mask_t2_p_cambi_l'],
                            'tx_mask_t2_p_metodo_b' => $booking['tx_mask_t2_p_metodo_b'], 'tx_mask_t3_p_cash_op_cout' => $booking['tx_mask_t3_p_cash_op_cout'],
                            'tx_mask_t3_p_cash_simo' => $booking['tx_mask_t3_p_cash_simo'], 'tx_mask_t3_p_check_acconto' => $booking['tx_mask_t3_p_check_acconto'],
                            'tx_mask_t3_p_city_tax_amount' => $booking['tx_mask_t3_p_city_tax_amount'], 'tx_mask_t3_p_cleaning_fee_amount' => $booking['tx_mask_t3_p_cleaning_fee_amount'],
                            'tx_mask_t3_p_cw' => $booking['tx_mask_t3_p_cw'], 'tx_mask_t3_p_cw_sconto' => $booking['tx_mask_t3_p_cw_sconto'],
                            'tx_mask_t3_p_extra_p' => $booking['tx_mask_t3_p_extra_p'], 'tx_mask_t3_p_note_cont' => $booking['tx_mask_t3_p_note_cont'],
                            'tx_mask_t3_p_s_b' => $booking['tx_mask_t3_p_s_b'], 'tx_mask_t3_p_s_checkout' => $booking['tx_mask_t3_p_s_checkout'],
                            'tx_mask_t3_p_s_chin' => $booking['tx_mask_t3_p_s_chin'], 'tx_mask_t3_p_s_ex_checkout' => $booking['tx_mask_t3_p_s_ex_checkout'],
                            'tx_mask_t3_p_s_extra_checkin' => $booking['tx_mask_t3_p_s_extra_checkin'], 'tx_mask_t3_p_saldo_ric_b' => $booking['tx_mask_t3_p_saldo_ric_b'],
                            'tx_mask_t3_p_stay' => $booking['tx_mask_t3_p_stay'], 'tx_mask_t4_azioni' => $booking['tx_mask_t4_azioni'],
                            'tx_mask_t4_test_email' => $booking['tx_mask_t4_test_email'], 'tx_mask_t5_kross_city_tax_amount' => $booking['tx_mask_t5_kross_city_tax_amount'],
                            'tx_mask_t5_kross_cleaning_fee_amount' => $booking['tx_mask_t5_kross_cleaning_fee_amount'], 'tx_mask_t5_kross_cod_channel' => $booking['tx_mask_t5_kross_cod_channel'],
                            'tx_mask_t5_kross_email' => $booking['tx_mask_t5_kross_email'], 'tx_mask_t5_kross_id' => $booking['tx_mask_t5_kross_id'],
                            'tx_mask_t5_kross_new' => $booking['tx_mask_t5_kross_new'], 'tx_mask_t5_kross_ota_commissions_collected' => $booking['tx_mask_t5_kross_ota_commissions_collected'],
                            'tx_mask_t5_kross_ota_id' => $booking['tx_mask_t5_kross_ota_id'], 'tx_mask_t5_kross_other_extra_total_amount' => $booking['tx_mask_t5_kross_other_extra_total_amount'],
                            'tx_mask_t5_kross_payment_total_amount' => $booking['tx_mask_t5_kross_payment_total_amount'], 'tx_mask_t6_assistenza_interventol_lastminute' => $booking['tx_mask_t6_assistenza_interventol_lastminute'],
                            'tx_mask_t6_intervento_lastminute' => $booking['tx_mask_t6_intervento_lastminute'],
                            'costo_orario' => 0,
                            'totale_pulizie' => 0,
                            'costo_co' => 0,
                            'mancia_cli' => 0,
                            'prev_di_cui_pulizie_cliente' => 0,
                            'prev_tot_extra_cash_co' => 0,
                            'prev_di_cui_biancheria_extra_a_pagamento' => 0,
                            'prev_incasso_preventivo_con_extra' => 0,

                            'costi_check_in_self_check_in' => 99,
                            'costi_spese_extra_operatore_check_in' => $booking['tx_mask_t3_p_s_extra_checkin'],
                            'costi_totale_costo_check_in' => 0,
                            'costi_costo_check_out' => 0,
                            'costi_totale_costo_check_out' => 0,
                            'costi_costo_pulizie' => 0,
                            'costi_totale_costo_pulizie' => 0,
                            'costi_costo_operatore_cambio_biancheria' => 0,
                            'costi_costo_kit' => 0,
                            'costi_costo_cambi' => 0,
                            'costi_costo_biancheria_extra_a_pagamento' => 0,
                            'costi_totale_costo_per_cambio_biancheria_costo_lavanderia' => 1,
                            'costi_totale_costi' => 0,

                            'cons_di_cui_incassi_banca' => 0,
                            'cons_tot_ingresso_banca' => 0,
                            'cons_totale_extra_cash_ritirato_al_co' => 0,
                            'cons_tassa_soggiorno_da_ritirare' => 0,
                            'cons_incasso_consuntivo_totale_con_extra_no_siti_web' => 0,
                            'cons_diff_cons_prev' => 0,
                            'cons_incasso_consuntivo_totale_con_extra_siti_web' => 0,
                            'cons_totale_costi' => 0,
                            'cons_guadagno' => 0,

                            'prop_percentuale_proprietario' => 0,
                            'prop_percentuale_simonetta' => 0,
//                            'prop_costo_medio_a_notte' => 0,
                        ]);

//                    if ($store->wasRecentlyCreated === true) {
//                        $message = 'Created';
//                    } else {
//                        $message = 'Updated';
//                    }

//                    event(new BookingEvent($store, $message, $booking->uid));

                } catch (\Exception $e) {
                    event(new BookingErrorEvent('Insert Failed', $booking->uid, $e->getMessage()));
                }

            });
        }
    }
}
