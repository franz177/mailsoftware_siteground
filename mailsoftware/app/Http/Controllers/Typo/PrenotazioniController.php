<?php

namespace App\Http\Controllers\Typo;

use App\Http\Controllers\Controller;
use App\Jobs\BookingSincronizationJob;
use App\Models\Booking;
use App\Models\Flow;
use App\Models\House;
use App\Models\Thread;
use App\Models\Typeanswer;
use App\Models\Typo;
use App\Models\TypoCountry;
use App\Models\TypoHouses;
use App\Models\TypoUser;
use App\Models\User;
use App\Models\Whatsapp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PrenotazioniController extends Controller
{

    protected $CType = 'mask_db_alg_pren';
    protected $users;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $today = Carbon::today();
        $today = $today->subDays(1);

        $page_title = 'Dashboard';
        $page_description = 'Prenotazioni';

        $houses = House::with('color')->get();
        $houses_color = $houses->pluck('color.colore_bg', 'uid');
        $houses_typo = $this->getHousesAbbrArray();
        $houses_gestore = $this->getHouseGestoreArray();
        $op_checkin = $this->getUsersArray();

        $sites_kross = $this->getSitesKross();
        $sites = $this->getSitesArray();

        $user = Auth::user();
        if($user->role != 1){
            $houses_user = User::with('houses')->find($user->id);
            $hs = $houses_user->houses->pluck('uid');
        } else {
            $houses_user = House::pluck('uid');
            $hs = $houses_user;
        }

        if ($request->ajax()){
            $this->users = $this->getAllUsersArray();
            $data = Booking::select('*')
                ->selectRaw('IF(tx_mask_t0_country = "" OR tx_mask_t0_country IS NULL, "NaN", tx_mask_t0_country) tx_mask_t0_country')
                ->selectRaw('LCASE(header) as headerl')
                ->selectRaw('IFNULL(tx_mask_p_sito, tx_mask_t5_kross_cod_channel) tx_mask_p_sito')
                ->selectRaw('IF(tx_mask_doc_inviati = 0, "Attesa", "INVIATI") as documenti')
                ->selectRaw('IFNULL(tx_mask_p_casa,0) casa')
//                ->where('CType', $this->CType)
                ->where('hidden', '=', 0)
                ->where('deleted', '=', 0)
                ->where('tx_mask_p_data_partenza', '>', $today)
                ->where('tx_mask_cod_reservation_status', '!=', "CANC")
                ->whereIn('tx_mask_p_casa', $hs)
                ->orderBy('tx_mask_p_data_arrivo', 'ASC')
                ->get();

            return Datatables::of($data)
                ->addColumn('gestore_casa', function($row){
                    if($row->tx_mask_contatto_riferimento > 0){
                        $contatto_riferimento = TypoUser::select('first_name')
                            ->where('uid', '=', $row->tx_mask_contatto_riferimento)
                            ->first();
                        return '<span class="font-weight-bolder">'. $contatto_riferimento->first_name  .'</span>';
                    } else {
                        return '<span class="font-weight-bolder">Seleziona Gestore</span>';
                    }
                })
                ->addColumn('city_tax', function ($row) {

                    return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_city_tax_amount, 2, ',', '.').'</span>';
                })
                ->addColumn('header', function ($row) {
                    if($row->tx_mask_t0_country != 'NaN'){
                        $country = $this->getCountriesArray($row->tx_mask_t0_country);
                        $country = $country->name;
                    } else {
                        $country = $row->tx_mask_t0_country;
                    }

                    $headerl = preg_replace('/(\([a-zA-Z0-9\s]+\)\s?)/', '', $row->headerl);

                    $header = '<a href="threads/create/'.$row->uid.'" data-toggle="tooltip"  data-id="' . $row->uid . '" data-original-title="Edit" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg text-capitalize text-left">' . $row->uid . ' - ' . $headerl . '</a>
                                <br>
                                <i class="icon-m text-dark-75 far fa-calendar-check"></i> '.$row->tx_mask_p_data_prenotazione.'
                                <i class="icon-m text-dark-75 fas fa-globe-europe"></i> ('.$country.')
                                <i class="icon-m text-dark-75 fas fa-users"></i> ('.$row->tx_mask_p_tot_ospiti.') <br>
                                <i class="icon-m text-dark-75 fas fa-phone-alt mt-3"></i> '.$row->tx_mask_t0_tel .'<br>
                                <i class="icon-m text-dark-75 fas fa-envelope mt-3"></i> '.$row->tx_mask_t0_email;

                    return $header;
                })
                ->addColumn('thread', function ($row) {
                    $threads = Thread::where('uid','=',$row->uid)->with('flow.typeanswer.color')->latest('created_at')->first();

                    if(!$threads){
                        $threads = 0;
                        return $threads;
                    }

                    return $threads->title;
                })
                ->addColumn('color', function ($row) {
                    $threads = Thread::where('uid','=',$row->uid)->with('flow.typeanswer.color')->latest('created_at')->first();

                    if(!$threads){
                        $threads = 0;
                        return $threads;
                    }

                    return $threads->flow->typeanswer->color->colore_bg;
                })
                ->addColumn('data_arrivo', function ($row){
                    $data = Carbon::createFromFormat('d-m-y', $row->tx_mask_p_data_arrivo)->format('d-m-Y');
                    $data_arrivo = array();
                    $data_arrivo["display"] = $data;
                    $data_arrivo["timestamp"] = strtotime($data);

                    return $data_arrivo;

                })
                ->addColumn('alert_booking_arrivo', function ($row){
                    $data = Carbon::createFromFormat('d-m-y', $row->tx_mask_p_data_arrivo)->format('Y-m-d');
                    $data_arrivo = Carbon::parse($data);
                    $today = Carbon::today();
                    $date_diff = $data_arrivo->diffInDays($today);
                    return $date_diff;

                })
                ->addColumn('data_partenza', function ($row){
                    $data = Carbon::createFromFormat('d-m-y', $row->tx_mask_p_data_partenza)->format('d-m-Y');
                    $data_partenza = array();
                    $data_partenza["display"] = $data;
                    $data_partenza["timestamp"] = strtotime($data);

                    return $data_partenza;

                })
                ->addColumn('alert_booking_partenza', function ($row){
                    $data = Carbon::createFromFormat('d-m-y', $row->tx_mask_p_data_partenza)->format('Y-m-d');
                    $data_arrivo = Carbon::parse($data);
                    $today = Carbon::today();
                    $date_diff = $data_arrivo->diffInDays($today);
                    return $date_diff;

                })
                ->addColumn('whatsapp_stato', function ($row) {
                    $whatsapp_status = Whatsapp::find($row->uid);

                    return $whatsapp_status->stato;
                })
                ->addColumn('whatsapp_id', function ($row) {
                    $whatsapp_id = Whatsapp::find($row->uid);

                    return $whatsapp_id->uid;
                })
                ->addColumn('op_pulizie', function($row){
                    $user = $this->users;

                    return $row->tx_mask_t1_op_pulizie ? $user[$row->tx_mask_t1_op_pulizie] : "NaN";
                })
                ->addColumn('op_check_out', function($row){
                    $user = $this->users;

                    return $row->tx_mask_t1_op_checkout ? $user[$row->tx_mask_t1_op_checkout] : "NaN";
                })
                ->addColumn('op_check_in', function($row){
                    $user = $this->users;

                    return $row->tx_mask_t1_op_chechin ? $user[$row->tx_mask_t1_op_chechin] : "NaN";
                })
                ->addColumn('cambi', function ($row) {

                    $operatore_cambio = $row->tx_mask_t1_op_cambio_biancheria ?  $row->tx_mask_t1_op_cambio_biancheria : 19;

                    $lenzuola = '';
                    $asciugamani = '';
                    $costo = '';
                    $icon = '';
                    $operatore_nome = null;

                    if($row->tx_mask_t2_p_cambi_l > 0 || $row->tx_mask_t2_p_cambi_a > 0)
                        $icon = '<i class="fa fa-exclamation text-warning" aria-hidden="true"></i>';

                    if($row->tx_mask_t2_p_cambi_l > 0)
                        $lenzuola = $row->tx_mask_t2_p_cambi_l.' Len';

                    if($row->tx_mask_t2_p_cambi_a > 0)
                        $asciugamani = $row->tx_mask_t2_p_cambi_a .' Asc';

                    if($row->costi_costo_cambi > 0) {
                        $costo = '[<span class="">€ ' . number_format($row->costi_costo_cambi, 2, ',', '.') . '</span>]';
                        $operatore_nome = TypoUser::select('first_name')
                            ->where('uid', '=', $operatore_cambio)
                            ->first();

                        $operatore_nome = $operatore_nome->first_name;
                    }

                    $header = '<p> '.$icon.' '.$lenzuola.' '.$asciugamani.' <br> '.$costo.' '. $operatore_nome .' </p>';

                    return $header;
                })
                ->addColumn('kit_base', function ($row){
                    $kit_base = '<p class="text-danger text-uppercase">Selezionare Biancheria su Typo3</p>';
                    if($row->tx_mask_t2_p_bianc){
                        $typo_el_bianc = Typo::select('uid','header', 'subheader', 'tx_mask_bianc_tradit', 'tx_mask_bianc_traden', 'tx_mask_t1_bianc_qy_m', 'tx_mask_t1_bianc_qy_s', 'tx_mask_t1_bianc_qy_ba', 'tx_mask_t1_bianc_qy_v', 'tx_mask_t1_bianc_qy_f', 'tx_mask_t1_bianc_qy_bi')
                            ->where('Ctype', 'mask_db_alg_el_bianc')
                            ->where('uid',$row->tx_mask_t2_p_bianc)
                            ->first();

                        $kit_base = $typo_el_bianc->header;
                    }

                    return $kit_base;
                })
                ->addColumn('importo_stay', function ($row){
                    return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_stay, 2, ',', '.').'</span>';
                })
                ->addColumn('threads', function ($row) {
                    $threads_pren = Thread::where('uid','=',$row->uid)->with('user','flow', 'flow.typeanswer', 'flow.typeanswer.color')->orderBy('created_at', 'ASC')->get();
                    $threads = '';

                    if($threads_pren->count() < 1) {
                        $threads = 'Nessun testo inviato';
                        return $threads;
                    } else {
                        $threads = '<div class="row"><div class="col-sm-12"><div class="card card-custom card-stretch gutter-b"><div class="card-body pt-8">';
                        foreach ($threads_pren as $thread){
                            $threads .= '
                                <div class="d-flex flex-wrap align-items-center mb-10">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-20 symbol-'. $thread->flow->typeanswer->color->colore_bg .' mr-5">
                                        <span class="symbol-label"> </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column ml-4 flex-grow-1 mr-2">
                                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$thread->id.'" data-original-title="Edit" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1 showThread">'. strip_tags($thread->title) .'</a>
                                        <span class="text-muted font-weight-bold">'.$thread->user->name.' '.$thread->user->lastname.'</span>
                                    </div>
                                    <!--end::Text-->
                                    <span class="label label-lg label-light-warning label-inline mt-lg-0 mb-lg-0 my-2 font-weight-bold py-4">'.$thread->created_at.'</span>
                                </div>
                            ';
                        }
                        $threads .= '</div></div></div></div>';
                        return $threads;
                    }
                })
                ->addColumn('extra_checkout', function ($row){
                    return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_s_checkout, 2, ',', '.').'</span>';
                })
                ->addColumn('saldo_cash_cin', function ($row){
                    return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_s_chin, 2, ',', '.').'</span>';
                })
                ->addColumn('extra_kit', function ($row){
                    return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t2_p_c_extra_kit, 2, ',', '.').'</span>';
                })
                ->addColumn('extra_biancheria', function ($row){
                    return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t2_p_c_extra_b, 2, ',', '.').'</span>';
                })
                ->rawColumns([
                    'gestore_casa','city_tax', 'header', 'thread', 'color', 'whatsapp_id', 'whatsapp_stato',
                    'cambi', 'op_pulizie', 'op_check_out', 'op_check_in', 'threads', 'data_arrivo', 'data_partenza',
                    'kit_base', 'importo_stay', 'extra_checkout', 'alert_booking_arrivo', 'alert_booking_partenza', 'saldo_cash_cin', 'extra_kit', 'extra_biancheria'
                ])
                ->make(true);
        }

        $pren = Booking::select('uid', 'tx_mask_t5_kross_cod_channel', 'tx_mask_p_casa')
