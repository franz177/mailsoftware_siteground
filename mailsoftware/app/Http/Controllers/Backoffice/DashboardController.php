<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\House;
use App\Models\Typo;
use App\Models\TypoHouses;
use App\Models\TypoSite;
use App\Models\TypoUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typo = new Typo;
        $colori_siti = $typo->color_siti;

        $typo_h = new TypoHouses;
        $typo_s = new TypoSite;

        $case_typo = TypoHouses::select(['uid', 'header', 'subheader', 'tx_mask_t1_casa_gestore as proprietario', 'tx_mask_t1_op_gestore as gestore', Typo::raw('IF(hidden=0, \'Attiva\', \'Disattiva\') as stato')])
            ->where('CType', $typo_h->CType)
            ->where('deleted', '=', 0)
            ->whereIn('uid', array(1,3,4,5,6,7,8))
            ->get();

        $siti = Typo::select(['uid', 'header', 'tx_mask_siti_abbr as sito', 'tx_mask_siti_perc as percentuale', Typo::raw('IF(hidden=0, \'Attivo\', \'Disattivo\') as stato')])
            ->where('CType', $typo_s->CType)
            ->where('deleted', '=', 0)
            ->orderBy('stato')->get();

        $siti_kross = Typo::select('uid', 'header', 'tx_mask_siti_kross_cod_channel as sito', 'tx_mask_siti_perc as percentuale')
            ->where('CType', $typo_s->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->orderBy('uid')->get();

        $gestori = TypoUser::select(['uid', 'name', TypoUser::raw('CONCAT(first_name, \' \', last_name) as nominativo')])
            ->pluck('name', 'uid');

        foreach ($case_typo as $casa_typo) {
            $in_db = House::find($casa_typo->uid);
            if(!$in_db){
                House::create([
                    'uid' => $casa_typo->uid,
                    'bank_id' => 1,
                    'ztl_id' => 1,
                    'color_id' => 1,
                    'persone_max' => 0,
                ]);
            }
        }

        $case = new House;

        return view('backend.dashboard')
            ->with(compact('case_typo'))
            ->with(compact('case'))
            ->with(compact('siti'))
            ->with(compact('colori_siti'))
            ->with(compact('siti_kross'))
            ->with(compact('gestori'));
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
        //
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
