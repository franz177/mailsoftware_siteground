<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\City;
use App\Models\Color;
use App\Models\House;
use App\Models\Room;
use App\Models\Typo;
use App\Models\TypoHouses;
use App\Models\TypoSite;
use App\Models\TypoUser;
use App\Models\User;
use App\Models\Ztl;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typo = new Typo;

        $typo_h = new TypoHouses;

        $case_typo = TypoHouses::select(['uid', 'header', 'subheader', 'tx_mask_t1_casa_gestore as proprietario', 'tx_mask_t1_op_gestore as gestore', Typo::raw('IF(hidden=0, \'Attiva\', \'Disattiva\') as stato')])
            ->where('CType', $typo_h->CType)
            ->where('deleted', '=', 0)
            ->whereIn('uid', array(1,3,4,5,6,7,8))
            ->get();


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

        return view('backend.casa.index')
            ->with(compact('case_typo'))
            ->with(compact('case'))
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
     * @param  int  $uid
     * @return \Illuminate\Http\Response
     */
    public function show($uid)
    {
        $typo_h = new TypoHouses;

        $casa_typo = Typo::where('CType', $typo_h->CType)->where('uid', $uid)->first();

        //recupero tutte le banche dalla tabella interna banks
        $banche = Bank::all();

        $citta = City::find($casa_typo->tx_mask_casa_citta);

        //recupero la casa dalla tabella interna houses
        $casa = House::find($uid);

        $gestori = TypoUser::select(['uid', 'name', TypoUser::raw('CONCAT(first_name, \' \', last_name) as nominativo')])
            ->pluck('name', 'uid');

        $users = new TypoUser;
        $ztl = new Ztl;

        return view('backend.casa.show')
            ->with(compact('casa_typo'))
            ->with(compact('casa'))
            ->with(compact('gestori'))
            ->with(compact('users'))
            ->with(compact('citta'))
            ->with(compact('ztl'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uid
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {
        $typo = new Typo;
        $typo_h = new TypoHouses;

        $casa_typo = Typo::where('CType', $typo_h->CType)->where('uid', $uid)->first();

        $casa = House::find($uid);

        $banks = Bank::all();
        $ztls = Ztl::all();
        $colors = Color::all();
        $rooms = Room::all();
        $users = User::all();


        return view('backend.casa.edit')
            ->with(compact('casa_typo'))
            ->with(compact('casa'))
            ->with(compact('banks'))
            ->with(compact('ztls'))
            ->with(compact('colors'))
            ->with(compact('rooms'))
            ->with(compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $uid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uid)
    {
        House::where('uid', $uid)
            ->update([
                'bank_id' => $request->input('bank_id'),
                'ztl_id' => $request->input('ztl_id'),
                'persone_max' => $request->input('persone_max'),
                'color_id' => $request->input('color_id')
            ]);

        $casa = House::find($uid);

        $casa->rooms()->sync($request->rooms);
        $casa->users()->sync($request->users);

        return redirect('/backend/casa/'.$uid)
            ->with('message', 'Dati Casa Aggiornati con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid)
    {
        //
    }
}
