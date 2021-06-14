<?php

namespace App\Http\Controllers\Typo;

use App\Http\Controllers\Controller;
use App\Models\Flow;
use App\Models\House;
use App\Models\Thread;
use App\Models\Typeanswer;
use App\Models\Typo;
use App\Models\TypoCountry;
use App\Models\TypoHouses;
use App\Models\User;
use App\Models\Whatsapp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PrenotazioniController extends Controller
{

    protected $CType = 'mask_db_alg_pren';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $today = Carbon::now();

        $page_title = 'Dashboard';
        $page_description = 'Prenotazioni';

        $houses = House::with('color')->get();
        $houses_color = $houses->pluck('color.colore_bg', 'uid');
        $houses_typo = $this->getHousesAbbrArray();
        $houses_gestore = $this->getHouseGestoreArray();
        $op_checkin = $this->getUsersArray();

        $sites_kross = $this->getSitesKross();

        $user = Auth::user();
        if($user->role != 1){
            $houses_user = User::with('houses')->find($user->id);
            $hs = $houses_user->houses->pluck('uid');
        } else {
            $houses_user = House::pluck('uid');
            $hs = $houses_user;
        }

        if ($request->ajax()){
            $data = Typo::select(['tt_content.uid', 'tt_content.tx_mask_p_tot_ospiti', 'tt_content.tx_mask_p_data_arrivo', 'tt_content.tx_mask_p_data_partenza', 'tt_content.tx_mask_p_data_prenotazione', 'tt_content.tx_mask_t1_op_chechin', 'tt_content.tx_mask_t0_tel',
                Typo::raw('IFNULL(tx_mask_t0_country, "NaN") tx_mask_t0_country'),
                Typo::raw('LCASE(tt_content.header) as headerl'),
                Typo::raw('tt_content.tx_mask_t5_kross_cod_channel as sito'),
                Typo::raw('IF(tt_content.tx_mask_doc_inviati = 0, "Attesa", "INVIATI") as documenti'),
                Typo::raw('IFNULL(tt_content.tx_mask_p_casa,0) casa')])
                ->where('tt_content.CType', $this->CType)
                ->where('tt_content.hidden', '=', 0)
                ->where('tt_content.deleted', '=', 0)
                ->where('tt_content.tx_mask_p_data_partenza', '>=', $today)
                ->where('tt_content.tx_mask_cod_reservation_status', '!=', "CANC")
                ->whereIn('tt_content.tx_mask_p_casa', $hs)
                ->orderBy('tt_content.tx_mask_p_data_arrivo', 'ASC')
                ->get();

            return Datatables::of($data)
                ->addColumn('uid', function ($row) {
                    $uid = '<a href="threads/create/'.$row->uid.'" data-toggle="tooltip"  data-id="' . $row->uid . '" data-original-title="uid" class="font-weight-bolder text-hover-primary mb-1 font-size-lg">' . $row->uid . '</a>';

                    return $uid;
                })
                ->addColumn('header', function ($row) {
                    if($row->tx_mask_t0_country != 'NaN'){
                        $country = $this->getCountriesArray($row->tx_mask_t0_country);
                        $country = $country->name;
                    } else {
                        $country = $row->tx_mask_t0_country;
                    }


                    $header = '<a href="threads/create/'.$row->uid.'" data-toggle="tooltip"  data-id="' . $row->uid . '" data-original-title="Edit" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg text-capitalize text-left">' . $row->headerl . '</a>
                                <br>
                                <i class="icon-m text-dark-75 far fa-calendar-check"></i> '.$row->tx_mask_p_data_prenotazione.'
                                <i class="icon-m text-dark-75 fas fa-globe-europe"></i> ('.$country.')
                                <i class="icon-m text-dark-75 fas fa-users"></i> ('.$row->tx_mask_p_tot_ospiti.') <br>
                                <i class="icon-m text-dark-75 fas fa-phone-alt mt-3"></i> '.$row->tx_mask_t0_tel;

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
                ->addColumn('whatsapp_stato', function ($row) {
                    $whatsapp_status = Whatsapp::find($row->uid);

                    return $whatsapp_status->stato;
                })
                ->addColumn('whatsapp_id', function ($row) {
                    $whatsapp_id = Whatsapp::find($row->uid);

                    return $whatsapp_id->uid;
                })
                ->addColumn('threads', function ($row) {
                    $threads_pren = Thread::where('uid','=',$row->uid)->with('user','flow', 'flow.typeanswer', 'flow.typeanswer.color')->get();
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
                ->rawColumns(['uid', 'header', 'thread', 'color', 'whatsapp_id', 'whatsapp_stato', 'threads'])
                ->make(true);
        }

        $pren = Typo::select('uid', 'tx_mask_t5_kross_cod_channel', 'tx_mask_p_casa')
            ->where('tt_content.CType', $this->CType)
            ->where('tt_content.hidden', '=', 0)
            ->where('tt_content.deleted', '=', 0)
            ->where('tt_content.tx_mask_p_data_arrivo', '>=', $today)
            ->where('tt_content.tx_mask_cod_reservation_status', '!=', "CANC")
            ->get();

        $count_pren = Typo::select([
                Typo::raw('COUNT(IF(tx_mask_cod_reservation_status = "CONF",1,NULL))  CONF'),
                Typo::raw('COUNT(IF(tx_mask_cod_reservation_status = "WAIT",1,NULL))  WAIT'),
                Typo::raw('COUNT(IF(tx_mask_cod_reservation_status = "CANC",1,NULL))  CANC'),
                ])
            ->where('tt_content.tx_mask_p_data_arrivo', '>=', $today)
            ->first();

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

            if($p->tx_mask_t5_kross_cod_channel == 'BOOKING'){
                $site_typo = $this->getSitesByKross($p->tx_mask_t5_kross_cod_channel);
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
                        'title' => '<strong>First Contact </strong><br>da <u>Booking</u>',
                        'testo' => 'Mail inviata direttamente tramite il sito Booking'
                    ]);
                }

            }
        }

        return view('frontend.index')
            ->with(compact('page_title'))
            ->with(compact('page_description'))
            ->with(compact('pren'))
            ->with(compact('count_pren'))
            ->with(compact('houses_color'))
            ->with(compact('houses_typo'))
            ->with(compact('houses_gestore'))
            ->with(compact('sites_kross'))
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
