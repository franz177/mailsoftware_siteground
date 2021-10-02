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

    private $booking;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


//        $bookings->chunk(200);

//        $bookings = Typo::where('uid',1525)->get();

//        $bookings->each(function ($booking) {
        try {
            $store = Booking::updateOrCreate(
                ['uid' => $this->booking['uid']],
                [
                    'hidden' => $this->booking['hidden'],
                    'deleted' => $this->booking['deleted'],
                    'header' => $this->booking['header'],
                    'subheader' => $this->booking['subheader'],
                    'tx_mask_cod_reservation_status' => $this->booking['tx_mask_cod_reservation_status'],
                    'tx_mask_contatto_riferimento' => $this->booking['tx_mask_contatto_riferimento'],
                    'tx_mask_doc_inviati' => $this->booking['tx_mask_doc_inviati'],
                    'tx_mask_p_casa' => $this->booking['tx_mask_p_casa'],
                    'tx_mask_p_culla' => $this->booking['tx_mask_p_culla'],
                    'tx_mask_p_data_arrivo' => $this->booking['tx_mask_p_data_arrivo'],
                    'tx_mask_p_data_partenza' => $this->booking['tx_mask_p_data_partenza'],
                    'tx_mask_p_data_prenotazione' => $this->booking['tx_mask_p_data_prenotazione'],
                    'tx_mask_p_note_noi' => $this->booking['tx_mask_p_note_noi'],
                    'tx_mask_p_old_uid' => $this->booking['tx_mask_p_old_uid'],
                    'tx_mask_p_override_perc' => $this->booking['tx_mask_p_override_perc'],
                    'tx_mask_p_perc_importo_fisso' => $this->booking['tx_mask_p_perc_importo_fisso'],
                    'tx_mask_p_perc_sito' => $this->booking['tx_mask_p_perc_sito'],
                    'tx_mask_p_sito' => $this->booking['tx_mask_p_sito'],
                    'tx_mask_p_token' => $this->booking['tx_mask_p_token'],
                    'tx_mask_p_tot_ospiti' => $this->booking['tx_mask_p_tot_ospiti'],
                    'tx_mask_p_under_12' => $this->booking['tx_mask_p_under_12'],
                    'tx_mask_t0_cognome' => $this->booking['tx_mask_t0_cognome'],
                    'tx_mask_t0_country' => $this->booking['tx_mask_t0_country'],
                    'tx_mask_t0_email' => $this->booking['tx_mask_t0_email'],
                    'tx_mask_t0_fattura' => $this->booking['tx_mask_t0_fattura'],
                    'tx_mask_t0_lingua' => $this->booking['tx_mask_t0_lingua'],
                    'tx_mask_t0_newsletter' => $this->booking['tx_mask_t0_newsletter'],
                    'tx_mask_t0_sardegna' => $this->booking['tx_mask_t0_sardegna'],
                    'tx_mask_t0_tel' => $this->booking['tx_mask_t0_tel'],
                    'tx_mask_t1_op_cambio_biancheria' => $this->booking['tx_mask_t1_op_cambio_biancheria'],
                    'tx_mask_t1_op_chechin' => $this->booking['tx_mask_t1_op_chechin'],
                    'tx_mask_t1_op_checkout' => $this->booking['tx_mask_t1_op_checkout'],
                    'tx_mask_t1_op_manutentore' => $this->booking['tx_mask_t1_op_manutentore'],
                    'tx_mask_t1_op_note' => $this->booking['tx_mask_t1_op_note'],
                    'tx_mask_t1_op_pulizie' => $this->booking['tx_mask_t1_op_pulizie'],
                    'tx_mask_t1_op_tipo_checkin' => $this->booking['tx_mask_t1_op_tipo_checkin'],
                    'tx_mask_t1_ora_checkin' => $this->booking['tx_mask_t1_ora_checkin'],
                    'tx_mask_t1_ora_checkout' => $this->booking['tx_mask_t1_ora_checkout'],
                    'tx_mask_t1_ore_pulizie' => $this->booking['tx_mask_t1_ore_pulizie'],
                    'tx_mask_t2_p_bianc' => $this->booking['tx_mask_t2_p_bianc'],
                    'tx_mask_t2_p_c_extra_b' => $this->booking['tx_mask_t2_p_c_extra_b'],
                    'tx_mask_t2_p_c_extra_kit' => $this->booking['tx_mask_t2_p_c_extra_kit'],
                    'tx_mask_t2_p_cambi_a' => $this->booking['tx_mask_t2_p_cambi_a'],
                    'tx_mask_t2_p_cambi_aut' => $this->booking['tx_mask_t2_p_cambi_aut'],
                    'tx_mask_t2_p_cambi_l' => $this->booking['tx_mask_t2_p_cambi_l'],
                    'tx_mask_t2_p_metodo_b' => $this->booking['tx_mask_t2_p_metodo_b'],
                    'tx_mask_t3_p_cash_op_cout' => $this->booking['tx_mask_t3_p_cash_op_cout'],
                    'tx_mask_t3_p_cash_simo' => $this->booking['tx_mask_t3_p_cash_simo'],
                    'tx_mask_t3_p_check_acconto' => $this->booking['tx_mask_t3_p_check_acconto'],
                    'tx_mask_t3_p_city_tax_amount' => $this->booking['tx_mask_t3_p_city_tax_amount'],
                    'tx_mask_t3_p_cleaning_fee_amount' => $this->booking['tx_mask_t3_p_cleaning_fee_amount'],
                    'tx_mask_t3_p_cw' => $this->booking['tx_mask_t3_p_cw'],
                    'tx_mask_t3_p_cw_sconto' => $this->booking['tx_mask_t3_p_cw_sconto'],
                    'tx_mask_t3_p_extra_p' => $this->booking['tx_mask_t3_p_extra_p'],
                    'tx_mask_t3_p_note_cont' => $this->booking['tx_mask_t3_p_note_cont'],
                    'tx_mask_t3_p_s_b' => $this->booking['tx_mask_t3_p_s_b'],
                    'tx_mask_t3_p_s_checkout' => $this->booking['tx_mask_t3_p_s_checkout'],
                    'tx_mask_t3_p_s_chin' => $this->booking['tx_mask_t3_p_s_chin'],
                    'tx_mask_t3_p_s_ex_checkout' => $this->booking['tx_mask_t3_p_s_ex_checkout'],
                    'tx_mask_t3_p_s_extra_checkin' => $this->booking['tx_mask_t3_p_s_extra_checkin'],
                    'tx_mask_t3_p_saldo_ric_b' => $this->booking['tx_mask_t3_p_saldo_ric_b'],
                    'tx_mask_t3_p_stay' => $this->booking['tx_mask_t3_p_stay'],
                    'tx_mask_t4_azioni' => $this->booking['tx_mask_t4_azioni'],
                    'tx_mask_t4_test_email' => $this->booking['tx_mask_t4_test_email'],
                    'tx_mask_t5_kross_city_tax_amount' => $this->booking['tx_mask_t5_kross_city_tax_amount'],
                    'tx_mask_t5_kross_cleaning_fee_amount' => $this->booking['tx_mask_t5_kross_cleaning_fee_amount'],
                    'tx_mask_t5_kross_cod_channel' => $this->booking['tx_mask_t5_kross_cod_channel'],
                    'tx_mask_t5_kross_email' => $this->booking['tx_mask_t5_kross_email'],
                    'tx_mask_t5_kross_id' => $this->booking['tx_mask_t5_kross_id'],
                    'tx_mask_t5_kross_new' => $this->booking['tx_mask_t5_kross_new'],
                    'tx_mask_t5_kross_ota_commissions_collected' => $this->booking['tx_mask_t5_kross_ota_commissions_collected'],
                    'tx_mask_t5_kross_ota_id' => $this->booking['tx_mask_t5_kross_ota_id'],
                    'tx_mask_t5_kross_other_extra_total_amount' => $this->booking['tx_mask_t5_kross_other_extra_total_amount'],
                    'tx_mask_t5_kross_payment_total_amount' => $this->booking['tx_mask_t5_kross_payment_total_amount'],
                    'tx_mask_t6_assistenza_interventol_lastminute' => $this->booking['tx_mask_t6_assistenza_interventol_lastminute'],
                    'tx_mask_t6_intervento_lastminute' => $this->booking['tx_mask_t6_intervento_lastminute'],
                    'costo_orario' => 0,
                    'totale_pulizie' => 0,
                    'costo_co' => 0,
                    'mancia_cli' => 0,
                    'costi_costo_operatore_cambio_biancheria' => 0,
                    'costi_costo_kit' => 0,
                ]);

            if ($store->wasRecentlyCreated === true) {
                $message = 'Created';
            } else {
                $message = 'Updated';
            }

//            event(new BookingEvent($store, $message, $this->booking->uid));

        } catch (\Exception $e) {
            event(new BookingErrorEvent('Insert Failed', $this->booking->uid, $e->getMessage()));
        }
//        });

    }
}
