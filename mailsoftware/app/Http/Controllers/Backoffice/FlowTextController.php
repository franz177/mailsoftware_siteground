<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Flow;
use App\Models\FlowText;
use App\Models\Priority;
use App\Models\Section;
use App\Models\Text;
use App\Models\Type;
use App\Models\Typeanswer;
use App\Models\Typo;
use App\Models\TypoHouses;
use App\Models\TypoSite;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FlowTextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $typeanswers = Typeanswer::all();
        $types = Type::all();

        $typo_s = new TypoSite;
        $sites = TypoSite::select('uid', 'tx_mask_siti_abbr as name', 'tx_mask_siti_perc as percentuale')
            ->where('CType', $typo_s->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->orderBy('uid')->get();

        $typo_h = new TypoHouses;
        $houses = TypoHouses::select(['uid', TypoHouses::raw('CONCAT(subheader, \' \', header) as name')])
            ->where('CType', $typo_h->CType)
            ->where('deleted', '=', 0)
            ->whereIn('uid', array(1,3,4,5,6,7,8))
            ->get();

        $blocks = Block::all();
        $sections = Section::all();

        $turn = 0;

        if($request->turn > 0){

            $flow = Flow::select('id')
                ->where('typeanswer_id', '=', $request->typeanswer_id)
                ->where('type_id', '=', $request->type_id)
                ->where('site_uid', '=', $request->site_uid)
                ->where('house_uid', '=', $request->house_uid)
                ->get();

            $typeanswer_id = $request->typeanswer_id;
            $type_id = $request->type_id;
            $site_uid = $request->site_uid;
            $house_uid = $request->house_uid;

            $flow_texts = FlowText::where('flow_id', '=', $flow->first()->id)
                ->with('flow')
                ->with('text')
                ->with('block')
                ->with('section')
                ->orderBy('block_id', 'asc')
                ->orderBy('section_id', 'asc')
                ->get();
            $turn = 1;



            return view('backend.flusso_testi.index')
                ->with(compact('flow_texts'))
                ->with(compact('typeanswer_id'))
                ->with(compact('type_id'))
                ->with(compact('site_uid'))
                ->with(compact('house_uid'))
                ->with(compact('typeanswers'))
                ->with(compact('types'))
                ->with(compact('sites'))
                ->with(compact('houses'))
                ->with(compact('turn'))
                ->with(compact('blocks'))
                ->with(compact('sections'));
        } else {
            $flow_texts = FlowText::with('flow')
                ->with('text')
                ->with('block')
                ->with('section')
                ->groupBy('text_id')
                ->orderBy('block_id', 'asc')
                ->orderBy('section_id', 'asc')
                ->get();


            $blocks = Block::all();
            $sections = Section::all();
            $typeanswer_id = 0;
            $type_id = 0;
            $site_uid = 0;
            $house_uid = 0;
            $turn = 1;
            return view('backend.flusso_testi.index')
                ->with(compact('flow_texts'))
                ->with(compact('typeanswer_id'))
                ->with(compact('type_id'))
                ->with(compact('site_uid'))
                ->with(compact('house_uid'))
                ->with(compact('typeanswers'))
                ->with(compact('types'))
                ->with(compact('blocks'))
                ->with(compact('sections'))
                ->with(compact('houses'))
                ->with(compact('sites'))
                ->with(compact('turn'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getFlowTextIndex(Request $request)
    {
        $link_disabled ='';
        if ($request->ajax() && !$request->input('typeanswer_id')) {
            $flow_texts = FlowText::with('flow')
                ->with('text')
                ->with('block')
                ->with('section')
                ->with('text.priority')
                ->groupBy('text_id')
                ->orderBy('block_id', 'asc')
                ->orderBy('section_id', 'asc')
                ->get();


        } else {
            $flow = Flow::select('id')
                ->where('typeanswer_id', '=', $request->input('typeanswer_id'))
                ->where('type_id', '=', $request->input('type_id'))
                ->where('site_uid', '=', $request->input('site_uid'))
                ->where('house_uid', '=', $request->input('house_uid'))
                ->get();

            $flow_texts = FlowText::where('flow_id', '=', $flow->first()->id)
                ->with('text')
                ->with('block')
                ->with('section')
                ->with('text.priority')
                ->orderBy('block_id', 'asc')
                ->orderBy('section_id', 'asc')
                ->get();
        }

        return DataTables::of($flow_texts)
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-link-warning btn-sm font-weight-bolder font-size-sm editBlockSection">Edit Blocco/Sezione</a>';

                return $btn;
            })
            ->addColumn('testo_name', function ($row) {
                $link = '<a href="/backend/testi/' . $row->text->id . '" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' . $row->text->name . '</a>';
                return $link;
            })
            ->rawColumns(['action', 'testo_name'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function perview_text(Request $request)
    {
        $flow_id = Flow::select('id')
            ->where('typeanswer_id', '=', $request->typeanswer_id)
            ->where('type_id', '=', $request->type_id)
            ->first();

        $preview_texts = FlowText::where('flow_id', '=', $flow_id->id)
            ->with('text', 'block', 'section')
            ->orderBy('block_id', 'asc')
            ->orderBy('section_id', 'asc')
            ->get();

        return response()->json($preview_texts);
    }

    public function types(Request $request)
    {
        $types = Type::join('flows', 'types.id', '=', 'flows.type_id')
            ->join('typeanswers', 'flows.typeanswer_id', '=', 'typeanswers.id')
            ->select('types.id', 'types.name')
            ->where('flows.typeanswer_id', '=', $request->typeanswer_id)
            ->groupBy('types.id', 'types.name')
            ->get();

        return response()->json($types);
    }

    public function types_answer(Request $request)
    {
        $pren = Typo::find($request->pren_uid);

        $site = $this->getSitesByKross($pren->tx_mask_t5_kross_cod_channel);

        if($pren->tx_mask_t5_kross_cod_channel == 'BE')
            $site = $this->getSitesByKross('MAIL');

        $types = Flow::with('type')
            ->where('flows.typeanswer_id', '=', $request->typeanswer_id)
            ->where('flows.site_uid', '=', $site->uid)
            ->where('flows.house_uid', '=', $pren->tx_mask_p_casa)
            ->get();

        return response()->json($types);
    }

    public function sites(Request $request)
    {
        $typo_s = new TypoSite;

        $flow_sites = Flow::select('site_uid')
            ->where('typeanswer_id', '=', $request->typeanswer_id)
            ->where('type_id', '=', $request->type_id)
            ->groupBy('site_uid')
            ->get();

        $sites_list = array();
        $i=0;
        foreach ($flow_sites as $flow_site)
        {
            $sites_list[$i] = $flow_site->site_uid;
            $i++;
        }

        $sites = TypoSite::select('uid', 'tx_mask_siti_abbr as name', 'tx_mask_siti_perc as percentuale')
            ->where('CType', $typo_s->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->whereIn('uid', $sites_list)
            ->orderBy('uid')
            ->get();

        return response()->json($sites);
    }

    public function houses(Request $request)
    {
        $typo_h = new TypoHouses;

        $flow_houses = Flow::select('house_uid')
            ->where('typeanswer_id', '=', $request->typeanswer_id)
            ->where('type_id', '=', $request->type_id)
            ->where('site_uid', '=', $request->site_uid)
            ->groupBy('house_uid')
            ->get();

        $houses_list = array();
        $i=0;
        foreach ($flow_houses as $flow_house){
            $houses_list[$i] = $flow_house->house_uid;
            $i++;
        }

        $houses = TypoHouses::select('uid', 'subheader as name')
            ->where('CType', $typo_h->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->whereIn('uid', $houses_list)
            ->orderBy('uid')
            ->get();

        return response()->json($houses);

    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getFlussoTesti(Request $request)
    {
        $flow = Flow::select('id')
            ->where('typeanswer_id', '=', $request->typeanswer_id)
            ->where('type_id', '=', $request->type_id)
            ->where('site_uid', '=', $request->site_uid)
            ->where('house_uid', '=', $request->house_uid)
            ->get();

        $typeanswer_id = $request->typeanswer_id;
        $type_id = $request->type_id;
        $site_uid = $request->site_uid;
        $house_uid = $request->house_uid;

        $flow_texts = FlowText::where('flow_id', '=', $flow->first()->id)
            ->with('flow')
            ->with('text')
            ->with('block')
            ->with('section')
            ->get();

        $typeanswers = Typeanswer::all();
        $types = Type::all();

        $typo_s = new TypoSite;
        $sites = TypoSite::select('uid', 'tx_mask_siti_abbr as name', 'tx_mask_siti_perc as percentuale')
            ->where('CType', $typo_s->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->orderBy('uid')->get();

        $typo_h = new TypoHouses;
        $houses = TypoHouses::select(['uid', TypoHouses::raw('CONCAT(subheader, \' \', header) as name')])
            ->where('CType', $typo_h->CType)
            ->where('deleted', '=', 0)
            ->whereIn('uid', array(1,3,4,5,6,7,8))
            ->get();

        return view('backend.flusso_testi.show')
            ->with(compact('flow_texts'))
            ->with(compact('typeanswer_id'))
            ->with(compact('type_id'))
            ->with(compact('site_uid'))
            ->with(compact('house_uid'))
            ->with(compact('typeanswers'))
            ->with(compact('types'))
            ->with(compact('sites'))
            ->with(compact('houses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getFlussiTesto(Request $request)
    {
//        $flussi_testo = FlowText::where('text_id','=',74)
//            ->with('block', 'section', 'flow.typeanswer:id,name,sorting', 'flow.type:id,name,sorting')
//            ->get();
//
//        return response()->json($flussi_testo);


        if ($request->ajax()) {
            $flussi_testo = FlowText::where('text_id','=',$request->text_id)
                ->with('block', 'section', 'flow.typeanswer:id,name,sorting', 'flow.type:id,name,sorting');

            return DataTables::of($flussi_testo)
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-link-warning btn-sm font-weight-bolder font-size-sm editFlowText">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-link-danger btn-sm font-weight-bolder font-size-sm deleteFlowText">Delete</a>';

                    return $btn;
                })
                ->addColumn('tiporisposta', function($row){
                    return $row->flow->typeanswer->name;
                })
                ->addColumn('modello', function($row){
                    return $row->flow->type->name;
                })
                ->rawColumns(['action'])
                ->make(true);

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $text_id
     * @return \Illuminate\Http\Response
     */
    public function create($text_id)
    {
        $text = Text::find($text_id);
        $typeanswers = Typeanswer::all();
        $blocks = Block::all();
        $sections = Section::all();

        $sites = $this->getSites();

        $houses = $this->getHouses();

        return view('backend.flusso_testi.create')
            ->with(compact('text'))
            ->with(compact('typeanswers'))
            ->with(compact('blocks'))
            ->with(compact('sections'))
            ->with(compact('sites'))
            ->with(compact('houses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $typeanswer_id = $request->typeanswer_id;
        $type_id = $request->type_id;
        $site_uids = $request->site_uid;
        $house_uids = $request->house_uid;

        $text_id = $request->text_id;
        $block_id = $request->block_id;
        $section_id = $request->section_id;

        $text = Text::find($text_id);
        $success = 0;
        $message_success = '';
        $warning = 0;
        $message_warning = '';

        $houses = $this->getHousesArray();
        $sites = $this->getSitesArray();

        if(!$request->has('type_id')){
            $flows = Flow::where('typeanswer_id', '=', $typeanswer_id)
                ->with('typeanswer')
                ->get();

            foreach ($flows as $flow){
                $flow_text_exist = FlowText::where('flow_id', '=', $flow->id)
                    ->where('text_id', '=', $text_id)
                    ->first();

                if($flow_text_exist == NULL){
                    FlowText::create([
                        'flow_id' =>  $flow->id,
                        'text_id' => $text_id,
                        'block_id' => $block_id,
                        'section_id' => $section_id,
                    ]);
                    $success ++;
                } else {
                    $warning ++;
                }
            }

            if($warning > 0){
                return redirect('/backend/testi/'. $text_id.'/edit')
                    ->with('message_success', 'Testo '. $text->name.' associato correttamente al Tipo Risposta '. $flows->first()->typeanswer->name .' e a tutti i Modelli, Siti e Case ad esso associati per un totale di' .$success .' righe.')
                    ->with('message_warning', 'Testo già presente per il '. $text->name.' per un totale di ' .$warning .' righe.') ;
            } else {
                return redirect('/backend/testi/'. $text_id.'/edit')
                    ->with('message_success', 'Testo '. $text->name.' associato correttamente al Tipo Risposta '. $flows->first()->typeanswer->name .' e a tutti i Modelli, Siti e Case ad esso associati per un totale di' .$success .' righe.') ;
            }

        } elseif(!$request->has('site_uid')){
            $site_uid_old= 0;
            $i = 0;
            $n = 0;
            $flows = Flow::where('typeanswer_id', '=', $typeanswer_id)
                ->where('type_id', '=', $type_id)
                ->with('typeanswer', 'type')
                ->get();

            foreach ($flows as $flow){

                $flow_text_exist = FlowText::where('flow_id', '=', $flow->id)
                    ->where('text_id', '=', $text_id)
                    ->first();

                if($flow_text_exist == NULL){
                    FlowText::create([
                        'flow_id' =>  $flow->id,
                        'text_id' => $text_id,
                        'block_id' => $block_id,
                        'section_id' => $section_id,
                    ]);

                    if($i === 0) {
                        $success ++;
                        $message_success_b = '<li> ' . $houses[$flow->house_uid] .'</li>';
                        $i ++;
                    } elseif($flow->site_uid === $site_uid_old){
                        $success ++;
                        $message_success_b .= '<li> ' . $houses[$flow->house_uid] .'</li>';
                    } else {
                        $message_success .= '<p> Testo associato correttamente al Tipo Risposta '. $flow->typeanswer->name .', al Modello '. $flow->type->name .' e al Sito '. $sites[$flow->site_uid] .'<ul>'.$message_success_b. '</ul> <p> per un totale di ' .$success .' righe.</p>';
                        $message_success_b = '<li> ' . $houses[$flow->house_uid] .'</li>';
                        $success = 1;
                    }

                } else {
                    if($n === 0) {
                        $warning ++;
                        $message_warning_b = '<li> ' . $houses[$flow->house_uid] .'</li>';
                        $n ++;
                    } elseif($flow->site_uid === $site_uid_old){
                        $warning ++;
                        $message_warning_b .= '<li> ' . $houses[$flow->house_uid] .'</li>';
                    } else {
                        $message_warning .= '<p> Testo associato correttamente al Tipo Risposta '. $flow->typeanswer->name .', al Modello '. $flow->type->name .' e al Sito '. $sites[$flow->site_uid] .'<ul>'.$message_success_b. '</ul> <p> per un totale di ' .$success .' righe.</p>';
                        $message_warning_b = '<li> ' . $houses[$flow->house_uid] .'</li>';
                        $warning = 1;
                    }
                }
                $site_uid_old = $flow->site_uid;
            }

        } elseif(!$request->has('house_uid')){
            $sites = $this->getSitesArray();

            foreach ($request->site_uid as $site_uid){
                $message_success_h = ''; $message_success_b = ''; $message_success_f = ''; $success = 0;
                $message_warning_h = ''; $message_warning_b = ''; $message_warning_f = ''; $warning = 0;
                $flows = Flow::where('typeanswer_id', '=', $typeanswer_id)
                    ->where('type_id', '=', $type_id)
                    ->where('site_uid', '=', $site_uid)
                    ->with('typeanswer', 'type')
                    ->get();

                foreach ($flows as $flow){
                    $flow_text_exist = FlowText::where('flow_id', '=', $flow->id)
                        ->where('text_id', '=', $text_id)
                        ->first();

                    if($flow_text_exist == NULL){
                        FlowText::create([
                            'flow_id' =>  $flow->id,
                            'text_id' => $text_id,
                            'block_id' => $block_id,
                            'section_id' => $section_id,
                        ]);
                        $success ++;
                        $message_success_b .= '<li> ' . $houses[$flow->house_uid] .'</li>';
                    } else {
                        $warning ++;
                        $message_warning_b .= '<li>' .$houses[$flow->house_uid] .'</li>';
                    }
                }
                $message_success_h .= '<p> Testo associato correttamente al Tipo Risposta '. $flow->typeanswer->name .', al Modello '. $flow->type->name .' e al Sito '. $sites[$flow->site_uid] .'<ul>';
                $message_warning_h .= '<p> Testo già associato al Tipo Risposta '. $flow->typeanswer->name .', al Modello '. $flow->type->name .' e al Sito '. $sites[$flow->site_uid] .'<ul>';

                $message_success_f .= '</ul> <p> per un totale di ' .$success .' righe.</p>';
                $message_warning_f .= '</ul> <p> per un totale di ' .$warning .' righe.</p>';

                $message_success .= $message_success_h .$message_success_b . $message_success_f;
                $message_warning .= $message_warning_h .$message_warning_b . $message_warning_f;

            }

        } else {
            $request->validate([
                'typeanswer_id' => 'required',
                'type_id' => 'required',
                'site_uid' => 'required',
                'house_uid' => 'required',
                'block_id' => 'required',
                'section_id' => 'required',
                'text_id' => 'required',
            ]);

            foreach ($request->site_uid as $site_uid) {
                $message_success_h = ''; $message_success_b = ''; $message_success_f = ''; $success = 0;
                $message_warning_h = ''; $message_warning_b = ''; $message_warning_f = ''; $warning = 0;
                foreach ($request->house_uid as $house_uid){
                    $flow = Flow::with('typeanswer', 'type')
                        ->where('typeanswer_id', '=', $typeanswer_id)
                        ->where('type_id', '=', $type_id)
                        ->where('site_uid', '=', $site_uid)
                        ->where('house_uid', '=', $house_uid)
                        ->first();

                    if($flow != NULL){
                        $flow_text_exist = FlowText::where('flow_id', '=', $flow->id)
                            ->where('text_id', '=', $text_id)
                            ->first();

                        if($flow_text_exist == NULL){

                            FlowText::create([
                                'flow_id' =>  $flow->id,
                                'text_id' => $text_id,
                                'block_id' => $block_id,
                                'section_id' => $section_id,
                            ]);

                            $success ++;
                            $message_success_b .= '<li> ' . $houses[$flow->house_uid] .'</li>';

                        } else {
                            $warning ++;
                            $message_warning_b .= '<li>' .$houses[$flow->house_uid] .'</li>';
                        }

                    }
                }
                $message_success_h .= '<p> Testo associato correttamente al Tipo Risposta '. $flow->typeanswer->name .', al Modello '. $flow->type->name .' e al Sito '. $sites[$flow->site_uid] .'<ul>';
                $message_warning_h .= '<p> Testo già associato al Tipo Risposta '. $flow->typeanswer->name .', al Modello '. $flow->type->name .' e al Sito '. $sites[$flow->site_uid] .'<ul>';

                $message_success_f .= '</ul> <p> per un totale di ' .$success .' righe.</p>';
                $message_warning_f .= '</ul> <p> per un totale di ' .$warning .' righe.</p>';

                $message_success .= $message_success_h .$message_success_b . $message_success_f;
                $message_warning .= $message_warning_h .$message_warning_b . $message_warning_f;
            }

        }

        if($warning > 0 && $success > 0){
            return redirect('/backend/testi/'. $text_id.'/edit/#flow_text')
                ->with('message_success', $message_success)
                ->with('message_warning', $message_warning);
        } elseif($warning > 0){
            return redirect('/backend/testi/'. $text_id.'/edit/#flow_text')
                ->with('message_warning', $message_warning);
        } else {
            return redirect('/backend/testi/'. $text_id.'/edit/#flow_text')
                ->with('message_success', $message_success);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flow_text = FlowText::find($id)
            ->with('flow')
            ->with('text')
            ->with('block')
            ->with('section')
            ->get();


        return view('backend.flusso_testi.show')
            ->with(compact('flow_text'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $flow_text = FlowText::where('id', '=', $request->flow_text_id)
                ->with('text', 'flow.typeanswer', 'flow.type', 'block', 'section')
                ->firstOrFail();

            return response()->json($flow_text);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        FlowText::where('id', $request->flow_text_id)
            ->update([
                'block_id' => $request->input('block_id'),
                'section_id' => $request->input('section_id'),
            ]);

        return response()->json(['message_success'=>'Modifiche apportate con successo.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            if ($request->flow_text_id) {
                $flow_text = FlowText::where('id', $request->flow_text_id);
            }

            if ($request->text_id_to_delete) {
                $flow_text = FlowText::where('text_id', $request->text_id_to_delete);
            }

            $flow_text->delete();

            return response()->json(['message_delete'=>'Testo: '.$request->text_id.' cancellato correttamente dal flusso: '.$request->flow_text_id]);
        }

    }

}
