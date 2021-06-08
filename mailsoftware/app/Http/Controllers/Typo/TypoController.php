<?php

namespace App\Http\Controllers\Typo;

use App\Http\Controllers\Controller;
use App\Models\Typo;
use Illuminate\Http\Request;

class TypoController extends Controller
{

    protected $CType = 'mask_db_alg_pren';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.index')
            ->with('typo', Typo::where('CType', $this->CType)
                                ->where('hidden', 0)
                                ->where('deleted', 0)
                                ->orderBy('uid', 'DESC')->get());
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
