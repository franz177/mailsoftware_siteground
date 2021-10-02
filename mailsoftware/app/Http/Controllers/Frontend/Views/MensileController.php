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

    private $sum_tot_pulizie;
    private $sum_supervisor_pulizie;
    private $sum_costo_co;
    private $sum_ex_co;
    private $sum_cash_operatore_co;
    private $sum_cash_simo_co;
    private $sum_mancia_cli;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typo = new Typo();
        $houses = House::with('color')->get();
        $houses_color = $houses->pluck('color.colore_bg', 'uid');
        $houses_typo = $this->getHousesAbbrArray();
        $sites_kross = $this->getSitesKross();
        $sites_array = $this->getSitesArray();
        $years = $this->getYears();
        $months = $typo->months;

        $op_check_out = $this->getUsersArray();

        return view('frontend.viste.mensile')
            ->with(compact('houses_color'))
            ->with(compact('years'))
            ->with(compact('months'))
            ->with(compact('sites_kross'))
            ->with(compact('sites_array'))
            ->with(compact('op_check_out'))
            ->with(compact('houses_typo'));
    }

    public function getDataTables(Request $request)
    {
        $month = $request->month ? $request->month : now()->month;
        $year = $request->year ? $request->year : now()->year;

//        $month = $month - 2;
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

        $this->sum_tot_pulizie = $data->sum('totale_pulizie');
        $this->sum_supervisor_pulizie = $data->sum('tx_mask_t3_p_extra_p');
        $this->sum_costo_co = $data->sum('costo_co');
        $this->sum_ex_co = $data->sum('tx_mask_t3_p_s_ex_checkout');
        $this->sum_cash_operatore_co = $data->sum('tx_mask_t3_p_cash_op_cout');
        $this->sum_cash_simo_co = $data->sum('tx_mask_t3_p_cash_simo');
        $this->sum_mancia_cli = $data->sum('mancia_cli');

        if($data->count() > 0){
            return Datatables::of($data)
                ->addColumn('header', function ($row) {
                    $header = preg_replace('/(\([a-zA-Z0-9\s]+\)\s?)/', '', $row->header);
                    return '<a href="#" data-toggle="tooltip"  class="text-dark-75 text-hover-primary mb-1 font-size-lg text-capitalize text-left">' . $header . '</a>';
                })
                ->addColumn('city_tax', function ($row) {
                    return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_city_tax_amount, 2, ',', '.').'</span>';
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
                    return '<span class="font-weight-bolder">€ '.number_format($this->sum_tot_pulizie, 2, ',', '.').'</span>';
                })
                ->addColumn('sum_supervisor_pulizie', function ($data) {
                    return '<span class="font-weight-bolder">€ '.number_format($this->sum_supervisor_pulizie, 2, ',', '.').'</span>';
                })
                ->addColumn('sum_costo_co', function ($data) {
                    return '<span class="font-weight-bolder">€ '.number_format($this->sum_costo_co, 2, ',', '.').'</span>';
                })
                ->addColumn('sum_ex_co', function ($data) {
                    return '<span class="font-weight-bolder">€ '.number_format($this->sum_ex_co, 2, ',', '.').'</span>';
                })
                ->addColumn('sum_cash_operatore_co', function ($data) {
                    return '<span class="font-weight-bolder">€ '.number_format($this->sum_cash_operatore_co, 2, ',', '.').'</span>';
                })
                ->addColumn('sum_cash_simo_co', function ($data) {
                    return '<span class="font-weight-bolder">€ '.number_format($this->sum_cash_simo_co, 2, ',', '.').'</span>';
                })
                ->addColumn('sum_mancia_cli', function ($data) {
                    $text_danger = '';
                    $tot = $this->sum_mancia_cli;
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
        } else {
            return response([
                'draw'  => 0,
                'recordsTotal'    => 0,
                'recordsFiltered' => 0,
                'data'            => [],
                'error'           => 'Non ci sono prenotazioni per il mese selezionato!',
            ]);
        }


    }

}
