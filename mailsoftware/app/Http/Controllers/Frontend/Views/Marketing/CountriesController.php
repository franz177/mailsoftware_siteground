<?php

namespace App\Http\Controllers\Frontend\Views\Marketing;

use App\Charts\CountriesChart;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses_typo = $this->getHousesAbbrArray();
        $years = $this->getYears();

        return view('frontend.marketing.countries')
            ->with(compact('houses_typo'))
            ->with(compact('years'));
    }

    private $tot_percent;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCountriesTable(Request $request)
    {
        $year = $request->year != 0 ? $request->year : NULL;
        $house = $request->house ? $request->house : NULL;

        $bookings = Booking::with('country:uid,cn_short_it')
            ->select('uid','tx_mask_t0_country')
            ->selectRaw('COUNT(tx_mask_t0_country) as totale')
            ->when($year, function ($q, $year){
                return $q->whereRaw('(YEAR(tx_mask_p_data_arrivo) = '.$year.' OR YEAR(tx_mask_p_data_partenza) = '.$year.')');
            })
            ->when($house, function ($q, $house){
                return $q->whereIn('tx_mask_p_casa', $house);
            })
            ->whereNotNull('tx_mask_t0_country')->where('tx_mask_t0_country', '!=', '')
            ->where('tx_mask_cod_reservation_status', '!=', 'CANC')
            ->orderBy('totale', 'DESC')
            ->groupBy('tx_mask_t0_country')
            ->get();

//        return $bookings->toJson();
        $this->tot_percent = $bookings->sum('totale');

        return Datatables::of($bookings)
            ->addColumn('percent', function ($row) {
                $percent = (($row->totale/$this->tot_percent)*100);
                return '<span class="font-weight-bolder">'.number_format($percent, 2, ',', '.').'%</span>';
            })
            ->addColumn('totale_pren', function ($row) {
                return $this->tot_percent;
            })
            ->rawColumns(['percent'])
            ->make(true);
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
