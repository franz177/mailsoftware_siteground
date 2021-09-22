<?php

namespace App\Http\Controllers\Typo;

use App\Http\Controllers\Controller;
use App\Models\Typo;
use Illuminate\Http\Request;

class TypoController extends Controller
{

    protected $CType = 'mask_db_alg_pren';

    public function getBookings()
    {
        return Typo::select([Typo::raw('YEAR(tx_mask_p_data_arrivo) as YEAR'), Typo::raw('CONCAT(FORMAT(SUM(tx_mask_t3_p_stay), 2, "it_IT"), " €") as STAY')])
            ->where('CType', $this->CType)
            ->where('hidden', 0)
            ->where('deleted', 0)
            ->where('tt_content.tx_mask_cod_reservation_status', '!=', "CANC")
            ;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \App\Models\Typo  $typo
     * @return \Illuminate\Http\Response
     */
    public function show(Typo $typo)
    {
        return view('frontend.show')
            ->with('typo', Typo::where('tx_mask_p_old_uid', $typo)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Typo  $typo
     * @return \Illuminate\Http\Response
     */
    public function edit(Typo $typo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Typo  $typo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Typo $typo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Typo  $typo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Typo $typo)
    {
        //
    }
}
