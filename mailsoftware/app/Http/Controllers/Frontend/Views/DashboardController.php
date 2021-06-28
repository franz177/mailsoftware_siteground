<?php

namespace App\Http\Controllers\Frontend\Views;

use App\Http\Controllers\Controller;
use App\Models\Typo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $typo = new Typo();
        $years = $this->getYears();
        $year_to_search = NULL;

        $labels = "";
        $series = array();
        $totale_pren = $this->prenotazioniCount($year_to_search);
        $reservations = $this->prenotazioniDonut();
        foreach ($reservations as $reservation) {
            $labels .= "'".$reservation["year"]."',";
            $series[] = $reservation["total"];
        }

        $labels = rtrim($labels, ",");
        $series = json_encode($series);

        return view('frontend.viste.dashboard')
            ->with(compact('years'));
    }

    public function getYears(){
        $years = Typo::select(Typo::raw('YEAR(tx_mask_p_data_prenotazione) as year'))
            ->where('CType', '=', 'mask_db_alg_pren')
            ->where('tt_content.hidden', '=', 0)
            ->where('tt_content.deleted', '=', 0)
            ->whereNotNull('tx_mask_p_data_prenotazione')
            ->groupBy([Typo::raw('YEAR(tx_mask_p_data_prenotazione)')])
            ->get();

        return $years;
    }

    public function prenotazioniCount($year_to_search){
        $totale_pren = Typo::where('CType', '=', 'mask_db_alg_pren')
            ->where('tt_content.hidden', '=', 0)
            ->where('tt_content.deleted', '=', 0)
            ->whereNotNull('tx_mask_p_data_prenotazione')
            ->when($year_to_search,
                function($q, $year_to_search){
                    return $q->whereIn(Typo::raw('YEAR(tx_mask_p_data_prenotazione)'), $year_to_search);
                },
            )
            ->count();

        return intval($totale_pren);
    }

    public function prenotazioniDonut($year_to_search = NULL)
    {
        return Typo::select([Typo::raw('count(YEAR(tx_mask_p_data_prenotazione)) as total'), Typo::raw('YEAR(tx_mask_p_data_prenotazione) as year')])
            ->where('CType', '=', 'mask_db_alg_pren')
            ->where('tt_content.hidden', '=', 0)
            ->where('tt_content.deleted', '=', 0)
            ->whereNotNull('tx_mask_p_data_prenotazione')
            ->when($year_to_search,
                function($q, $year_to_search){
                    return $q->whereIn(Typo::raw('YEAR(tx_mask_p_data_prenotazione)'), $year_to_search);
                },
            )
            ->groupBy([Typo::raw('YEAR(tx_mask_p_data_prenotazione)')])->get();

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