//            ->where('CType', $this->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->where('tx_mask_p_data_arrivo', '>=', $today)
            ->where('tx_mask_cod_reservation_status', '!=', "CANC")
            ->get();


        // Inserimento per nuove prenotazioni
        foreach ($pren as $p) {
            // Inserisco a DB i valori Whatsapp per le nuove prenotazioni arrivate
            $in_db_whatsapp = Whatsapp::find($p->uid);
            if(!$in_db_whatsapp){
                Whatsapp::create([
                    'uid' => $p->uid,
                    'stato' => -1,
                ]);
            }

            // Inserisco a DB il Thread First Contact Prenotazione Immediata per le prenotazioni con canale BK nella tabella THREADS per le nuove prenotazioni arrivate
            if($p->tx_mask_t5_kross_cod_channel){
                $site_typo = $this->getSitesByKross($p->tx_mask_t5_kross_cod_channel);
                $site_uid = 47;
                if($site_typo)
                    $site_uid = $site_typo->uid;

                $flow = Flow::select('id')
                    ->where('typeanswer_id', '=', 1)
                    ->where('type_id', '=', 2)
                    ->where('site_uid', '=', $site_uid)
                    ->where('house_uid', '=', $p->tx_mask_p_casa)
                    ->first();

                $thread_exist = Thread::where('uid', '=', $p->uid)
                    ->where('flow_id', '=', $flow->id)
                    ->first();

                if(!$thread_exist){
                    Thread::create([
                        'uid' => $p->uid,
                        'flow_id' => $flow->id,
                        'user_id' => 3,
                        'title' => '<strong>First Contact </strong><br>da <u>KROSS</u>',
                        'testo' => 'Mail inviata direttamente tramite il KROSS'
                    ]);
                }

            }
        }

        return view('frontend.index')
            ->with(compact('page_title'))
            ->with(compact('page_description'))
            ->with(compact('pren'))
            ->with(compact('houses_color'))
            ->with(compact('houses_typo'))
            ->with(compact('houses_gestore'))
            ->with(compact('sites_kross'))
            ->with(compact('sites'))
            ->with(compact('op_checkin'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prenotazione = Typo::find($id);

        $typeanswers = Typeanswer::all();

        return view('frontend.show')
            ->with(compact('prenotazione'))
            ->with(compact('typeanswers'));
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
