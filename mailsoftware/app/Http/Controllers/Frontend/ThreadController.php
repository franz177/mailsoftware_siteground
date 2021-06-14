<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Operator;
use App\Models\Priority;
use App\Models\TextUser;
use App\Models\Thread;
use App\Models\TypoUser;
use Carbon\Carbon;
use App\Mail\AnswerMail;
use App\Models\City;
use App\Models\CityTax;
use App\Models\Flow;
use App\Models\FlowText;
use App\Models\House;
use App\Models\Typo;
use App\Models\TypoHouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $pren_uid
     * @return \Illuminate\Http\Response
     */
    public function create($pren_uid)
    {
        $pren = Typo::find($pren_uid);

        $house_typo = TypoHouses::select('uid', 'subheader', 'header', 'tx_mask_casa_type', 'tx_mask_casa_add', 'tx_mask_casa_citta', 'tx_mask_casa_key', 'tx_mask_casa_floor', 'tx_mask_casa_bagni', 'tx_mask_casa_torcioni', 'tx_mask_t0_casa_type_en', 'tx_mask_t0_casa_floor_en',
            'tx_mask_t1_op_gestore', 'tx_mask_t1_casa_gestore', 'tx_mask_t1_casa_gestore_email', 'tx_mask_t1_casa_gestore_tel', 'tx_mask_t2_wifi_linea', 'tx_mask_t2_wifi_pwd', 'tx_mask_t5_repeat_metodo', 'tx_mask_t6_def_checkin', 'tx_mask_t6_def_pulizie', 'tx_mask_t6_def_cambi',
            'tx_mask_t6_def_checkout', 'tx_mask_t3_casa_iban', 'tx_mask_t3_casa_note', 'tx_mask_t3_casa_cod_bidoni', 'tx_mask_t3_casa_codice_cond')
            ->where('uid', '=', $pren->tx_mask_p_casa)
            ->first();


        $site = $this->getSitesByKross($pren->tx_mask_t5_kross_cod_channel);
        if($pren->tx_mask_t5_kross_cod_channel == 'BE' || $pren->tx_mask_t5_kross_cod_channel == 'DIRECT')
            $site = $this->getSitesByKross('MAIL');

        $threads_pren = Thread::with('flow')->where('uid','=', $pren_uid)->get();

        $typeanswers_id = [];
        $i=0;
        $threads_count = $threads_pren->count();

        if($threads_count > 0){
            foreach ($threads_pren as $thread){
                $typeanswers_id[$i] = $thread->flow->typeanswer_id;
                $i++;
            }
        }

        $typeanswers = Flow::with('typeanswer')
            ->where('flows.site_uid', '=', $site->uid)
            ->where('flows.house_uid', '=', $pren->tx_mask_p_casa)
            ->groupBy('typeanswer_id')
            ->get();

        $other_texts_by_priority = Priority::whereHas('texts')->with(['texts' => function($query){
            $query->doesntHave('flows');
        }])->get();

        if(!$pren->tx_mask_t0_country){
            $country = 'NaN';
        } else {
            $country = $this->getCountriesArray($pren->tx_mask_t0_country);
            $country = $country->name;
        }

//        TOTALE GIORNI PERMANENZA
        $from = Carbon::parse($pren->tx_mask_p_data_arrivo);
        $to = Carbon::parse($pren->tx_mask_p_data_partenza);
        $days = $from->diffInDays($to);

        $caparra = '';
//        CAPARRA
        $totale = floatval($pren->tx_mask_t3_p_stay);
        $saldoBanca = floatval($pren->tx_mask_t3_p_s_b);
        $saldoCash = floatval($pren->tx_mask_t3_p_s_chin);

        if($saldoBanca == 0 && $saldoCash == 0) {
            $caparra = "No Caparra";
        } else if($saldoBanca > 0 && $saldoCash == 0) {
            $caparra = $totale - $saldoBanca;
            $caparra = number_format($caparra, 2, ",", "."). ' €';
        } else {
            $caparra = $totale - $saldoCash;
            $caparra = number_format($caparra, 2, ",", "."). ' €';
        }

//        CONTATTO DI RIFERIMENTO
        $contatto_riferimento = TypoUser::select(['first_name', 'last_name'])
            ->where('uid', '=', $pren->tx_mask_contatto_riferimento)
            ->first();

        $gestore = $house_typo->tx_mask_t1_casa_gestore;
        $gestore_cliente = $contatto_riferimento->first_name . ' ' . $contatto_riferimento->last_name;

        return view('frontend.threads.create')
            ->with(compact('pren'))
            ->with(compact('house_typo'))
            ->with(compact('site'))
            ->with(compact('typeanswers_id'))
            ->with(compact('typeanswers'))
            ->with(compact('country'))
            ->with(compact('days'))
            ->with(compact('caparra'))
            ->with(compact('gestore'))
            ->with(compact('gestore_cliente'))
            ->with(compact('other_texts_by_priority'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_text(Request $request)
    {
        $pren = Typo::select('uid', 'tx_mask_p_old_uid', 'tx_mask_p_casa', 'tx_mask_contatto_riferimento', 'tx_mask_cod_reservation_status', 'tx_mask_doc_inviati', 'tx_mask_p_data_arrivo', 'tx_mask_p_data_partenza', 'tx_mask_p_data_prenotazione', 'tx_mask_p_tot_ospiti',
            'tx_mask_p_under_12', 'tx_mask_p_culla', 'tx_mask_p_note_noi', 'tx_mask_p_sito', 'tx_mask_p_override_perc', 'tx_mask_p_perc_sito', 'tx_mask_p_perc_importo_fisso', 'header', 'tx_mask_t0_cognome', 'subheader', 'tx_mask_t0_lingua', 'tx_mask_t0_country', 'tx_mask_t0_sardegna',
            'tx_mask_t0_tel', 'tx_mask_t0_email', 'tx_mask_t0_newsletter', 'tx_mask_t0_fattura', 'tx_mask_t1_op_tipo_checkin', 'tx_mask_t1_op_chechin', 'tx_mask_t1_op_pulizie', 'tx_mask_t1_op_checkout', 'tx_mask_t1_op_cambio_biancheria', 'tx_mask_t1_ora_checkin', 'tx_mask_t1_ora_checkout', 'tx_mask_t1_op_note',
            'tx_mask_t1_ore_pulizie', 'tx_mask_t2_p_bianc', 'tx_mask_t2_p_cambi_l', 'tx_mask_t2_p_cambi_a', 'tx_mask_t2_p_cambi_aut', 'tx_mask_t2_p_metodo_b', 'tx_mask_t3_p_check_acconto', 'tx_mask_t3_p_stay','tx_mask_t3_p_s_chin', 'tx_mask_t3_p_s_b', 'tx_mask_t3_p_cleaning_fee_amount', 'tx_mask_t3_p_city_tax_amount', 'tx_mask_t3_p_s_chin',
            'tx_mask_t3_p_s_b', 'tx_mask_t3_p_s_checkout', 'tx_mask_t3_p_saldo_ric_b', 'tx_mask_t3_p_s_extra_checkin', 'tx_mask_t3_p_s_ex_checkout', 'tx_mask_t3_p_extra_p', 'tx_mask_t3_p_cw', 'tx_mask_t3_p_cw_sconto', 'tx_mask_t3_p_cash_simo', 'tx_mask_t3_p_cash_op_cout', 'tx_mask_t3_p_note_cont',
            'tx_mask_t4_test_email', 'tx_mask_t4_azioni', 'tx_mask_t5_kross_id', 'tx_mask_t5_kross_new', 'tx_mask_t5_kross_email', 'tx_mask_t5_kross_ota_id', 'tx_mask_t5_kross_cod_channel', 'tx_mask_t5_kross_ota_commissions_collected', 'tx_mask_t5_kross_payment_total_amount', 'tx_mask_t5_kross_cleaning_fee_amount',
            'tx_mask_t5_kross_city_tax_amount', 'tx_mask_t5_kross_other_extra_total_amount', 'tx_mask_t1_op_manutentore', 'tx_mask_t6_intervento_lastminute', 'tx_mask_t6_assistenza_interventol_lastminute', 'tx_mask_t2_p_c_extra_kit', 'tx_mask_t2_p_c_extra_b', 'tx_mask_p_token')
            ->where('uid', '=', $request->pren_uid)
            ->first();

        $site = $this->getSitesByKross($pren->tx_mask_t5_kross_cod_channel);

        if($pren->tx_mask_t5_kross_cod_channel == 'BE')
            $site = $this->getSitesByKross('MAIL');

        $flow_id = Flow::select('id')
            ->where('typeanswer_id', '=', $request->typeanswer_id)
            ->where('type_id', '=', $request->type_id)
            ->where('site_uid', '=', $site->uid)
            ->where('house_uid', '=', $pren->tx_mask_p_casa)
            ->first();

        $texts = FlowText::where('flow_id', '=', $flow_id->id)
            ->with('text', 'block', 'section')
            ->orderBy('block_id', 'asc')
            ->orderBy('section_id', 'asc')
            ->get();

        $testo='';

        foreach ($texts as $text){
            $text_operator_check = TextUser::where('text_id','=', $text->text->id)->get();
            if($request->language == 'IT'){
                $text = $text->text->testo;
            } else {
                $text = $text->text->text;
            }
            if(!$text_operator_check->isEmpty()){
                if(count($text_operator_check) > 1){
                    foreach ($text_operator_check as $text_operator) {
                        if($text_operator->user_uid == $pren->tx_mask_t1_op_chechin){
                            $testo .= '<p>'. $text .'</p>';
                        }
                    }
                } else {
                    if($text_operator_check->first()->user_uid == $pren->tx_mask_t1_op_chechin){
                        $testo .= '<p>'. $text .'</p>';
                    }
                }

            } else {
                $testo .= '<p>'. $text .'</p>';
            }
        }
        $testo = $this->replace_variables($pren, $testo, $request->language);

        return response()->json($testo);
    }

    public function refreshText(Request $request){

        if($request->ajax()){
            $pren = Typo::select('uid', 'tx_mask_p_old_uid', 'tx_mask_p_casa', 'tx_mask_contatto_riferimento', 'tx_mask_cod_reservation_status', 'tx_mask_doc_inviati', 'tx_mask_p_data_arrivo', 'tx_mask_p_data_partenza', 'tx_mask_p_data_prenotazione', 'tx_mask_p_tot_ospiti',
                'tx_mask_p_under_12', 'tx_mask_p_culla', 'tx_mask_p_note_noi', 'tx_mask_p_sito', 'tx_mask_p_override_perc', 'tx_mask_p_perc_sito', 'tx_mask_p_perc_importo_fisso', 'header', 'tx_mask_t0_cognome', 'subheader', 'tx_mask_t0_lingua', 'tx_mask_t0_country', 'tx_mask_t0_sardegna',
                'tx_mask_t0_tel', 'tx_mask_t0_email', 'tx_mask_t0_newsletter', 'tx_mask_t0_fattura', 'tx_mask_t1_op_tipo_checkin', 'tx_mask_t1_op_chechin', 'tx_mask_t1_op_pulizie', 'tx_mask_t1_op_checkout', 'tx_mask_t1_op_cambio_biancheria', 'tx_mask_t1_ora_checkin', 'tx_mask_t1_ora_checkout', 'tx_mask_t1_op_note',
                'tx_mask_t1_ore_pulizie', 'tx_mask_t2_p_bianc', 'tx_mask_t2_p_cambi_l', 'tx_mask_t2_p_cambi_a', 'tx_mask_t2_p_cambi_aut', 'tx_mask_t2_p_metodo_b', 'tx_mask_t3_p_check_acconto', 'tx_mask_t3_p_stay','tx_mask_t3_p_s_chin', 'tx_mask_t3_p_s_b', 'tx_mask_t3_p_cleaning_fee_amount', 'tx_mask_t3_p_city_tax_amount', 'tx_mask_t3_p_s_chin',
                'tx_mask_t3_p_s_b', 'tx_mask_t3_p_s_checkout', 'tx_mask_t3_p_saldo_ric_b', 'tx_mask_t3_p_s_extra_checkin', 'tx_mask_t3_p_s_ex_checkout', 'tx_mask_t3_p_extra_p', 'tx_mask_t3_p_cw', 'tx_mask_t3_p_cw_sconto', 'tx_mask_t3_p_cash_simo', 'tx_mask_t3_p_cash_op_cout', 'tx_mask_t3_p_note_cont',
                'tx_mask_t4_test_email', 'tx_mask_t4_azioni', 'tx_mask_t5_kross_id', 'tx_mask_t5_kross_new', 'tx_mask_t5_kross_email', 'tx_mask_t5_kross_ota_id', 'tx_mask_t5_kross_cod_channel', 'tx_mask_t5_kross_ota_commissions_collected', 'tx_mask_t5_kross_payment_total_amount', 'tx_mask_t5_kross_cleaning_fee_amount',
                'tx_mask_t5_kross_city_tax_amount', 'tx_mask_t5_kross_other_extra_total_amount', 'tx_mask_t1_op_manutentore', 'tx_mask_t6_intervento_lastminute', 'tx_mask_t6_assistenza_interventol_lastminute', 'tx_mask_t2_p_c_extra_kit', 'tx_mask_t2_p_c_extra_b', 'tx_mask_p_token')
                ->where('uid', '=', $request->pren_uid)
                ->first();
            $testo = $request->risposta_old;

            $testo = $this->replace_variables($pren, $testo, $request->language);

            return response()->json($testo);
        }

    }

    public function replace_variables($pren, $text, $language)
    {
        $testo = $text;
//        Dettagli Database esterno
        $pren_key = array_keys($pren->toArray());
        $house_typo = TypoHouses::select('uid', 'subheader', 'header', 'tx_mask_casa_type', 'tx_mask_casa_add', 'tx_mask_casa_citta', 'tx_mask_casa_key', 'tx_mask_casa_floor', 'tx_mask_casa_bagni', 'tx_mask_casa_torcioni', 'tx_mask_t0_casa_type_en', 'tx_mask_t0_casa_floor_en',
            'tx_mask_t1_op_gestore', 'tx_mask_t1_casa_gestore', 'tx_mask_t1_casa_gestore_email', 'tx_mask_t1_casa_gestore_tel', 'tx_mask_t2_wifi_linea', 'tx_mask_t2_wifi_pwd', 'tx_mask_t5_repeat_metodo', 'tx_mask_t6_def_checkin', 'tx_mask_t6_def_pulizie', 'tx_mask_t6_def_cambi',
            'tx_mask_t6_def_checkout', 'tx_mask_t3_casa_iban', 'tx_mask_t3_casa_note', 'tx_mask_t3_casa_cod_bidoni', 'tx_mask_t3_casa_codice_cond')
            ->where('uid', '=', $pren->tx_mask_p_casa)
            ->first();
        $house_typo_key = array_keys($house_typo->toArray());

        $users_typo = TypoUser::select(['uid', 'pid', 'usergroup', 'name', TypoUser::raw('CONCAT(fe_users.first_name, \' \',middle_name, \' \',last_name) as full_name'), 'telephone', 'email', 'company', 'tx_nv_ag_cod_op', 'tx_nv_ag_cod_op_excel', 'disable'])
            ->where('uid', '=', $pren->tx_mask_t1_op_chechin)
            ->first();
        $users_typo_key = array_keys($users_typo->toArray());

//        Dettagli Database interno
        $house = House::where('uid', '=', $pren->tx_mask_p_casa)->with('rooms:descrizione,description', 'bank')->firstOrFail();
        $house_key = array_keys($house->toArray());

        $users = Operator::find($pren->tx_mask_t1_op_chechin);
        $users_key = array_keys($users->toArray());

//        Tassa di soggiorno
        $data_arrivo = Carbon::parse($pren->tx_mask_p_data_arrivo);
        $data_partenza = Carbon::parse($pren->tx_mask_p_data_partenza);
        $giorni = $data_arrivo->diffInDays($data_partenza);
        $city_tax = CityTax::where('city_id','=',$house_typo->tx_mask_casa_citta)
            ->whereRaw('"'.$data_arrivo.'" BETWEEN mese_da AND mese_a')
            ->first();

        $cities = City::select('id', 'city')->pluck('city', 'id');

        if(Str::contains($testo, '*totaleTassa*')){
            $debit = $city_tax->debit/100;
            if($giorni >= $city_tax->notti_max){
                $totale_tassa = $city_tax->notti_max * $debit;
                $totale_tassa = $totale_tassa * $pren->tx_mask_p_tot_ospiti;
            } else {
                $totale_tassa = $giorni * $debit;
                $totale_tassa = $totale_tassa * $pren->tx_mask_p_tot_ospiti;
            }
            $testo = Str::replaceFirst('*totaleTassa*', number_format($totale_tassa,2) , $testo);
        }
        if(Str::contains($testo,'*casa*tx_mask_casa_bagni*')){
            if($house_typo['tx_mask_casa_bagni'] > 1){
                if($language != 'IT')
                    $testo = Str::replaceFirst('*casa*tx_mask_casa_bagni*', 'There are '. $house_typo['tx_mask_casa_bagni'] .' bathrooms' , $testo);
                $testo = Str::replaceFirst('*casa*tx_mask_casa_bagni*', 'Ci sono '. $house_typo['tx_mask_casa_bagni'] .' bagni' , $testo);
            } else {
                if($language != 'IT')
                    $testo = Str::replaceFirst('*casa*tx_mask_casa_bagni*', 'There is a bathroom', $testo);
                $testo = Str::replaceFirst('*casa*tx_mask_casa_bagni*', 'C\'è un bagno', $testo);
            }
        }
        if(Str::contains($testo,'*casa*tx_mask_casa_citta*')){
            $testo = Str::replaceFirst('*casa*tx_mask_casa_citta*', $cities[$house_typo['tx_mask_casa_citta']] , $testo);
        }
        if(Str::contains($testo,'*pren*tx_mask_p_token*')){
            if($language != 'IT')
                $testo = Str::replaceFirst('*pren*tx_mask_p_token*', '<a href="https://www.alguerhome.it/reservation/token/{'.$pren['tx_mask_p_token'].'}" target="_blank" class="btn btn-primary" role="button">Customer Page Link</a>' , $testo);
            $testo = Str::replaceFirst('*pren*tx_mask_p_token*', '<a href="https://www.alguerhome.it/reservation/token/{'.$pren['tx_mask_p_token'].'}" target="_blank" class="btn btn-primary" role="button">Link Pagina Cliente</a>' , $testo);
        }

        foreach ($pren_key as $key => $value){
            $value_to_search_pren = '*pren*'.$value.'*';

            if(Str::contains($testo, $value_to_search_pren)){
                $testo = str_replace($value_to_search_pren, $pren[$value] , $testo);
            }
        }

        foreach ($house_typo_key as $key => $value){
            $value_to_search_casa = '*casa*'.$value.'*';

            if(Str::contains($testo, $value_to_search_casa)){
                $testo = str_replace($value_to_search_casa, $house_typo[$value] , $testo);
            }
        }

        foreach ($users_typo_key as $key => $value){
            $value_to_search_user = '*user*'.$value.'*';

            if(Str::contains($testo, $value_to_search_user)){
                $testo = str_replace($value_to_search_user, $users_typo[$value] , $testo);
            }
        }

        foreach ($users_key as $key => $value){
            $value_to_search_oper = '*oper*'.$value.'*';

            if(Str::contains($testo, $value_to_search_oper)){
                $testo = str_replace($value_to_search_oper, $users[$value] , $testo);
            }
        }

        foreach ($house_key as $key => $value){
            $value_to_search_casa = '*casa*'.$value.'*';
            if($value === 'rooms'){
                if(count($house->rooms) > 1){
                    $i=1;
                    $and = ' e ';
                    if($language != 'IT') {
                        $and = ' and ';
                    }
                    $rooms = '';
                    foreach ($house->rooms as $room) {
                        if($i === count($house->rooms)){
                            $and = '';
                        } elseif($i > 1 && $i < count($house->rooms)){
                            $and = ', ';
                        }
                        if($language != 'IT') {
                            $rooms .= $room->description . $and;
                        } else {
                            $rooms .= $room->descrizione . $and;
                        }
                        $i++;
                    }
                    $testo = Str::replaceFirst($value_to_search_casa, $rooms , $testo);
                } else {
                    if($language != 'IT')
                        $testo = Str::replaceFirst($value_to_search_casa, $house->rooms->first()->description, $testo);
                    $testo = Str::replaceFirst($value_to_search_casa, $house->rooms->first()->descrizione, $testo);
                }
            } elseif ($value === 'bank'){
                foreach ($house->bank->toArray() as $key => $value){
                    $value_to_search_banca = '*banca*'.$key.'*';
                    $testo = Str::replaceFirst($value_to_search_banca, $value , $testo);
                }
            }

            if(Str::contains($testo, $value_to_search_casa)){
                $testo = str_replace($value_to_search_casa, $house[$value], $testo);
            }
        }

        return $testo;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function thread_exist(Request $request)
    {
        if($request->ajax()){
            $pren_uid = $request->pren_uid;

            $flow_id = Flow::with('typeanswer', 'type')
                ->where('typeanswer_id','=',$request->typeanswer_id)
                ->where('type_id','=',$request->type_id)
                ->where('site_uid','=',$request->site_uid)
                ->where('house_uid','=',$request->house_uid)
                ->first();

            $thread_exist = Thread::where('flow_id','=', $flow_id->id)
                ->where('uid', '=', $pren_uid)
                ->first();

            if($thread_exist){
                $thread = 1;
            } else {
                $thread = 0;
            }

            return response()->json($request);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $houses = $this->getHousesArray();
        $house = $houses[$request->house_uid];
        $data = [
            'text' => $request->risposta,
            'files' => $request->files,
            'email_from' => $request->email_from,
            'subject' => $request->subject,
            'house' => $house,

        ];

        $pren_uid = $request->pren_uid;

        $email_to = $request->email_to;

        $user = Auth::user();
        $user_id = $user->id;

        $flow_id = Flow::with('typeanswer', 'type')
            ->where('typeanswer_id','=',$request->typeanswer_id)
            ->where('type_id','=',$request->type_id)
            ->where('site_uid','=',$request->site_uid)
            ->where('house_uid','=',$request->house_uid)
            ->first();

        $title = '<strong>'.$flow_id->typeanswer->name.'</strong> <br> <u>'.$flow_id->type->name.'</u>';
        $testo = $request->risposta;

        Thread::create([
            'uid' => $pren_uid,
            'flow_id' => $flow_id->id,
            'user_id' => $user_id,
            'title' => $title,
            'testo' => $testo
        ]);

        Mail::to($email_to)->send(new AnswerMail($data));
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thread = Thread::with('user')->find($id);
        $thread_title = strip_tags($thread->title);
        return response()->json(['threads' => $thread, 'thread_title' => $thread_title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
