<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Flow;
use App\Models\FlowText;
use App\Models\Text;
use App\Models\TypoHouses;
use App\Models\TypoSite;
use Illuminate\Http\Request;

class TextListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flow  = new Flow;

        $houses = TypoHouses::select('uid', 'header')
            ->pluck('header', 'uid');

        $sites = TypoSite::select('uid', 'tx_mask_siti_abbr as sito')
            ->pluck('sito', 'uid');

        $flow_text = FlowText::select('text_id')
            ->pluck('text_id')->toArray();

        $texts = Text::all();

        return view('backend.testi_elenco.index')
            ->with(compact('flow'))
            ->with(compact('houses'))
            ->with(compact('sites'))
            ->with(compact('flow_text'))
            ->with(compact('texts'));
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
