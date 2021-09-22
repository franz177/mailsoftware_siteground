<?php

namespace App\Http\Controllers\Frontend\Views;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\House;
use App\Models\Typo;
use App\Models\TypoHouses;
use App\Models\TypoRange;
use App\Models\TypoRangeMM;
use App\Models\TypoUser;
use App\Models\TypoCHouse;
use Carbon\Carbon;
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

    public function getDataTables()
    {
        $month = now()->month;
        $year = now()->year;
        if($month == 1)
            $month = 12;

        $data = Booking::where(function ($q) use ($year) {
                $q->where(Typo::raw('YEAR(tx_mask_p_data_arrivo)'), '=', $year)
                    ->orWhere(Typo::raw('YEAR(tx_mask_p_data_partenza)'), '=', $year);
            })
            ->where(function ($q) use ($month) {
                $q->where(Typo::raw('MONTH(tx_mask_p_data_arrivo)'), '=', $month)
                    ->orWhere(Typo::raw('MONTH(tx_mask_p_data_partenza)'), '=', $month);
            })
            ->where('tx_mask_cod_reservation_status', '!=', "CANC")
            ->orderBy('tx_mask_p_data_arrivo', 'ASC')
            ->orderBy('tx_mask_p_data_partenza', 'ASC')
            ->get();

        return Datatables::of($data)
            ->addColumn('header', function ($row) {
                $header = preg_replace('/(\([a-zA-Z0-9\s]+\)\s?)/', '', $row->header);
                return '<a href="#" data-toggle="tooltip"  class="text-dark-75 text-hover-primary mb-1 font-size-lg text-capitalize text-left">' . $header . '</a>';
            })
            ->addColumn('city_tax', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->city_tax, 2, ',', '.').'</span>';
            })
            ->addColumn('costo_orario', function($row) {

                return '<span class="font-weight-bolder">€ '.number_format($row->costo_orario, 2, ',', '.').'</span>';
            })
            ->addColumn('totale_pulizie', function($row) {
                if($row->totale_pulizie == 0)
                    return '<span class="text-danger">Metti le ore!</span>';

                return '<span class="font-weight-bolder">€ '.number_format($row->totale_pulizie, 2, ',', '.').'</span>';
            })
            ->addColumn('costo_co', function($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->costo_co, 2, ',', '.').'</span>';
            })
            ->addColumn('costo_ex_co', function($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_s_ex_checkout, 2, ',', '.').'</span>';
            })
            ->addColumn('cash_operatore_co', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_cash_op_cout, 2, ',', '.').'</span>';
            })
            ->addColumn('cash_simo_co', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_cash_simo, 2, ',', '.').'</span>';
            })
            ->addColumn('mancia_cli', function ($row) {
                $text_danger = '';
                if($row->mancia_cli < 0)
                    $text_danger = 'text-danger';
                return '<span class="font-weight-bolder '. $text_danger .'">€ '.number_format($row->mancia_cli, 2, ',', '.').'</span>';
            })
            ->addColumn('extra_cash_ospite', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_s_checkout, 2, ',', '.').'</span>';
            })
            ->addColumn('costi_costo_operatore_cambio_biancheria', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->costi_costo_operatore_cambio_biancheria, 2, ',', '.').'</span>';
            })
            ->addColumn('sum_tot_pulizie', function ($data) {
                return '<span class="font-weight-bolder">€ '.number_format($data->sum('totale_pulizie'), 2, ',', '.').'</span>';
            })
            ->addColumn('sum_supervisor_pulizie', function ($data) {
                return '<span class="font-weight-bolder">€ '.number_format($data->sum('tx_mask_t3_p_extra_p'), 2, ',', '.').'</span>';
            })
            ->addColumn('sum_costo_co', function ($data) {
                return '<span class="font-weight-bolder">€ '.number_format($data->sum('costo_co'), 2, ',', '.').'</span>';
            })
            ->addColumn('sum_ex_co', function ($data) {
                return '<span class="font-weight-bolder">€ '.number_format($data->sum('tx_mask_t3_p_s_ex_checkout'), 2, ',', '.').'</span>';
            })
            ->addColumn('sum_cash_operatore_co', function ($data) {
                return '<span class="font-weight-bolder">€ '.number_format($data->sum('tx_mask_t3_p_cash_op_cout'), 2, ',', '.').'</span>';
            })
            ->addColumn('sum_cash_simo_co', function ($data) {
                return '<span class="font-weight-bolder">€ '.number_format($data->sum('tx_mask_t3_p_cash_simo'), 2, ',', '.').'</span>';
            })
            ->addColumn('sum_mancia_cli', function ($data) {
                $text_danger = '';
                $tot = $data->sum('mancia_cli');
                if($tot < 0)
                    $text_danger = 'text-danger';
                return '<span class="font-weight-bolder '. $text_danger .'">€ '.number_format($tot, 2, ',', '.').'</span>';
            })
            ->addColumn('extra_mondezza', function ($data) {
                return '';
            })
            ->rawColumns([
                'header', 'city_tax','costo_orario', 'totale_pulizie',
                'cash_operatore_co', 'cash_simo_co', 'costo_co', 'costo_ex_co',
                'mancia_cli', 'mancia_cli_or', 'extra_cash_ospite', 'costi_costo_operatore_cambio_biancheria',
                'sum_tot_pulizie', 'sum_supervisor_pulizie', 'sum_costo_co',
                'sum_ex_co', 'sum_cash_operatore_co', 'sum_cash_simo_co',
                'sum_mancia_cli', 'extra_mondezza'
            ])
            ->make(true);

    }

    public function getDataTable()
    {
        $month = now()->month;
        $year = now()->year;
//        $month = $month - 3;
        if ($month == 1)
            $month = 12;

        $data = Typo::select([
            Typo::raw('LCASE(tt_content.header) as headerl'),
            Typo::raw('IFNULL(tt_content.tx_mask_p_casa,0) casa'),
            Typo::raw('tt_content.tx_mask_t5_kross_cod_channel as sito'),
            'tt_content.tx_mask_p_data_arrivo', 'tt_content.tx_mask_p_data_partenza', 'tt_content.tx_mask_t1_op_note',
            'tx_mask_t3_p_city_tax_amount as city_tax', 'tx_mask_t1_op_pulizie', 'tx_mask_t0_fattura', 'tx_mask_t3_p_extra_p', 'tx_mask_t1_ore_pulizie', 'tx_mask_t1_op_checkout',
            'tx_mask_t3_p_cash_op_cout as cash_operatore_co','tx_mask_t3_p_cash_simo as cash_simo_co', 'tx_mask_t3_p_stay', 'tx_mask_t3_p_s_ex_checkout', 'tx_mask_t3_p_s_checkout'
        ])
            ->where('tt_content.CType', 'mask_db_alg_pren')
            ->where('tt_content.hidden', '=', 0)
            ->where('tt_content.deleted', '=', 0)
            ->where(function ($q) use ($year) {
                $q->where(Typo::raw('YEAR(tt_content.tx_mask_p_data_arrivo)'), '=', $year)
                    ->orWhere(Typo::raw('YEAR(tt_content.tx_mask_p_data_partenza)'), '=', $year);
            })
            ->where(function ($q) use ($month) {
                $q->where(Typo::raw('MONTH(tt_content.tx_mask_p_data_arrivo)'), '=', $month)
                    ->orWhere(Typo::raw('MONTH(tt_content.tx_mask_p_data_partenza)'), '=', $month);
            })
            ->where('tt_content.tx_mask_cod_reservation_status', '!=', "CANC")
//            ->orderBy('tt_content.tx_mask_p_casa', 'ASC')
            ->orderBy('tt_content.tx_mask_p_data_arrivo', 'ASC')
            ->orderBy('tt_content.tx_mask_p_data_partenza', 'ASC')
            ->get();

        return Datatables::of($data)
            ->addColumn('header', function ($row) {
                $headerl = preg_replace('/(\([a-zA-Z0-9\s]+\)\s?)/', '', $row->headerl);
                return '<a href="#" data-toggle="tooltip"  class="text-dark-75 text-hover-primary mb-1 font-size-lg text-capitalize text-left">' . $headerl . '</a>';
            })
            ->addColumn('city_tax', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->city_tax, 2, ',', '.').'</span>';
            })
            ->addColumn('costo_orario', function($row) {

                $id_op_pulizie = [
                    $row->tx_mask_t1_op_pulizie ? $row->tx_mask_t1_op_pulizie : 19
                ];
                $id_casa = $row->casa;
                $costo_op = TypoCHouse::select('tx_mask_c_cod_costo_orario_operatore')
                    ->whereIn('tx_mask_c_cod_feuser', $id_op_pulizie)
                    ->where('tx_mask_c_cod_casa', 'like', '%'. $id_casa .'%')
                    ->first();

                return '<span class="font-weight-bolder">€ '.number_format($costo_op->tx_mask_c_cod_costo_orario_operatore, 2, ',', '.').'</span>';
            })
            ->addColumn('totale_pulizie', function($row) {

                $id_op_pulizie = [
                    $row->tx_mask_t1_op_pulizie ? $row->tx_mask_t1_op_pulizie : 19
                ];
                $id_casa = $row->casa;

                $data_format = Carbon::createFromFormat('d-m-Y', $row->tx_mask_p_data_arrivo)->format('Y-m-d');

                $c_house = TypoCHouse::select([TypoCHouse::raw('IFNULL(tx_mask_c_cod_costo_orario_operatore, 19) costo_orario_operatore'), 'tt_content.tx_mask_t7_pulizie_metodo', 'tt_content.tx_mask_t3_govout_c_cout', 'tt_content.tx_mask_t3_govout_ritiro_immondizia', 'tt_content.tx_mask_t3_govout_ritiro_soldi',
                    'tt_content.tx_mask_t2_lav_c_cambio_b_cout', 'tt_content.tx_mask_t2_lav_prep_kit_cliente', 'tt_content.tx_mask_t2_lav_costo_dotazione_casa', 'tt_content.tx_mask_t2_lav_prep_kit_dotazione_casa',
                    'tt_content.tx_mask_t7_cert_covid', 'tt_content.tx_mask_t7_costo_prod_pul', 'tt_content.tx_mask_t7_pul_stracci', 'tt_content.tx_mask_t5_supervisor_c_fornitura_kit_serv', 'tt_content.tx_mask_t7_fisso_pul'])
                    ->join('tx_mask_c_cos_periodo', 'tx_mask_c_cos_periodo.parentid', '=', 'tt_content.uid')
                    ->whereIn('tt_content.tx_mask_c_cod_feuser', $id_op_pulizie)
                    ->where('tt_content.tx_mask_c_cod_casa', 'like', '%'. $id_casa .'%')
                    ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_from', '<=', $data_format)
                    ->where('tx_mask_c_cos_periodo.tx_mask_c_cod_to', '>=', $data_format)
                    ->where('tt_content.deleted', '=', 0)
                    ->first();

                $sum = $c_house->tx_mask_t3_govout_c_cout + $c_house->tx_mask_t3_govout_ritiro_immondizia + $c_house->tx_mask_t3_govout_ritiro_soldi + $c_house->tx_mask_t2_lav_c_cambio_b_cout + $c_house->tx_mask_t2_lav_prep_kit_cliente + $c_house->tx_mask_t2_lav_costo_dotazione_casa + $c_house->tx_mask_t2_lav_prep_kit_dotazione_casa;
                $sum_pulizie = $c_house->tx_mask_t7_cert_covid + $c_house->tx_mask_t7_costo_prod_pul + $c_house->tx_mask_t7_pul_stracci + $c_house->tx_mask_t5_supervisor_c_fornitura_kit_serv + $c_house->tx_mask_t7_fisso_pul;

                if ($row->tx_mask_t1_ore_pulizie > 0){
                    $total = ($row->tx_mask_t1_ore_pulizie * $c_house->costo_orario_operatore);

                    $data_format = Carbon::createFromFormat('d-m-Y', $row->tx_mask_p_data_arrivo)->format('Y-m-d');

                    $check_co = Typo::select('uid')
                        ->where('tt_content.CType', 'mask_db_alg_pren')
                        ->where('tt_content.hidden', '=', 0)
                        ->where('tt_content.deleted', '=', 0)
                        ->where('tt_content.tx_mask_p_casa', $row->casa)
                        ->where('tt_content.tx_mask_p_data_partenza', $data_format)
                        ->where('tt_content.tx_mask_t1_op_checkout', $row->tx_mask_t1_op_pulizie)
                        ->first();

                    if($check_co) {
                         $total = $total - $sum;
                    }
                    return '<span class="font-weight-bolder">€ '.number_format($total, 2, ',', '.').'</span>';
                } else {
                    switch ($c_house->tx_mask_t7_pulizie_metodo){
                        case 1: // RANGE
                            $id_casa = $row->casa;
                            $range = TypoRange::select('uid', 'header', 'tx_mask_r_casa', 'tx_mask_r_dal', 'tx_mask_r_al', 'tx_mask_r_mm')
                                ->where('tx_mask_r_casa', 'like', '%'. $id_casa .'%')
                                ->where('hidden', 0)
                                ->where('deleted', 0)
                                ->first();

                            $range_mm = TypoRangeMM::select('tx_mask_r_mm_min', 'tx_mask_r_mm_max','tx_mask_r_mm_importo')
                                ->where('parentid', $range['uid'])
//                                ->where('tx_mask_r_mm_min','<=', $row->tx_mask_t3_p_stay)
                                ->where('tx_mask_r_mm_max','>=', $row->tx_mask_t3_p_stay)
                                ->first();
                            return '<span class="font-weight-bolder">€ '.number_format($range_mm['tx_mask_r_mm_importo'], 2, ',', '.').'</span>';
                            break;
                        case 2: // IMPORTO FISSO
                            if($sum_pulizie == 0)
                                return '<span class="text-danger">Metti le ore!!!</span>';

                            return '<span class="font-weight-bolder">€ '.number_format($sum_pulizie, 2, ',', '.').'</span>';
                            break;
                        default:
                            return '<span class="text-danger">Metti le ore!!!</span>';
                    }

                }
            })
            ->addColumn('costo_co', function($row) {
                $id_op_co = $row->tx_mask_t1_op_checkout ? $row->tx_mask_t1_op_checkout : 19;
                $id_house = $row->tx_mask_p_casa;
                $c_house = TypoCHouse::select('uid', 'header', 'tx_mask_t3_govout_c_cout', 'tx_mask_t3_govout_ritiro_immondizia', 'tx_mask_t3_govout_ritiro_soldi',
                    'tx_mask_t2_lav_c_cambio_b_cout', 'tx_mask_t2_lav_prep_kit_cliente', 'tx_mask_t2_lav_costo_dotazione_casa', 'tx_mask_t2_lav_prep_kit_dotazione_casa')
                    ->where('tx_mask_c_cod_feuser', 'like', '%'. $id_op_co .'%')
                    ->where('tx_mask_c_cod_casa', 'like', '%'. $id_house .'%')
                    ->where('hidden', 0)
                    ->where('deleted', 0)
                    ->first();
                $sum = $c_house->tx_mask_t3_govout_c_cout + $c_house->tx_mask_t3_govout_ritiro_immondizia + $c_house->tx_mask_t3_govout_ritiro_soldi + $c_house->tx_mask_t2_lav_c_cambio_b_cout + $c_house->tx_mask_t2_lav_prep_kit_cliente + $c_house->tx_mask_t2_lav_costo_dotazione_casa + $c_house->tx_mask_t2_lav_prep_kit_dotazione_casa;
                $c_house->fresh();
                return '<span class="font-weight-bolder">€ '.number_format($sum, 2, ',', '.').'</span>';
            })
            ->addColumn('costo_ex_co', function($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_s_ex_checkout, 2, ',', '.').'</span>';
            })
            ->addColumn('cash_operatore_co', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->cash_operatore_co, 2, ',', '.').'</span>';
            })
            ->addColumn('cash_simo_co', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->cash_simo_co, 2, ',', '.').'</span>';
            })
            ->addColumn('mancia_cli', function ($row) {
                $mancia_cli = ($row->cash_operatore_co + $row->cash_simo_co) - ($row->city_tax + $row->tx_mask_t3_p_s_checkout);
                return '<span class="font-weight-bolder">€ '.number_format($mancia_cli, 2, ',', '.').'</span>';
            })
            ->addColumn('mancia_cli_or', function ($row) {
                return ($row->cash_operatore_co + $row->cash_simo_co) - ($row->city_tax + $row->tx_mask_t3_p_s_checkout);
            })
            ->addColumn('extra_cash_ospite', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_s_checkout, 2, ',', '.').'</span>';
            })
            ->rawColumns(['header', 'city_tax','costo_orario', 'totale_pulizie', 'cash_operatore_co', 'cash_simo_co', 'costo_co', 'costo_ex_co', 'mancia_cli', 'mancia_cli_or', 'extra_cash_ospite'])
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
