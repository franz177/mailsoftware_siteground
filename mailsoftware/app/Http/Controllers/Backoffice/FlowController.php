<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Flow;
use App\Models\Type;
use App\Models\Typeanswer;
use App\Models\Typo;
use App\Models\TypoHouses;
use App\Models\TypoSite;
use Illuminate\Http\Request;

class FlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typo_s = new TypoSite;
        $typo_h = new TypoHouses;

        $flow_model = new Flow;

        $flows = Flow::orderBy('typeanswer_id')
        ->orderBy('type_id')
        ->orderBy('site_uid')
        ->orderBy('house_uid')
        ->get();

        $sites = TypoSite::select('uid', 'tx_mask_siti_abbr as name')
            ->where('CType', $typo_s->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->pluck('name', 'uid');

        $houses = TypoHouses::select(['uid', TypoHouses::raw('CONCAT(subheader, \' \', header) as name')])
            ->where('CType', $typo_h->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->pluck('name', 'uid');

        $colors = Color::select('id', 'colore_bg')
            ->pluck('colore_bg', 'id');

        return view('backend.flusso.index')
            ->with(compact('flows'))
            ->with(compact('flow_model'))
            ->with(compact('sites'))
            ->with(compact('houses'))
            ->with(compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typo_s = new TypoSite;
        $typo_h = new TypoHouses;

        $typeanswers = Typeanswer::orderBy('sorting')->get();
        $types = Type::orderBy('sorting')->get();
        $sites = TypoSite::select(['uid', 'header', 'tx_mask_siti_abbr as sito', 'tx_mask_siti_perc as percentuale'])
            ->where('CType', $typo_s->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->orderBy('header')
            ->get();

        $houses = TypoHouses::select(['uid', 'header', 'subheader', 'tx_mask_t1_casa_gestore as proprietario', 'tx_mask_t1_op_gestore as gestore'])
            ->where('CType', $typo_h->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->whereIn('uid', array(1,3,4,5,6,7,8))
            ->get();

        return view('backend.flusso.create')
            ->with(compact('typeanswers'))
            ->with(compact('types'))
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
//        dd($request);

        $request->validate([
            'typeanswer_id' => 'required',
            'type_id' => 'required',
            'site_uid' => 'required',
            'house_uid' => 'required'
        ]);

        $typo_s = new TypoSite;
        $typo_h = new TypoHouses;

        $typeanswer = Typeanswer::find($request->typeanswer_id);
        $type = Type::find($request->type_id);

        $sites = TypoSite::select(['uid', 'tx_mask_siti_abbr as sito'])
            ->where('CType', $typo_s->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->orderBy('uid')
            ->pluck('sito', 'uid');

        $houses = TypoHouses::select(['uid', TypoHouses::raw('CONCAT(header,\' \', subheader) as name')])
            ->where('CType', $typo_h->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->whereIn('uid', array(1,3,4,5,6,7,8))
            ->orderBy('uid')
            ->pluck('name', 'uid');


        $message_pre = '<p>'. $typeanswer->name.' - '. $type->name .'</p>
                        <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <table class="table table-bordered dataTable no-footer dtr-inline collapsed">
                                <thead>
                                    <tr>
                                        <th class="text-left" style="min-width: 100px">Sito</th>
                                        <th class="text-left">Casa</th>
                                    </tr>
                                </thead>
                                <tbody>
                        ';

        $message_mid_warning = '<p>Flusso già presente a Database per </p>';
        $message_mid_success = '<p>Flussi aggiunti correttamente a Database</p>';

        $message_pos = '        </tbody>
                            </table>
                        </div>';

        $message_warning = NULL;
        $message_success = NULL;

        $error = 0;
        $success = 0;

        foreach ($request->site_uid as $site_uid){

            foreach ($request->house_uid as $house_uid){

                $flow_exist = Flow::where('typeanswer_id', '=', $request->typeanswer_id)
                    ->where('type_id', '=', $request->type_id)
                    ->where('site_uid', '=', $site_uid)
                    ->where('house_uid', '=', $house_uid)
                    ->get();

                if(count($flow_exist) > 0){
                    $error = 1;
                    $message_mid_warning .= '<tr><td>'. $sites[$site_uid] .'</td><td>'.$houses[$house_uid].'</td></tr>';
                } else {
                    $success = 1;
                    Flow::create([
                        'typeanswer_id' =>  $request->input('typeanswer_id'),
                        'type_id' => $request->input('type_id'),
                        'site_uid' => $site_uid,
                        'house_uid' => $house_uid
                    ]);
                }
            } //end foreach houses
        } //end foreach sites

        if($error == 1)
            $message_warning = $message_pre.$message_mid_warning.$message_pos;

        if($success == 1)
            $message_success = 'Flussi per [' . $typeanswer->name .' - '. $type->name .'] aggiunti correttamente a Database';

        return redirect('/backend/flusso/create')
            ->with('message_warning', $message_warning)
            ->with('message_success', $message_success);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('Flusso Show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('Flusso Edit');
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
        $flow = Flow::where('id', $id);
        $flow->delete();

        return redirect('/backend/flusso')
            ->with('message_success', 'Flusso cancellato correttamente');
    }
}
