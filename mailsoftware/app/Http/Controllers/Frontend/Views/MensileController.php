<?php

namespace App\Http\Controllers\Frontend\Views;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Typo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MensileController extends Controller
{

    protected $CType = 'mask_db_alg_pren';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::with('color')->get();
        $houses_color = $houses->pluck('color.colore_bg', 'uid');
        $houses_typo = $this->getHousesAbbrArray();
        $sites_kross = $this->getSitesKross();

        $op_check_out = $this->getUsersArray();

        return view('frontend.viste.mensile')
            ->with(compact('houses_color'))
            ->with(compact('sites_kross'))
            ->with(compact('op_check_out'))
            ->with(compact('houses_typo'));
    }

    public function getDataTable()
    {
        $month = now()->month;
//        $month = $month - 1;
        if ($month == 1)
            $month = 12;

        $data = Typo::select([
            Typo::raw('LCASE(tt_content.header) as headerl'),
            Typo::raw('IFNULL(tt_content.tx_mask_p_casa,0) casa'),
            Typo::raw('tt_content.tx_mask_t5_kross_cod_channel as sito'),
            'tt_content.tx_mask_p_data_arrivo', 'tt_content.tx_mask_p_data_partenza', 'tt_content.tx_mask_t1_op_note', 'tx_mask_t3_p_city_tax_amount as city_tax', 'tx_mask_t1_op_checkout'
        ])
            ->where('tt_content.CType', 'mask_db_alg_pren')
            ->where('tt_content.hidden', '=', 0)
            ->where('tt_content.deleted', '=', 0)
            ->where(function ($q) use ($month) {
                $q->where(Typo::raw('MONTH(tt_content.tx_mask_p_data_arrivo)'), '=', $month)
                    ->orWhere(Typo::raw('MONTH(tt_content.tx_mask_p_data_partenza)'), '=', $month);
            })
            ->where('tt_content.tx_mask_cod_reservation_status', '!=', "CANC")
            ->orderBy('tt_content.tx_mask_p_data_arrivo', 'ASC')
            ->orderBy('tt_content.tx_mask_p_data_partenza', 'ASC')
            ->get();

        return Datatables::of($data)
            ->addColumn('header', function ($row) {
                return '<a href="#" data-toggle="tooltip"  class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg text-capitalize text-left">' . $row->headerl . '</a>';
            })
            ->addColumn('city_tax', function ($row) {
                return number_format($row->city_tax, 2, ',', '.') . ' €';
            })
            ->rawColumns(['header', 'city_tax'])
            ->make(true);
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
