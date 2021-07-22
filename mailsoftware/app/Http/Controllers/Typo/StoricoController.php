<?php

namespace App\Http\Controllers\Typo;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Thread;
use App\Models\Typo;
use App\Models\Whatsapp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StoricoController extends Controller
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
        $page_description = 'Storico';

        $houses = House::with('color')->get();
        $houses_color = $houses->pluck('color.colore_bg', 'uid');
        $houses_typo = $this->getHousesAbbrArray();
        $houses_gestore = $this->getHouseGestoreArray();
        $op_checkin = $this->getUsersArray();

        $sites_kross = $this->getSitesKross();

        if ($request->ajax()){
            $data = Typo::select(['tt_content.uid', 'tt_content.tx_mask_p_data_arrivo', 'tt_content.tx_mask_p_data_partenza', 'tt_content.tx_mask_p_data_prenotazione', 'tx_mask_cod_reservation_status', 'tt_content.tx_mask_t0_tel',
                Typo::raw('IF(tt_content.tx_mask_p_tot_ospiti = "", "0",tx_mask_p_tot_ospiti) as tx_mask_p_tot_ospiti'),
                Typo::raw('(CASE WHEN tx_mask_t0_country IS NULL THEN "NaN" WHEN tx_mask_t0_country = "" THEN "NaN" ELSE tx_mask_t0_country END) as tx_mask_t0_country'),
                Typo::raw('LCASE(tt_content.header) as headerl'),
                Typo::raw('tt_content.tx_mask_t5_kross_cod_channel as sito'),
                Typo::raw('IF(tt_content.tx_mask_doc_inviati = 0, "Attesa", "INVIATI") as documenti'),
                Typo::raw('IFNULL(tt_content.tx_mask_p_casa,0) casa')])
                ->where('tt_content.CType', $this->CType)
                ->where('tt_content.hidden', '=', 0)
                ->where('tt_content.deleted', '=', 0)
                ->where('tt_content.tx_mask_p_data_partenza', '<', $today)
                ->orderBy('tt_content.tx_mask_p_data_arrivo', 'DESC')
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


                    $header = '<a href="#" data-toggle="tooltip"  data-id="' . $row->uid . '" data-original-title="Edit" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg text-capitalize text-left">' . $row->headerl . '</a>
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
                ->addColumn('stato', function ($row) {
                    $stato = '';
                    if(!empty($row->tx_mask_cod_reservation_status)) {
                        $stato = $row->tx_mask_cod_reservation_status;
                    }

                    return $stato;
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
                ->rawColumns(['uid', 'header', 'thread', 'color', 'whatsapp_id', 'whatsapp_stato', 'threads', 'stato'])
                ->make(true);
        }

        $pren = Typo::select('uid', 'tx_mask_t5_kross_cod_channel', 'tx_mask_p_casa')
            ->where('tt_content.CType', $this->CType)
            ->where('tt_content.hidden', '=', 0)
            ->where('tt_content.deleted', '=', 0)
            ->where('tt_content.tx_mask_p_data_arrivo', '<', $today)
            ->get();

        $count_pren = Typo::select([
            Typo::raw('COUNT(IF(tx_mask_cod_reservation_status = "CONF",1,NULL))  CONF'),
            Typo::raw('COUNT(IF(tx_mask_cod_reservation_status = "WAIT",1,NULL))  WAIT'),
            Typo::raw('COUNT(IF(tx_mask_cod_reservation_status = "CANC",1,NULL))  CANC'),
        ])
            ->where('tt_content.tx_mask_p_data_arrivo', '<', $today)
            ->first();

        return view('frontend.storico.index')
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
        return view('frontend.storico.show')
            ->with('typo', Typo::where('tx_mask_p_old_uid', $id)->firstOrFail());
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
