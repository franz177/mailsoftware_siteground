<?php

/*
    QUESTO È UN WORK IN PROGRESS, ALCUNI DATI POTREBBERO NON COMBACIARE
    REALMENTE, AGGIORNARE QUESTA LISTA SE SI INCAPPA IN INCONSISTENZE

    tx_mask_p_data_arrivo           datetime, data di arrivo degli ospiti
    tx_mask_p_data_partenza         datetime, data di checkout e partenza degli ospiti
                                    Da considerare il fatto che non va considerato come un giorno pagato
    tx_mask_cod_reservation_status  stato della prenotazione
                                    Può assumere diversi valori, solitamente solo quelle con stato "CANC" non vanno considerate
*/

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'uid';

    protected $fillable = [
        'uid', 'header', 'subheader', 'tx_mask_cod_reservation_status', 'tx_mask_contatto_riferimento',
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
        'tx_mask_t6_intervento_lastminute', 'costo_orario', 'totale_pulizie', 'costo_co', 'mancia_cli',
        'prev_di_cui_pulizie_cliente', 'prev_tot_extra_cash_co', 'prev_di_cui_ac_wifi_non_selezionato', 'prev_di_cui_biancheria_extra_a_pagamento', 'prev_incasso_preventivo_con_extra',
        'cons_di_cui_incassi_banca', 'cons_tot_ingresso_banca', 'cons_totale_extra_cash_ritirato_al_co', 'cons_tassa_soggiorno_da_ritirare', 'cons_diff_cons_prev',
        'cons_incasso_consuntivo_totale_con_extra_no_siti_web', 'cons_incasso_consuntivo_totale_con_extra_siti_web', 'cons_totale_costi', 'cons_guadagno', 'costi_check_in_self_check_in',
        'costi_spese_extra_operatore_check_in', 'costi_totale_costo_check_in', 'costi_costo_check_out', 'costi_totale_costo_check_out', 'costi_costo_pulizie',
        'costi_totale_costo_pulizie', 'costi_costo_operatore_cambio_biancheria', 'costi_costo_kit', 'costi_costo_cambi', 'costi_costo_biancheria_extra_a_pagamento',
        'costi_totale_costo_per_cambio_biancheria_costo_lavanderia', 'costi_totale_costi', 'prop_percentuale_proprietario', 'prop_percentuale_simonetta', 'prop_incasso_ospiti_extra',
        'prop_costo_medio_a_notte', 'created_at', 'updated_at', 'hidden', 'deleted',
    ];

    public $columns = [
        'uid', 'header', 'subheader', 'tx_mask_cod_reservation_status', 'tx_mask_contatto_riferimento',
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
        'tx_mask_t6_intervento_lastminute', 'costo_orario', 'totale_pulizie', 'costo_co', 'mancia_cli',
        'prev_di_cui_pulizie_cliente', 'prev_tot_extra_cash_co', 'prev_di_cui_ac_wifi_non_selezionato', 'prev_di_cui_biancheria_extra_a_pagamento', 'prev_incasso_preventivo_con_extra',
        'cons_di_cui_incassi_banca', 'cons_tot_ingresso_banca', 'cons_totale_extra_cash_ritirato_al_co', 'cons_tassa_soggiorno_da_ritirare', 'cons_diff_cons_prev',
        'cons_incasso_consuntivo_totale_con_extra_no_siti_web', 'cons_incasso_consuntivo_totale_con_extra_siti_web', 'cons_totale_costi', 'cons_guadagno', 'costi_check_in_self_check_in',
        'costi_spese_extra_operatore_check_in', 'costi_totale_costo_check_in', 'costi_costo_check_out', 'costi_totale_costo_check_out', 'costi_costo_pulizie',
        'costi_totale_costo_pulizie', 'costi_costo_operatore_cambio_biancheria', 'costi_costo_kit', 'costi_costo_cambi', 'costi_costo_biancheria_extra_a_pagamento',
        'costi_totale_costo_per_cambio_biancheria_costo_lavanderia', 'costi_totale_costi', 'prop_percentuale_proprietario', 'prop_percentuale_simonetta', 'prop_incasso_ospiti_extra',
        'prop_costo_medio_a_notte', 'created_at', 'updated_at', 'hidden', 'deleted',
    ];

    /*
     * RELATIONSHIP
     * */

    public function country()
    {
        return $this->hasOne(Country::class, 'uid', 'tx_mask_t0_country');
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'tx_mask_p_casa', 'uid');
    }

    public function scopeConfirmed($query)
    {
        $query->where('tx_mask_cod_reservation_status', '!=', 'CANC');
    }

    public function threads()
    {
        return $this->hasMany(Thread::class, 'uid', 'uid')->orderBy('created_at', 'desc');
    }

    public function explodedDays()
    {
        $start = Carbon::parse($this->attributes['tx_mask_p_data_arrivo']);
        $end = Carbon::parse($this->attributes['tx_mask_p_data_partenza']);

        /*
            Nota: DatePeriod non include l'ultimo giorno, ma è giusto così.
            L'ultimo giorno delle prenotazioni è quello del checkout, e
            ovviamente non viene pagato
        */
        return new Collection(new \DatePeriod($start, new \DateInterval('P1D'), $end));
    }

    /*
     * DATA FORMAT CONVERSION
     * */

    public function getTxMaskPDataArrivoAttribute()
    {
        if($this->attributes['tx_mask_p_data_arrivo'])
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tx_mask_p_data_arrivo'])->format('d-m-y');
    }

    public function getTxMaskPDataPartenzaAttribute()
    {
        if($this->attributes['tx_mask_p_data_partenza'])
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tx_mask_p_data_partenza'])->format('d-m-y');
    }
    public function getTxMaskPDataPrenotazioneAttribute()
    {
        if($this->attributes['tx_mask_p_data_prenotazione'])
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tx_mask_p_data_prenotazione'])->format('d-m-y');
    }

    public function setTxMaskPDataArrivoAttribute($value)
    {
        $this->attributes['tx_mask_p_data_arrivo'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function setTxMaskPDataPartenzaAttribute($value)
    {
        $this->attributes['tx_mask_p_data_partenza'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }
    public function setTxMaskPDataPrenotazioneAttribute($value)
    {
        $this->attributes['tx_mask_p_data_prenotazione'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    /*
     * FUNCTION TO SET DATA INTO CUSTOM COLUMNS ADDED TO BOOKINGS TABLE
     * THE FUNCTIONS BELOW SETS ALL CALCULATION THAT ARE INDICATED IN THE FILE DATABASE ALGUERHOME - CAMPI DB > CALCOLI DETT SHEET
     * */

    /**
     * Set Costo Orario
     */
    public function setCostoOrarioAttribute($value)
    {
        $id_op_pulizie = [
            $this->attributes['tx_mask_t1_op_pulizie'] ? $this->attributes['tx_mask_t1_op_pulizie'] : 19
        ];
        $id_house = $this->attributes['tx_mask_p_casa'];

        $user = TypoUser::where('uid',$id_op_pulizie)->first();

        if($user->deleted != 1){
            $costo_op = TypoCHouse::select('tx_mask_c_cod_costo_orario_operatore')
                ->whereIn('tx_mask_c_cod_feuser', $id_op_pulizie)
                ->where('tx_mask_c_cod_casa', 'like', '%'. $id_house .'%')
                ->first();

            if($costo_op){
                return $this->attributes['costo_orario'] = $costo_op->tx_mask_c_cod_costo_orario_operatore;
            } else {
                return $this->attributes['costo_orario'] = 0;
            }
        } else {
            return $this->attributes['costo_orario'] = 0;
        }

    }

    /**
     * Set Mancia Cliente
     */
    public function setManciaCliAttribute($value)
    {
        return $this->attributes['mancia_cli'] = ($this->attributes['tx_mask_t3_p_cash_op_cout'] + $this->attributes['tx_mask_t3_p_cash_simo']) - ($this->attributes['tx_mask_t3_p_city_tax_amount'] + $this->attributes['tx_mask_t3_p_s_checkout']);
    }

    /**
     *  INCASSI CONSUNTIVO
     */

    /**
     * Set Prev - Di Cui Pulizie Cliente
     */
    public function setPrevDiCuiPulizieClienteAttribute($value){
        if($this->attributes['tx_mask_t3_p_cleaning_fee_amount'] != 0) {
            return $this->attributes['prev_di_cui_pulizie_cliente'] =  $this->attributes['tx_mask_t3_p_cleaning_fee_amount'];
        } else {
            return $this->attributes['prev_di_cui_pulizie_cliente'] =  $this->attributes['tx_mask_t5_kross_cleaning_fee_amount'];
        }
    }

    /**
     * Set Prev - Tot Extra Cash CO
     */
    public function setPrevTotExtraCashCoAttribute($value){
        return $this->attributes['prev_tot_extra_cash_co'] =  $this->attributes['tx_mask_t3_p_s_checkout'] + $this->attributes['tx_mask_t3_p_city_tax_amount'];
    }

    /**
     * Set Prev - Di Cui Biancheria Extra A pagamento
     */
    public function setPrevDiCuiBiancheriaExtraApagamentoAttribute($value)
    {
        if($this->attributes['tx_mask_t2_p_bianc'] > 0){
            $typo_el_bianc = Typo::select('uid','header', 'subheader', 'tx_mask_bianc_tradit', 'tx_mask_bianc_traden', 'tx_mask_t1_bianc_qy_m', 'tx_mask_t1_bianc_qy_s', 'tx_mask_t1_bianc_qy_ba', 'tx_mask_t1_bianc_qy_v', 'tx_mask_t1_bianc_qy_f', 'tx_mask_t1_bianc_qy_bi')
                ->where('Ctype', 'mask_db_alg_el_bianc')
                ->where('uid',$this->attributes['tx_mask_t2_p_bianc'])
                ->first();

            $typo_house = Typo::select('uid', 'header', 'tx_mask_casa_bagni', 'tx_mask_casa_torcioni' )
                ->where('Ctype', 'mask_db_alg_h')
                ->where('uid',$this->attributes['tx_mask_p_casa'])
                ->first();

            $typo_bianc_cs_periodo = TypoBiancCsPeriodo::where('tx_mask_bianc_cs_dal', '<=', $this->attributes['tx_mask_p_data_arrivo'])
                ->where('tx_mask_bianc_cs_al', '>=', $this->attributes['tx_mask_p_data_arrivo'])
                ->where('hidden', 0)
                ->where('deleted', 0)
                ->first();

            if(!$typo_bianc_cs_periodo){
                return $this->attributes['prev_di_cui_biancheria_extra_a_pagamento'] = 0;
            }

            $typo_costi_biancheria = Typo::select('uid', 'header',
                'tx_mask_bianc_cs_m', 'tx_mask_bianc_cs_s', 'tx_mask_bianc_cs_ba', 'tx_mask_bianc_cs_v', 'tx_mask_bianc_cs_f', 'tx_mask_bianc_cs_bi',
                'tx_mask_bianc_cs_ta', 'tx_mask_bianc_cs_to', 'tx_mask_bianc_cs_periodo',)
                ->where('Ctype', 'mask_db_alg_cos_bianc')
                ->where('uid', $typo_bianc_cs_periodo->parentid)
                ->first();

            $this->tot_lenzuola = (
                ($typo_el_bianc->tx_mask_t1_bianc_qy_m * $typo_costi_biancheria->tx_mask_bianc_cs_m) +
                ($typo_el_bianc->tx_mask_t1_bianc_qy_s * $typo_costi_biancheria->tx_mask_bianc_cs_s) +
                ($typo_el_bianc->tx_mask_t1_bianc_qy_f * $typo_costi_biancheria->tx_mask_bianc_cs_f)
            );
            $this->tot_asciugamani = (
                ($typo_el_bianc->tx_mask_t1_bianc_qy_ba * $typo_costi_biancheria->tx_mask_bianc_cs_ba) +
                ($typo_el_bianc->tx_mask_t1_bianc_qy_v * $typo_costi_biancheria->tx_mask_bianc_cs_v) +
                ($typo_el_bianc->tx_mask_t1_bianc_qy_bi * $typo_costi_biancheria->tx_mask_bianc_cs_bi) +
                ($typo_house->tx_mask_casa_bagni * $typo_costi_biancheria->tx_mask_bianc_cs_ta) +
                ($typo_house->tx_mask_casa_torcioni * $typo_costi_biancheria->tx_mask_bianc_cs_to)
            );

            $total = $this->tot_lenzuola + $this->tot_asciugamani;

            return $this->attributes['prev_di_cui_biancheria_extra_a_pagamento'] = $total;
        } else {
            return $this->attributes['prev_di_cui_biancheria_extra_a_pagamento'] = $value;
        }
    }

    /**
     * Set Prev - Incasso Preventivo Con Extra
     */
    public function setPrevIncassoPreventivoConExtraAttribute($value)
    {
        return $this->attributes['prev_incasso_preventivo_con_extra'] = $this->attributes['tx_mask_t3_p_stay'] + $this->attributes['tx_mask_t3_p_s_checkout'] - $this->attributes['tx_mask_p_perc_importo_fisso'];
    }

    /**
     * COSTI
     *
     */

    /**
     * Set Costi - Costo Check-In e Self Check-In
     */
    public function setCostiCheckInSelfCheckInAttribute($value){
        $id_op_cin = [
            $this->attributes['tx_mask_t1_op_chechin'] ? $this->attributes['tx_mask_t1_op_chechin'] : 19
        ];

        $id_house = $this->attributes['tx_mask_p_casa'];

        $user = TypoUser::where('uid',$id_op_cin)->first();

        if($user->deleted != 1){
            $c_house = TypoCHouse::select('tt_content.uid', 'tt_content.header', 'tt_content.tx_mask_t4_govin_cin_base', 'tt_content.tx_mask_t4_govin_cin_specializzato',
                'tx_mask_t4_govin_cin_loco')
                ->join('tx_mask_c_cos_periodo', 'tx_mask_c_cos_periodo.parentid', '=', 'tt_content.uid')
                ->whereIn('tt_content.tx_mask_c_cod_feuser', $id_op_cin)
                ->where('tt_content.tx_mask_c_cod_casa', 'like', '%'. $id_house .'%')
                ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_from', '<=', $this->attributes['tx_mask_p_data_partenza'])
                ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_to', '>=', $this->attributes['tx_mask_p_data_partenza'])
                ->where('tt_content.hidden', 0)
                ->where('tt_content.deleted', 0)
                ->first();

            if($c_house){
                switch ($this->attributes['tx_mask_t1_op_tipo_checkin']){
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
                $check_in = 0;
            }
        } else {
            $check_in = -99;
        }

        return $this->attributes['costi_check_in_self_check_in'] = $check_in;

    }

    /**
     * Set Costi - Costi Totale Costo Check In
     */
    public function setCostiTotaleCostoCheckInAttribute($value)
    {
        return $this->attributes['costi_totale_costo_check_in'] = $this->attributes['costi_check_in_self_check_in'] + $this->attributes['costi_spese_extra_operatore_check_in'];
    }

    /**
     * Set Costi - Costo CheckOut: RANGE A
     */
    public function setCostoCoAttribute($value)
    {
        $id_op_co = [
            $this->attributes['tx_mask_t1_op_checkout'] ? $this->attributes['tx_mask_t1_op_checkout'] : 19
        ];
        $id_house = $this->attributes['tx_mask_p_casa'];

        $user = TypoUser::where('uid',$id_op_co)->first();

        if($user->deleted != 1){
            $c_house = TypoCHouse::select('tt_content.uid', 'tt_content.header', 'tt_content.tx_mask_t3_govout_c_cout', 'tt_content.tx_mask_t3_govout_ritiro_immondizia', 'tt_content.tx_mask_t3_govout_ritiro_soldi',
                'tt_content.tx_mask_t2_lav_c_cambio_b_cout', 'tt_content.tx_mask_t2_lav_prep_kit_cliente', 'tt_content.tx_mask_t2_lav_costo_dotazione_casa', 'tt_content.tx_mask_t2_lav_prep_kit_dotazione_casa')
                ->join('tx_mask_c_cos_periodo', 'tx_mask_c_cos_periodo.parentid', '=', 'tt_content.uid')
//                ->where('tt_content.tx_mask_c_cod_feuser', 'like', '%'. $id_op_co .'%')
                ->whereIn('tt_content.tx_mask_c_cod_feuser', $id_op_co)
                ->where('tt_content.tx_mask_c_cod_casa', 'like', '%'. $id_house .'%')
                ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_from', '<=', $this->attributes['tx_mask_p_data_partenza'])
                ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_to', '>=', $this->attributes['tx_mask_p_data_partenza'])
                ->where('tt_content.hidden', 0)
                ->where('tt_content.deleted', 0)
                ->first();
            if($c_house){
                $sum = $c_house->tx_mask_t3_govout_c_cout + $c_house->tx_mask_t3_govout_ritiro_immondizia + $c_house->tx_mask_t3_govout_ritiro_soldi + $c_house->tx_mask_t2_lav_c_cambio_b_cout + $c_house->tx_mask_t2_lav_prep_kit_cliente + $c_house->tx_mask_t2_lav_costo_dotazione_casa + $c_house->tx_mask_t2_lav_prep_kit_dotazione_casa;
                return $this->attributes['costo_co'] = $sum;
            } else {
                return $this->attributes['costo_co'] = 0;
            }
        } else {
            return $this->attributes['costo_co'] = 0;
        }
    }

    /**
     * Set Costi - Costo CheckOut: RANGE A Duplicato per sbaglio ma ormai c'è...
     */
    public function setCostiCostoCheckOutAttribute($value)
    {
        return $this->attributes['costi_costo_check_out'] = $this->attributes['costo_co'];
    }

    /**
     * Set Costi - Totale Costo CheckOut
     */
    public function setCostiTotaleCostoCheckOutAttribute($value)
    {
        return $this->attributes['costi_totale_costo_check_out'] = $this->attributes['costi_costo_check_out'] + $this->attributes['tx_mask_t3_p_s_ex_checkout'];
    }

    /**
     * Set Costi - Costo Pulizie: RANGE A
     */
    public function setTotalePulizieAttribute($value)
    {
        $id_op_pulizie = [
            $this->attributes['tx_mask_t1_op_pulizie'] ? $this->attributes['tx_mask_t1_op_pulizie'] : 19
        ];
        $id_house = $this->attributes['tx_mask_p_casa'];

        $user = TypoUser::where('uid',$id_op_pulizie)->first();

        if($user->deleted != 1){
            $c_house = TypoCHouse::select([TypoCHouse::raw('IFNULL(tt_content.tx_mask_c_cod_costo_orario_operatore, 19) costo_orario_operatore'), 'tt_content.tx_mask_t7_pulizie_metodo',
                'tt_content.tx_mask_t3_govout_c_cout', 'tt_content.tx_mask_t3_govout_ritiro_immondizia', 'tt_content.tx_mask_t3_govout_ritiro_soldi',
                'tt_content.tx_mask_t2_lav_c_cambio_b_cout', 'tt_content.tx_mask_t2_lav_prep_kit_cliente', 'tt_content.tx_mask_t2_lav_costo_dotazione_casa', 'tt_content.tx_mask_t2_lav_prep_kit_dotazione_casa',
                'tt_content.tx_mask_t7_cert_covid', 'tt_content.tx_mask_t7_costo_prod_pul', 'tt_content.tx_mask_t7_pul_stracci', 'tt_content.tx_mask_t5_supervisor_c_fornitura_kit_serv', 'tt_content.tx_mask_t7_fisso_pul'])
                ->join('tx_mask_c_cos_periodo', 'tx_mask_c_cos_periodo.parentid', '=', 'tt_content.uid')
                ->whereIn('tt_content.tx_mask_c_cod_feuser', $id_op_pulizie)
                ->where('tt_content.tx_mask_c_cod_casa', 'like', '%'. $id_house .'%')
                ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_from', '<=', $this->attributes['tx_mask_p_data_arrivo'])
                ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_to', '>=', $this->attributes['tx_mask_p_data_arrivo'])
                ->where('tt_content.deleted', '=', 0)
                ->first();

            if($c_house){
                $sum = $c_house->tx_mask_t3_govout_c_cout + $c_house->tx_mask_t3_govout_ritiro_immondizia + $c_house->tx_mask_t3_govout_ritiro_soldi + $c_house->tx_mask_t2_lav_c_cambio_b_cout + $c_house->tx_mask_t2_lav_prep_kit_cliente + $c_house->tx_mask_t2_lav_costo_dotazione_casa + $c_house->tx_mask_t2_lav_prep_kit_dotazione_casa;
                $sum_pulizie = $c_house->tx_mask_t7_cert_covid + $c_house->tx_mask_t7_costo_prod_pul + $c_house->tx_mask_t7_pul_stracci + $c_house->tx_mask_t5_supervisor_c_fornitura_kit_serv + $c_house->tx_mask_t7_fisso_pul;

                if ($this->attributes['tx_mask_t1_ore_pulizie'] > 0){
                    $total = ($this->attributes['tx_mask_t1_ore_pulizie'] * $c_house->costo_orario_operatore);

                    $check_co = Typo::select('uid')
                        ->where('tt_content.CType', 'mask_db_alg_pren')
                        ->where('tt_content.hidden', '=', 0)
                        ->where('tt_content.deleted', '=', 0)
                        ->where('tt_content.tx_mask_p_casa', $this->attributes['tx_mask_p_casa'])
                        ->where('tt_content.tx_mask_p_data_partenza', $this->attributes['tx_mask_p_data_arrivo'])
                        ->where('tt_content.tx_mask_t1_op_checkout', $this->attributes['tx_mask_t1_op_pulizie'])
                        ->first();

                    if($check_co) {
                        $total = $total - $sum;
                    }
                    return $this->attributes['totale_pulizie'] = $total;
                } else {
                    switch ($c_house->tx_mask_t7_pulizie_metodo){
                        case 1: // RANGE
                            $id_house = $this->attributes['tx_mask_p_casa'];
                            $range = TypoRange::select('uid', 'header', 'tx_mask_r_casa', 'tx_mask_r_dal', 'tx_mask_r_al', 'tx_mask_r_mm')
                                ->where('tx_mask_r_casa', 'like', '%'. $id_house .'%')
                                ->where('tx_mask_r_dal', '<=', $this->attributes['tx_mask_p_data_arrivo'])
                                ->where('tx_mask_r_al', '>=', $this->attributes['tx_mask_p_data_arrivo'])
                                ->where('hidden', 0)
                                ->where('deleted', 0)
                                ->first();

                            if(!$range){
                                return $this->attributes['totale_pulizie'] = 0;
                            }

                            $range_mm = TypoRangeMM::select('tx_mask_r_mm_min', 'tx_mask_r_mm_max','tx_mask_r_mm_importo')
                                ->where('parentid', $range['uid'])
                                ->where('tx_mask_r_mm_max','>=', $this->attributes['tx_mask_t3_p_stay'])
                                ->first();
                            return $this->attributes['totale_pulizie'] = $range_mm['tx_mask_r_mm_importo'];

                        case 2: // IMPORTO FISSO
                            if($sum_pulizie == 0)
                                return $this->attributes['totale_pulizie'] = 0;

                            return $this->attributes['totale_pulizie'] = $sum_pulizie;
                        default:
                            return $this->attributes['totale_pulizie'] = 0;
                    }
                }
            } else {
                return $this->attributes['totale_pulizie'] = 0;
            }
        } else {
            return $this->attributes['totale_pulizie'] = 0;
        }
    }

    /**
     * Set Costi - Costo Pulizie: RANGE A
     */
    public function setCostiCostoPulizieAttribute($value)
    {
        return $this->attributes['costi_costo_pulizie'] = $this->attributes['totale_pulizie'];
    }

    /**
     * Set Costi - Totale Costo Pulizie: RANGE A
     */
    public function setCostiTotaleCostoPulizieAttribute($value)
    {
        return $this->attributes['costi_totale_costo_pulizie'] = $this->attributes['costi_costo_pulizie']+ $this->attributes['tx_mask_t3_p_extra_p'];
    }

    /**
     * Set Costi - Costo Operatore Cambio Biancheria
     */
    public function setCostiCostoOperatoreCambioBiancheriaAttribute($value)
    {
        $id_op_co = $this->attributes['tx_mask_t1_op_cambio_biancheria'] ? $this->attributes['tx_mask_t1_op_cambio_biancheria'] : 19;
        $id_house = $this->attributes['tx_mask_p_casa'];

        $user = TypoUser::where('uid',$id_op_co)->first();

        if($user->deleted != 1 && $this->attributes['tx_mask_t2_p_cambi_l'] > 0){
            $c_house = TypoCHouse::select('tx_mask_t2_lav_c_cambio_b_stay_ar')
                ->where('tx_mask_c_cod_feuser', 'like', '%'. $id_op_co .'%')
                ->where('tx_mask_c_cod_casa', 'like', '%'. $id_house .'%')
                ->where('hidden', 0)
                ->where('deleted', 0)
                ->first();

            if($c_house){
                return $this->attributes['costi_costo_operatore_cambio_biancheria'] = $c_house['tx_mask_t2_lav_c_cambio_b_stay_ar'] * $this->attributes['tx_mask_t2_p_cambi_l'];
            } else {
                return $this->attributes['costi_costo_operatore_cambio_biancheria'] = 0;
            }
        } else {
            return $this->attributes['costi_costo_operatore_cambio_biancheria'] = 0;
        }
    }

    private $tot_lenzuola = 0;
    private $tot_asciugamani = 0;

    /**
     * Set Costi - Costo Kit
     */
    public function setCostiCostoKitAttribute($value)
    {
        if($this->attributes['tx_mask_t2_p_bianc'] > 0){
            $typo_el_bianc = Typo::select('uid','header', 'subheader', 'tx_mask_bianc_tradit', 'tx_mask_bianc_traden', 'tx_mask_t1_bianc_qy_m', 'tx_mask_t1_bianc_qy_s', 'tx_mask_t1_bianc_qy_ba', 'tx_mask_t1_bianc_qy_v', 'tx_mask_t1_bianc_qy_f', 'tx_mask_t1_bianc_qy_bi')
                ->where('Ctype', 'mask_db_alg_el_bianc')
                ->where('uid',$this->attributes['tx_mask_t2_p_bianc'])
                ->first();

            $typo_house = Typo::select('uid', 'header', 'tx_mask_casa_bagni', 'tx_mask_casa_torcioni' )
                ->where('Ctype', 'mask_db_alg_h')
                ->where('uid',$this->attributes['tx_mask_p_casa'])
                ->first();

            $typo_bianc_cs_periodo = TypoBiancCsPeriodo::where('tx_mask_bianc_cs_dal', '<=', $this->attributes['tx_mask_p_data_arrivo'])
                ->where('tx_mask_bianc_cs_al', '>=', $this->attributes['tx_mask_p_data_arrivo'])
                ->where('hidden', 0)
                ->where('deleted', 0)
                ->first();

            if($typo_bianc_cs_periodo){
                $typo_costi_biancheria = Typo::select('uid', 'header',
                    'tx_mask_bianc_cs_m', 'tx_mask_bianc_cs_s', 'tx_mask_bianc_cs_ba', 'tx_mask_bianc_cs_v', 'tx_mask_bianc_cs_f', 'tx_mask_bianc_cs_bi',
                    'tx_mask_bianc_cs_ta', 'tx_mask_bianc_cs_to', 'tx_mask_bianc_cs_periodo',)
                    ->where('Ctype', 'mask_db_alg_cos_bianc')
                    ->where('uid', $typo_bianc_cs_periodo->parentid)
                    ->first();

                $this->tot_lenzuola = (
                    ($typo_el_bianc->tx_mask_t1_bianc_qy_m * $typo_costi_biancheria->tx_mask_bianc_cs_m) +
                    ($typo_el_bianc->tx_mask_t1_bianc_qy_s * $typo_costi_biancheria->tx_mask_bianc_cs_s) +
                    ($typo_el_bianc->tx_mask_t1_bianc_qy_f * $typo_costi_biancheria->tx_mask_bianc_cs_f)
                );
                $this->tot_asciugamani = (
                    ($typo_el_bianc->tx_mask_t1_bianc_qy_ba * $typo_costi_biancheria->tx_mask_bianc_cs_ba) +
                    ($typo_el_bianc->tx_mask_t1_bianc_qy_v * $typo_costi_biancheria->tx_mask_bianc_cs_v) +
                    ($typo_el_bianc->tx_mask_t1_bianc_qy_bi * $typo_costi_biancheria->tx_mask_bianc_cs_bi) +
                    ($typo_house->tx_mask_casa_bagni * $typo_costi_biancheria->tx_mask_bianc_cs_ta) +
                    ($typo_house->tx_mask_casa_torcioni * $typo_costi_biancheria->tx_mask_bianc_cs_to)
                );

                $total = $this->tot_lenzuola + $this->tot_asciugamani;

                return $this->attributes['costi_costo_kit'] = $total;
            } else {
                return $this->attributes['costi_costo_kit'] = 0;
            }


        } else {
            return $this->attributes['costi_costo_kit'] = $value;
        }
    }

    /**
     * Set Costi - Costo Costo Cambi
     */
    public function setCostiCostoCambiAttribute($value)
    {
        $cambio_l = 0;
        $cambio_a = 0;

        if($this->attributes['tx_mask_t2_p_cambi_l'] > 0)
            $cambio_l = ($this->attributes['tx_mask_t2_p_cambi_l'] * $this->tot_lenzuola);

        if($this->attributes['tx_mask_t2_p_cambi_a'] > 0)
            $cambio_a = ($this->attributes['tx_mask_t2_p_cambi_a'] * $this->tot_asciugamani);

        return $this->attributes['costi_costo_cambi'] = $cambio_l + $cambio_a;

    }

    /**
     * Set Costi - Costi Costo Biancheria Extra a Pagamento
     */
    public function setCostiCostoBiancheriaExtraApagamentoAttribute($value)
    {
        return $this->attributes['costi_costo_biancheria_extra_a_pagamento'] = $this->attributes['tx_mask_t2_p_c_extra_kit'] + $this->attributes['tx_mask_t2_p_c_extra_b'];
    }

    /**
     * Set Costi - Costi Totale Costo Per Cambio Biancheria Costo Lavanderia
     */
    public function setCostiTotaleCostoPerCambioBiancheriaCostoLavanderiaAttribute($value)
    {
        return $this->attributes['costi_totale_costo_per_cambio_biancheria_costo_lavanderia'] = $this->attributes['costi_costo_operatore_cambio_biancheria'] + $this->attributes['costi_costo_kit'] + $this->attributes['costi_costo_cambi'] + $this->attributes['costi_costo_biancheria_extra_a_pagamento'];
    }

    /**
     * Set Costi - Costi Totale Costo Per Cambio Biancheria Costo Lavanderia
     */
    public function setCostiTotaleCostiAttribute($value)
    {
        return $this->attributes['costi_totale_costi'] = $this->attributes['tx_mask_p_perc_importo_fisso'] + $this->attributes['costi_totale_costo_check_in'] + $this->attributes['costi_totale_costo_check_out'] + $this->attributes['costi_totale_costo_pulizie'] + $this->attributes['costi_totale_costo_per_cambio_biancheria_costo_lavanderia'];
    }

    /**
     *  INCASSI CONSUNTIVO
     */

    /**
     * Set Cons - Di Cui Incassi Banca
     */
    public function setConsDiCuiIncassiBancaAttribute($value)
    {
        if($this->attributes['tx_mask_p_sito'] == 47) {
            return $this->attributes['cons_di_cui_incassi_banca'] = ($this->attributes['tx_mask_t3_p_stay'] - $this->attributes['tx_mask_t3_p_s_chin'] - $this->attributes['tx_mask_t3_p_s_b']);
        } else {
            return $this->attributes['cons_di_cui_incassi_banca'] = $this->attributes['tx_mask_t3_p_stay'] - $this->attributes['tx_mask_p_perc_importo_fisso'];
        }
    }

    /**
     * Set Cons - Tot Ingresso Banca
     */
    public function setConsTotIngressoBancaAttribute($value)
    {
        return $this->attributes['cons_tot_ingresso_banca'] =  $this->attributes['cons_di_cui_incassi_banca'] + $this->attributes['tx_mask_t3_p_s_b'];
    }

    /**
     * Set Cons - Totale Extra Cash Ritirato Al Co
     */
    public function setConsTotaleExtraCashRitiratoAlCoAttribute($value)
    {
        return $this->attributes['cons_totale_extra_cash_ritirato_al_co'] =  $this->attributes['tx_mask_t3_p_cash_simo'] + $this->attributes['tx_mask_t3_p_cash_op_cout'];
    }

    /**
     * Set Cons - Tassa Soggiorno Da Ritirare
     */
    public function setConsTassaSoggiornoDaRitirareAttribute($value)
    {
        return $this->attributes['cons_tassa_soggiorno_da_ritirare'] =  ($this->attributes['cons_totale_extra_cash_ritirato_al_co'] - $this->attributes['tx_mask_t3_p_s_checkout'] - $this->attributes['tx_mask_t3_p_city_tax_amount']);
    }

    /**
     * Set Cons - Incasso Consuntivo Totale Con Extra No Siti Web
     */
    public function setConsIncassoConsuntivoTotaleConExtraNoSitiWebAttribute($value)
    {
        return $this->attributes['cons_incasso_consuntivo_totale_con_extra_no_siti_web'] =  (($this->attributes['cons_tot_ingresso_banca'] + $this->attributes['tx_mask_t3_p_s_chin'] + $this->attributes['cons_totale_extra_cash_ritirato_al_co']) - $this->attributes['tx_mask_t3_p_city_tax_amount']);
    }

    /**
     * Set Cons - Diff Cons Prev
     */
    public function setConsDiffConsPrevAttribute($value)
    {
        return $this->attributes['cons_diff_cons_prev'] = ($this->attributes['prev_incasso_preventivo_con_extra'] - $this->attributes['cons_incasso_consuntivo_totale_con_extra_no_siti_web']);
    }

    /**
     * Set Cons - Incasso Consuntivo Totale Con Extra Siti Web
     */
    public function setConsIncassoConsuntivoTotaleConExtraSitiWebAttribute($value)
    {
        return $this->attributes['cons_incasso_consuntivo_totale_con_extra_siti_web'] = ($this->attributes['cons_incasso_consuntivo_totale_con_extra_no_siti_web'] + $this->attributes['tx_mask_p_perc_importo_fisso']);
    }

    /**
     * Set Cons - Totale Costi
     */
    public function setConsTotaleCostiAttribute($value)
    {
        return $this->attributes['cons_totale_costi'] = $this->attributes['costi_totale_costi'];
    }

    /**
     * Set Cons - Guadagno (INCASSI - COSTI)
     */
    public function setConsGuadagnoAttribute($value)
    {
        return $this->attributes['cons_guadagno'] = $this->attributes['prev_incasso_preventivo_con_extra'] - $this->attributes['costi_totale_costi'];
    }

    /**
     * PROPRIETARIO
     */

    /**
     * Set Prop - Percentuale Proprietario
     */
    public function setPropPercentualeProprietarioAttribute($value)
    {
        $proprietario = Typo::select('tt_content.uid', 'tt_content.tx_mask_propr_casa', 'tt_content.tx_mask_propr_dal', 'tt_content.tx_mask_propr_al',
            'tx_mask_propr_mm.tx_mask_propr_mm_min', 'tx_mask_propr_mm.tx_mask_propr_mm_max', 'tx_mask_propr_mm.tx_mask_propr_mm_percentuale')
            ->join('tx_mask_propr_mm', 'tx_mask_propr_mm.parentid', '=', 'tt_content.uid')
            ->where('tt_content.CType', 'mask_perc_pr')
            ->where('tt_content.tx_mask_propr_casa', 'like', '%'. $this->attributes['tx_mask_p_casa'] .'%')
            ->where('tt_content.tx_mask_propr_dal', '<=', $this->attributes['tx_mask_p_data_arrivo'])
            ->where('tt_content.tx_mask_propr_al', '>=', $this->attributes['tx_mask_p_data_arrivo'])
            ->where('tx_mask_propr_mm.tx_mask_propr_mm_min', '<=', $this->attributes['tx_mask_t3_p_stay'])
            ->where('tx_mask_propr_mm.tx_mask_propr_mm_max', '>=', $this->attributes['tx_mask_t3_p_stay'])
            ->first();

        if (!$proprietario)
            return $this->attributes['prop_percentuale_proprietario'] = 0;

        return $this->attributes['prop_percentuale_proprietario'] = ($this->attributes['cons_incasso_consuntivo_totale_con_extra_no_siti_web']/100) * $proprietario->tx_mask_propr_mm_percentuale;
    }

    /**
     * Set Prop - Percentuale Simonetta
     */
    public function setPropPercentualeSimonettaAttribute($value)
    {
        if ($this->attributes['prop_percentuale_proprietario'] == 0)
            return $this->attributes['prop_percentuale_simonetta'] = 0;

        return $this->attributes['prop_percentuale_simonetta'] = ($this->attributes['cons_incasso_consuntivo_totale_con_extra_no_siti_web'] - $this->attributes['prop_percentuale_proprietario']);
    }

    /**
     * Set Prop - Costo Medio A Notte
     */
    public function setPropCostoMedioAnotteAttribute($value)
    {
        /**
         * TODO
         * prendere tx_mask_p_tot_ospiti
         */

        $arrivo = Carbon::parse($this->attributes['tx_mask_p_data_arrivo']);
        $partenza = Carbon::parse($this->attributes['tx_mask_p_data_partenza']);

        $nights = $partenza->diffInDays($arrivo);

        $p_stay = ($this->attributes['tx_mask_t3_p_stay'] ? ($this->attributes['tx_mask_t3_p_stay'] > 0 ? $this->attributes['tx_mask_t3_p_stay'] : 0) : 0);
        $p_tot_ospiti = ($this->attributes['tx_mask_p_tot_ospiti'] ? ($this->attributes['tx_mask_p_tot_ospiti'] > 0 ? $this->attributes['tx_mask_p_tot_ospiti'] : 0) : 0);
        $p_cleaning_fee_amount = ($this->attributes['tx_mask_t3_p_cleaning_fee_amount'] ? ($this->attributes['tx_mask_t3_p_cleaning_fee_amount'] > 0 ? $this->attributes['tx_mask_t3_p_cleaning_fee_amount'] : $this->attributes['tx_mask_t5_kross_cleaning_fee_amount']) : $this->attributes['tx_mask_t5_kross_cleaning_fee_amount']);

        if ($p_tot_ospiti > 0){

            $extra_by_guest = 'tx_mask_t12_extra'.intval($p_tot_ospiti);

            $extra = TypoExtra::select('parentid', 'tx_mask_t5_metodo_dal', 'tx_mask_t5_metodo_al', $extra_by_guest)
                ->where('parentid', $this->attributes['tx_mask_p_casa'])
                ->where('tx_mask_t5_metodo_dal', '<=', $this->attributes['tx_mask_p_data_arrivo'])
                ->where('tx_mask_t5_metodo_al', '>=', $this->attributes['tx_mask_p_data_arrivo'])
                ->where('hidden', 0)
                ->where('deleted', 0)
                ->first();

            if($p_stay > 0){
                if (!$extra){
                    return  $this->attributes['prop_costo_medio_a_notte'] = (($this->attributes['tx_mask_t3_p_stay'] - $p_cleaning_fee_amount) / $nights);
                }

                return $this->attributes['prop_costo_medio_a_notte'] = (($this->attributes['tx_mask_t3_p_stay'] - $p_cleaning_fee_amount) - ($extra->$extra_by_guest * $nights)) / $nights;
            }
        }

        return  $this->attributes['prop_costo_medio_a_notte'] = 0;

    }

}
