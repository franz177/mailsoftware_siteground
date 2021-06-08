<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Operator;
use App\Models\TypoUser;
use App\Models\TypoGroup;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typo_user = new TypoUser;

        $operatori_typo = $this->getUsers();

        $count_user = TypoUser::join('fe_groups', 'fe_users.usergroup', '=', 'fe_groups.uid')
            ->select(['fe_groups.uid as uidg', TypoUser::raw('COUNT(fe_groups.uid) as uidg_count')])
            ->where('fe_users.disable', '=', 0)
            ->where('fe_users.deleted', '=', 0)
            ->where('fe_users.pid', '=', 4)
            ->groupBy('fe_groups.uid')
            ->orderBy('fe_groups.uid')
            ->pluck('uidg_count', 'uidg');

        foreach ($operatori_typo as $operatore_typo) {
            $in_db = Operator::find($operatore_typo->uid);
            if(!$in_db){
                Operator::create([
                    'uid' => $operatore_typo->uid,
                    'gender' => 99,
                    'transfer' => 99,
                    'dalle' => '00:00',
                    'alle' => '00:00',
                    'debit' => 0
                ]);
            }
        }


        return view('backend.operatore.index')
            ->with(compact('typo_user'))
            ->with(compact('operatori_typo'))
            ->with(compact('count_user'));

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
        $operatore_typo = TypoUser::join('fe_groups', 'fe_users.usergroup', '=', 'fe_groups.uid')
            ->select(['fe_users.uid', 'fe_groups.uid as uidg', 'fe_users.name', 'fe_users.telephone', 'fe_users.tx_nv_ag_cod_op_excel as excel', 'fe_users.email', TypoUser::raw('CONCAT(fe_users.first_name, \' \', fe_users.last_name) as nominativo'), 'fe_groups.title as gruppo', 'fe_users.usergroup'])
            ->where('fe_users.disable', '=', 0)
            ->where('fe_users.deleted', '=', 0)
            ->where('fe_users.pid', '=', 4)
            ->where('fe_users.uid', '=', $uid)
            ->first();

        $operatore = Operator::find($uid);

        return view('backend.operatore.show')
            ->with(compact('operatore_typo'))
            ->with(compact('operatore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uid
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {
        $operatore_typo = TypoUser::join('fe_groups', 'fe_users.usergroup', '=', 'fe_groups.uid')
            ->select(['fe_users.uid', 'fe_groups.uid as uidg', 'fe_users.name', 'fe_users.telephone', 'fe_users.tx_nv_ag_cod_op_excel as excel', 'fe_users.email', TypoUser::raw('CONCAT(fe_users.first_name, \' \', fe_users.last_name) as nominativo'), 'fe_groups.title as gruppo', 'fe_users.usergroup'])
            ->where('fe_users.disable', '=', 0)
            ->where('fe_users.deleted', '=', 0)
            ->where('fe_users.pid', '=', 4)
            ->where('fe_users.uid', '=', $uid)
            ->first();

        $operatore = Operator::find($uid);

        $citta = City::all();


        return view('backend.operatore.edit')
            ->with(compact('operatore_typo'))
            ->with(compact('operatore'))
            ->with(compact('citta'));
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
        Operator::where('uid', $uid)
            ->update([
                'gender' => $request->input('gender'),
                'transfer' => $request->input('transfer'),
                'dalle' => $request->input('dalle'),
                'alle' => $request->input('alle'),
                'debit' => $request->input('debit')

            ]);

        $operator = Operator::find($uid);

        $operator->cities()->sync($request->houses);

        return redirect('/backend/operatore/'.$uid)
            ->with('message', 'Dati Operatore Aggiornati con successo!');
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
