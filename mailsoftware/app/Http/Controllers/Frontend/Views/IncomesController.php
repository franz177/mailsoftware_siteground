<?php

namespace App\Http\Controllers\Frontend\Views;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\House;
use App\Models\Operator;
use App\Models\Typo;
use App\Models\TypoHouses;
use App\Models\TypoRange;
use App\Models\TypoRangeMM;
use App\Models\TypoUser;
use App\Models\TypoCHouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;

class IncomesController extends Controller
{
    protected $CType = 'mask_db_alg_pren';

    private $sum_costo_cin;
    private $sum_tot_pulizie;
    private $sum_supervisor_pulizie;
    private $sum_costo_co;
    private $sum_ex_co;
    private $sum_cash_operatore_co;
    private $sum_cash_simo_co;
    private $sum_mancia_cli;
    private $sum_costi_costo_kit;

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

        return view('frontend.incomes.index')
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
        $house = $request->house ? $request->house : NULL;

        $data = Booking::where(function ($q) use ($year) {
                $q->where(Typo::raw('YEAR(tx_mask_p_data_arrivo)'), '=', $year)
                    ->orWhere(Typo::raw('YEAR(tx_mask_p_data_partenza)'), '=', $year);
            })
            ->where(function ($q) use ($month) {
                $q->where(Typo::raw('MONTH(tx_mask_p_data_arrivo)'), '=', $month)
                    ->orWhere(Typo::raw('MONTH(tx_mask_p_data_partenza)'), '=', $month);
            })
            ->when($house, function ($q, $house){
                return $q->whereIn('tx_mask_p_casa', $house);
            })
            ->where('tx_mask_cod_reservation_status', '!=', "CANC")
            ->orderBy('tx_mask_p_data_arrivo', 'ASC')
            ->orderBy('tx_mask_p_data_partenza', 'ASC')
            ->get();

        $this->sum_tot_pulizie = $data->sum('totale_pulizie');
        $this->sum_costo_cin = ($data->sum('costi_check_in_self_check_in') + $data->sum('tx_mask_t3_p_s_extra_checkin'));
        $this->sum_supervisor_pulizie = $data->sum('tx_mask_t3_p_extra_p');
        $this->sum_costo_co = $data->sum('costo_co');
        $this->sum_ex_co = $data->sum('tx_mask_t3_p_s_ex_checkout');
        $this->sum_cash_operatore_co = $data->sum('tx_mask_t3_p_cash_op_cout');
        $this->sum_cash_simo_co = $data->sum('tx_mask_t3_p_cash_simo');
        $this->sum_mancia_cli = $data->sum('mancia_cli');


        return Datatables::of($data)
            ->addColumn('note_alert', function ($row) {
                $note_alert = '';
                if($row->tx_mask_t1_op_note)
                    $note_alert = '<span class="badge badge-warning"><i class="fas fa-exclamation" aria-hidden="true"></i> note</span>';
                return $note_alert;
            })
            ->addColumn('header', function ($row) {
                $header = preg_replace('/(\([a-zA-Z0-9\s]+\)\s?)/', '', $row->header);
                return '<a href="#" data-toggle="tooltip"  class="text-dark-75 text-hover-primary mb-1 font-size-lg text-capitalize text-left">' . $header . '</a>';
            })
            ->addColumn('data_arrivo', function ($row){
                $h = $row->tx_mask_t1_ora_checkin ? $row->tx_mask_t1_ora_checkin : '<span class="text-danger">NaN</span>';
                $arrivo = Carbon::createFromFormat('d-m-y', $row->tx_mask_p_data_arrivo)->format('Y-m-d');
                $partenza = Carbon::createFromFormat('d-m-y', $row->tx_mask_p_data_partenza)->format('Y-m-d');
                $arrivo = Carbon::parse($arrivo);
                $partenza = Carbon::parse($partenza);
                $diff = $partenza->diffInDays($arrivo);
                return $row->tx_mask_p_data_arrivo . ' </br> <span class="text-dark-75">h</span> '. $h . ' <i class="fas fa-moon text-dark-75"></i> '. $diff ;
            })
            ->addColumn('data_partenza', function ($row){
                $h = $row->tx_mask_t1_ora_checkout ? $row->tx_mask_t1_ora_checkout : '<span class="text-danger">NaN</span>';
                return $row->tx_mask_p_data_partenza . ' </br> <span class="text-dark-75">h</span> '. $h;
            })
            ->addColumn('city_tax', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_city_tax_amount, 2, ',', '.').'</span>';
            })
            ->addColumn('costo_orario', function($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->costo_orario, 2, ',', '.').'</span>';
            })
            ->addColumn('costo_cin', function ($row) {
                $costo_cin = $row->costi_check_in_self_check_in + $row->tx_mask_t3_p_s_extra_checkin;
                return '<span class="font-weight-bolder">€ '.number_format($costo_cin, 2, ',', '.').'</span>';
            })
            ->addColumn('totale_pulizie', function($row) {
                if($row->totale_pulizie == 0)
                    return '<span class="text-danger">Metti le ore!</span>';

                return '<span class="font-weight-bolder">€ '.number_format($row->totale_pulizie, 2, ',', '.').'</span>';
            })
            ->addColumn('supervisor_pulizie', function($row) {
                if($row->tx_mask_t0_fattura)
                    return $row->tx_mask_t0_fattura .'<br><span class="font-weight-bolder">&euro; '. number_format($row->tx_mask_t3_p_extra_p, 2, ',', '.') .'</span>';

                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_extra_p, 2, ',', '.').'</span>';
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
            ->addColumn('costi_extra_op_bi', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t1_op_costo_extra_cambio_biancheria, 2, ',', '.').'</span>';
            })
            ->addColumn('costi_costo_operatore_cambio_biancheria', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->costi_costo_operatore_cambio_biancheria, 2, ',', '.').'</span>';
            })
            ->addColumn('sum_tot_costo_cin', function ($data) {
                return '<span class="font-weight-bolder">€ '.number_format($this->sum_costo_cin, 2, ',', '.').'</span>';
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
            ->addColumn('totale_riga', function ($row) {
                $totale =
                    $row->costi_check_in_self_check_in +
                    $row->tx_mask_t3_p_s_extra_checkin +
                    $row->totale_pulizie +
                    $row->tx_mask_t3_p_extra_p +
                    $row->costo_co +
                    $row->tx_mask_t3_p_s_ex_checkout +
                    $row->costi_costo_operatore_cambio_biancheria +
                    $row->tx_mask_t1_op_costo_extra_cambio_biancheria +
                    $row->costi_costo_kit +
                    $row->costi_costo_cambi

                ;
                return '<span class="font-weight-bolder">€ '.number_format($totale, 2, ',', '.').'</span>';
            })
            ->addColumn('extra_mondezza', function ($data) {
                return '';
            })
            ->rawColumns([
                'note_alert', 'header', 'data_arrivo', 'data_partenza', 'city_tax','costo_orario', 'costo_cin', 'totale_pulizie', 'supervisor_pulizie',
                'cash_operatore_co', 'cash_simo_co', 'costo_co', 'costo_ex_co',
                'mancia_cli', 'mancia_cli_or', 'extra_cash_ospite', 'costi_extra_op_bi', 'costi_costo_operatore_cambio_biancheria',
                'sum_tot_costo_cin', 'sum_tot_pulizie', 'sum_supervisor_pulizie', 'sum_costo_co',
                'sum_ex_co', 'sum_cash_operatore_co', 'sum_cash_simo_co',
                'sum_mancia_cli', 'extra_mondezza', 'totale_riga'
            ])
            ->make(true);
    }
}
