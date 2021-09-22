<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->unsignedInteger('uid')->unique();
            $table->string('header', 255)->default('');
            $table->string('subheader', 255)->default('');
            $table->string('tx_mask_cod_reservation_status')->nullable();
            $table->string('tx_mask_contatto_riferimento')->nullable();
            $table->integer('tx_mask_doc_inviati')->default(0);
            $table->string('tx_mask_p_casa')->nullable();
            $table->string('tx_mask_p_culla')->nullable();
            $table->date('tx_mask_p_data_arrivo')->default(null);
            $table->date('tx_mask_p_data_partenza')->default(null);
            $table->date('tx_mask_p_data_prenotazione')->default(null);
            $table->string('tx_mask_p_note_noi')->nullable();
            $table->string('tx_mask_p_old_uid')->nullable();
            $table->integer('tx_mask_p_override_perc')->default(0);
            $table->double('tx_mask_p_perc_importo_fisso', 10, 2)->default(0);
            $table->double('tx_mask_p_perc_sito', 10, 2)->default(0);
            $table->string('tx_mask_p_sito')->nullable();
            $table->string('tx_mask_p_token')->nullable();
            $table->string('tx_mask_p_tot_ospiti')->nullable();
            $table->string('tx_mask_p_under_12')->nullable();
            $table->string('tx_mask_t0_cognome')->nullable();
            $table->string('tx_mask_t0_country')->nullable();
            $table->string('tx_mask_t0_email')->nullable();
            $table->string('tx_mask_t0_fattura')->nullable();
            $table->string('tx_mask_t0_lingua')->nullable();
            $table->integer('tx_mask_t0_newsletter')->default(0);
            $table->integer('tx_mask_t0_sardegna')->default(0);
            $table->string('tx_mask_t0_tel')->nullable();
            $table->string('tx_mask_t1_op_cambio_biancheria')->nullable();
            $table->string('tx_mask_t1_op_chechin')->nullable();
            $table->string('tx_mask_t1_op_checkout')->nullable();
            $table->string('tx_mask_t1_op_manutentore')->nullable();
            $table->string('tx_mask_t1_op_note')->nullable();
            $table->string('tx_mask_t1_op_pulizie')->nullable();
            $table->string('tx_mask_t1_op_tipo_checkin')->nullable();
            $table->string('tx_mask_t1_ora_checkin')->nullable();
            $table->string('tx_mask_t1_ora_checkout')->nullable();
            $table->double('tx_mask_t1_ore_pulizie', 10, 2)->default(0);
            $table->string('tx_mask_t2_p_bianc')->nullable();
            $table->double('tx_mask_t2_p_c_extra_b', 10, 2)->default(0);
            $table->double('tx_mask_t2_p_c_extra_kit', 10, 2)->default(0);
            $table->double('tx_mask_t2_p_cambi_a', 10, 2)->default(0);
            $table->integer('tx_mask_t2_p_cambi_aut')->default(0);
            $table->double('tx_mask_t2_p_cambi_l', 10, 2)->default(0);
            $table->string('tx_mask_t2_p_metodo_b')->nullable();
            $table->double('tx_mask_t3_p_cash_op_cout', 10, 2)->default(0);
            $table->double('tx_mask_t3_p_cash_simo', 10, 2)->default(0);
            $table->string('tx_mask_t3_p_check_acconto')->nullable();
            $table->double('tx_mask_t3_p_city_tax_amount', 10, 2)->default(0);
            $table->double('tx_mask_t3_p_cleaning_fee_amount', 10, 2)->default(0);
            $table->integer('tx_mask_t3_p_cw')->default(0);
            $table->double('tx_mask_t3_p_cw_sconto', 10, 2)->default(0);
            $table->double('tx_mask_t3_p_extra_p', 10, 2)->default(0);
            $table->string('tx_mask_t3_p_note_cont')->nullable();
            $table->double('tx_mask_t3_p_s_b', 10, 2)->default(0);
            $table->double('tx_mask_t3_p_s_checkout', 10, 2)->default(0);
            $table->double('tx_mask_t3_p_s_chin', 10, 2)->default(0);
            $table->double('tx_mask_t3_p_s_ex_checkout', 10, 2)->default(0);
            $table->double('tx_mask_t3_p_s_extra_checkin', 10, 2)->default(0);
            $table->double('tx_mask_t3_p_saldo_ric_b', 10, 2)->default(0);
            $table->double('tx_mask_t3_p_stay', 10, 2)->default(0);
            $table->string('tx_mask_t4_azioni')->nullable();
            $table->string('tx_mask_t4_test_email')->nullable();
            $table->double('tx_mask_t5_kross_city_tax_amount', 10, 2)->default(0);
            $table->double('tx_mask_t5_kross_cleaning_fee_amount', 10, 2)->default(0);
            $table->string('tx_mask_t5_kross_cod_channel')->nullable();
            $table->string('tx_mask_t5_kross_email')->nullable();
            $table->string('tx_mask_t5_kross_id')->nullable();
            $table->integer('tx_mask_t5_kross_new')->default(0);
            $table->double('tx_mask_t5_kross_ota_commissions_collected', 10, 2)->default(0);
            $table->string('tx_mask_t5_kross_ota_id')->nullable();
            $table->double('tx_mask_t5_kross_other_extra_total_amount', 10, 2)->default(0);
            $table->double('tx_mask_t5_kross_payment_total_amount', 10, 2)->default(0);
            $table->double('tx_mask_t6_assistenza_interventol_lastminute', 10, 2)->default(0);
            $table->double('tx_mask_t6_intervento_lastminute', 10, 2)->default(0);
            $table->double('costo_orario', 10, 2)->default(0);
            $table->double('totale_pulizie', 10, 2)->default(0);
            $table->double('costo_co', 10, 2)->default(0);
            $table->double('mancia_cli', 10, 2)->default(0);
            $table->double('prev_di_cui_pulizie_cliente', 10, 2)->default(0);
            $table->double('prev_tot_extra_cash_co', 10, 2)->default(0);
            $table->double('prev_di_cui_ac_wifi_non_selezionato', 10, 2)->default(0);
            $table->double('prev_di_cui_biancheria_extra_a_pagamento', 10, 2)->default(0);
            $table->double('prev_incasso_preventivo_con_extra', 10, 2)->default(0);
            $table->double('cons_di_cui_incassi_banca', 10, 2)->default(0);
            $table->double('cons_tot_ingresso_banca', 10, 2)->default(0);
            $table->double('cons_totale_extra_cash_ritirato_al_co', 10, 2)->default(0);
            $table->double('cons_tassa_soggiorno_da_ritirare', 10, 2)->default(0);
            $table->double('cons_diff_cons_prev', 10, 2)->default(0);
            $table->double('cons_incasso_consuntivo_totale_con_extra_no_siti_web', 10, 2)->default(0);
            $table->double('cons_incasso_consuntivo_totale_con_extra_siti_web', 10, 2)->default(0);
            $table->double('cons_totale_costi', 10, 2)->default(0);
            $table->double('cons_guadagno', 10, 2)->default(0);
            $table->double('costi_check_in_self_check_in', 10, 2)->default(0);
            $table->double('costi_spese_extra_operatore_check_in', 10, 2)->default(0);
            $table->double('costi_totale_costo_check_in', 10, 2)->default(0);
            $table->double('costi_costo_check_out', 10, 2)->default(0);
            $table->double('costi_totale_costo_check_out', 10, 2)->default(0);
            $table->double('costi_costo_pulizie', 10, 2)->default(0);
            $table->double('costi_totale_costo_pulizie', 10, 2)->default(0);
            $table->double('costi_costo_operatore_cambio_biancheria', 10, 2)->default(0);
            $table->double('costi_costo_kit', 10, 2)->default(0);
            $table->double('costi_costo_cambi', 10, 2)->default(0);
            $table->double('costi_costo_biancheria_extra_a_pagamento', 10, 2)->default(0);
            $table->double('costi_totale_costo_per_cambio_biancheria_costo_lavanderia', 10, 2)->default(0);
            $table->double('costi_totale_costi', 10, 2)->default(0);
            $table->double('prop_percentuale_proprietario', 10, 2)->default(0);
            $table->double('prop_percentuale_simonetta', 10, 2)->default(0);
            $table->double('prop_incasso_ospiti_extra', 10, 2)->default(0);
            $table->double('prop_costo_medio_a_notte', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
