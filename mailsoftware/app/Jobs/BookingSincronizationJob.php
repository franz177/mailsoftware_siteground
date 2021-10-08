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
            $store = Booking::firstOrNew(['uid' => $this->booking['uid']]);

            $store->hidden = $this->booking['hidden'];
            $store->deleted = $this->booking['deleted'];
            $store->header = $this->booking['header'];
            $store->subheader = $this->booking['subheader'];
            $store->tx_mask_cod_reservation_status = $this->booking['tx_mask_cod_reservation_status'];
            $store->tx_mask_contatto_riferimento = $this->booking['tx_mask_contatto_riferimento'];
            $store->tx_mask_doc_inviati = $this->booking['tx_mask_doc_inviati'];
            $store->tx_mask_p_casa = $this->booking['tx_mask_p_casa'];
            $store->tx_mask_p_culla = $this->booking['tx_mask_p_culla'];
            $store->tx_mask_p_data_arrivo = $this->booking['tx_mask_p_data_arrivo'];
            $store->tx_mask_p_data_partenza = $this->booking['tx_mask_p_data_partenza'];
            $store->tx_mask_p_data_prenotazione = $this->booking['tx_mask_p_data_prenotazione'];
            $store->tx_mask_p_note_noi = $this->booking['tx_mask_p_note_noi'];
            $store->tx_mask_p_old_uid = $this->booking['tx_mask_p_old_uid'];
            $store->tx_mask_p_override_perc = $this->booking['tx_mask_p_override_perc'];
            $store->tx_mask_p_perc_importo_fisso = $this->booking['tx_mask_p_perc_importo_fisso'];
            $store->tx_mask_p_perc_sito = $this->booking['tx_mask_p_perc_sito'];
            $store->tx_mask_p_sito = $this->booking['tx_mask_p_sito'];
            $store->tx_mask_p_token = $this->booking['tx_mask_p_token'];
            $store->tx_mask_p_tot_ospiti = $this->booking['tx_mask_p_tot_ospiti'];
            $store->tx_mask_p_under_12 = $this->booking['tx_mask_p_under_12'];
            $store->tx_mask_t0_cognome = $this->booking['tx_mask_t0_cognome'];
            $store->tx_mask_t0_country = $this->booking['tx_mask_t0_country'];
            $store->tx_mask_t0_email = $this->booking['tx_mask_t0_email'];
            $store->tx_mask_t0_fattura = $this->booking['tx_mask_t0_fattura'];
            $store->tx_mask_t0_lingua = $this->booking['tx_mask_t0_lingua'];
            $store->tx_mask_t0_newsletter = $this->booking['tx_mask_t0_newsletter'];
            $store->tx_mask_t0_sardegna = $this->booking['tx_mask_t0_sardegna'];
            $store->tx_mask_t0_tel = $this->booking['tx_mask_t0_tel'];
            $store->tx_mask_t1_op_cambio_biancheria = $this->booking['tx_mask_t1_op_cambio_biancheria'];
            $store->tx_mask_t1_op_chechin = $this->booking['tx_mask_t1_op_chechin'];
            $store->tx_mask_t1_op_checkout = $this->booking['tx_mask_t1_op_checkout'];
            $store->tx_mask_t1_op_manutentore = $this->booking['tx_mask_t1_op_manutentore'];
            $store->tx_mask_t1_op_note = $this->booking['tx_mask_t1_op_note'];
            $store->tx_mask_t1_op_pulizie = $this->booking['tx_mask_t1_op_pulizie'];
            $store->tx_mask_t1_op_tipo_checkin = $this->booking['tx_mask_t1_op_tipo_checkin'];
            $store->tx_mask_t1_ora_checkin = $this->booking['tx_mask_t1_ora_checkin'];
            $store->tx_mask_t1_ora_checkout = $this->booking['tx_mask_t1_ora_checkout'];
            $store->tx_mask_t1_ore_pulizie = $this->booking['tx_mask_t1_ore_pulizie'];
            $store->tx_mask_t2_p_bianc = $this->booking['tx_mask_t2_p_bianc'];
            $store->tx_mask_t2_p_c_extra_b = $this->booking['tx_mask_t2_p_c_extra_b'];
            $store->tx_mask_t2_p_c_extra_kit = $this->booking['tx_mask_t2_p_c_extra_kit'];
            $store->tx_mask_t2_p_cambi_a = $this->booking['tx_mask_t2_p_cambi_a'];
            $store->tx_mask_t2_p_cambi_aut = $this->booking['tx_mask_t2_p_cambi_aut'];
            $store->tx_mask_t2_p_cambi_l = $this->booking['tx_mask_t2_p_cambi_l'];
            $store->tx_mask_t2_p_metodo_b = $this->booking['tx_mask_t2_p_metodo_b'];
            $store->tx_mask_t3_p_cash_op_cout = $this->booking['tx_mask_t3_p_cash_op_cout'];
            $store->tx_mask_t3_p_cash_simo = $this->booking['tx_mask_t3_p_cash_simo'];
            $store->tx_mask_t3_p_check_acconto = $this->booking['tx_mask_t3_p_check_acconto'];
            $store->tx_mask_t3_p_city_tax_amount = $this->booking['tx_mask_t3_p_city_tax_amount'];
            $store->tx_mask_t3_p_cleaning_fee_amount = $this->booking['tx_mask_t3_p_cleaning_fee_amount'];
            $store->tx_mask_t3_p_cw = $this->booking['tx_mask_t3_p_cw'];
            $store->tx_mask_t3_p_cw_sconto = $this->booking['tx_mask_t3_p_cw_sconto'];
            $store->tx_mask_t3_p_extra_p = $this->booking['tx_mask_t3_p_extra_p'];
            $store->tx_mask_t3_p_note_cont = $this->booking['tx_mask_t3_p_note_cont'];
            $store->tx_mask_t3_p_s_b = $this->booking['tx_mask_t3_p_s_b'];
            $store->tx_mask_t3_p_s_checkout = $this->booking['tx_mask_t3_p_s_checkout'];
            $store->tx_mask_t3_p_s_chin = $this->booking['tx_mask_t3_p_s_chin'];
            $store->tx_mask_t3_p_s_ex_checkout = $this->booking['tx_mask_t3_p_s_ex_checkout'];
            $store->tx_mask_t3_p_s_extra_checkin = $this->booking['tx_mask_t3_p_s_extra_checkin'];
            $store->tx_mask_t3_p_saldo_ric_b = $this->booking['tx_mask_t3_p_saldo_ric_b'];
            $store->tx_mask_t3_p_stay = $this->booking['tx_mask_t3_p_stay'];
            $store->tx_mask_t4_azioni = $this->booking['tx_mask_t4_azioni'];
            $store->tx_mask_t4_test_email = $this->booking['tx_mask_t4_test_email'];
            $store->tx_mask_t5_kross_city_tax_amount = $this->booking['tx_mask_t5_kross_city_tax_amount'];
            $store->tx_mask_t5_kross_cleaning_fee_amount = $this->booking['tx_mask_t5_kross_cleaning_fee_amount'];
            $store->tx_mask_t5_kross_cod_channel = $this->booking['tx_mask_t5_kross_cod_channel'];
            $store->tx_mask_t5_kross_email = $this->booking['tx_mask_t5_kross_email'];
            $store->tx_mask_t5_kross_id = $this->booking['tx_mask_t5_kross_id'];
            $store->tx_mask_t5_kross_new = $this->booking['tx_mask_t5_kross_new'];
            $store->tx_mask_t5_kross_ota_commissions_collected = $this->booking['tx_mask_t5_kross_ota_commissions_collected'];
            $store->tx_mask_t5_kross_ota_id = $this->booking['tx_mask_t5_kross_ota_id'];
            $store->tx_mask_t5_kross_other_extra_total_amount = $this->booking['tx_mask_t5_kross_other_extra_total_amount'];
            $store->tx_mask_t5_kross_payment_total_amount = $this->booking['tx_mask_t5_kross_payment_total_amount'];
            $store->tx_mask_t6_assistenza_interventol_lastminute = $this->booking['tx_mask_t6_assistenza_interventol_lastminute'];
            $store->tx_mask_t6_intervento_lastminute = $this->booking['tx_mask_t6_intervento_lastminute'];
            $store->costo_orario = 0;
            $store->totale_pulizie = 0;
            $store->costo_co = 0;
            $store->mancia_cli = 0;
            $store->costi_costo_operatore_cambio_biancheria = 0;
            $store->costi_costo_kit = 0;

            $store->save();

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
