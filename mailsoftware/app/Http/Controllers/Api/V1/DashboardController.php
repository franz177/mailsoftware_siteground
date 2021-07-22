<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Typo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $year_to_search = array();
    public $house_to_search = array();

    public function dashboard(Request $request)
    {
        if($request->year_from){
            $this->year_to_search[] = $request->year_from;
            if($request->year_to)
                $this->year_to_search[] = $request->year_to;
        }

        $year_to_search = $this->year_to_search;

        if($request->house_from){
            $this->house_to_search[] = $request->house_from;
            if($request->house_to)
                $this->house_to_search[] = $request->house_to;
        }

        $house_to_search = $this->house_to_search;
        $houses = $this->getHousesAbbArray();

        $reservations = $this->reservationsDonutDb($year_to_search, $house_to_search);
        $countries = $this->countriesRadial($year_to_search, $house_to_search);

        $labels = Array();
//        $series = $reservations->pluck('total');
        foreach ($reservations as $reservation) {
            $labels[] = $reservation["year"] . ' - ' . $houses[$reservation['house']];
        }

        $dataReservations = array();
        $dataReservations['series'] = $reservations->pluck('total');
        $dataReservations['labels'] = $labels;

        $dataCountries = array();
        $dataCountries['series'] = $countries->pluck('total');
        $dataCountries['labels'] = $countries->pluck('country');

        return response()->json(compact('dataReservations', 'dataCountries'));
    }

    public function reservationsDonutDb($year_to_search = NULL, $house_to_search = NULL)
    {
        return Typo::select([Typo::raw('count(YEAR(tx_mask_p_data_prenotazione)) as total'), Typo::raw('YEAR(tx_mask_p_data_prenotazione) as year'), 'tx_mask_p_casa as house'])
            ->where('CType', '=', 'mask_db_alg_pren')
            ->where('tt_content.hidden', '=', 0)
            ->where('tt_content.deleted', '=', 0)
            ->whereNotNull('tx_mask_p_data_prenotazione')
            ->when($year_to_search,
                function($q, $year_to_search){
                    return $q->whereIn(Typo::raw('YEAR(tx_mask_p_data_prenotazione)'), $year_to_search);
                },
            )
            ->when($house_to_search,
                function($q, $house_to_search){
                    return $q->whereIn('tx_mask_p_casa', $house_to_search);
                },
            )
            ->groupBy([Typo::raw('YEAR(tx_mask_p_data_prenotazione)'), 'house'])->get();
    }

    public function countriesRadial($year_to_search = NULL, $house_to_search = NULL)
    {
        return Typo::select([Typo::raw('count(tt_content.tx_mask_t0_country) as total'), 'static_countries.cn_short_it as country', 'tt_content.tx_mask_p_casa as house'])
            ->join('static_countries', 'static_countries.uid', '=', 'tt_content.tx_mask_t0_country')
            ->where('CType', '=', 'mask_db_alg_pren')
            ->where('tt_content.hidden', '=', 0)
            ->where('tt_content.deleted', '=', 0)
            ->whereNotNull('tx_mask_p_data_prenotazione')
            ->when($year_to_search,
                function($q, $year_to_search){
                    return $q->whereIn(Typo::raw('YEAR(tx_mask_p_data_prenotazione)'), $year_to_search);
                },
            )
            ->when($house_to_search,
                function($q, $house_to_search){
                    return $q->whereIn('tx_mask_p_casa', $house_to_search);
                },
            )
            ->groupBy([Typo::raw('tt_content.tx_mask_t0_country')])->get();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
