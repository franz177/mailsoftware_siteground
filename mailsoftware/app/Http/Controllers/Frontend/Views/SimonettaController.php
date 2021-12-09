<?php

namespace App\Http\Controllers\Frontend\Views;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Typo;
use App\Models\TypoCHouse;
use App\Models\TypoRange;
use App\Models\TypoRangeMM;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SimonettaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = 'Vista in costruzione';
        return view('frontend.viste.mensile.simonetta')->with(compact('message'));
    }

    private $sum_costo_cin;
    private $sum_tot_pulizie;
    private $sum_tot_costo_co;
    private $sum_tot_op_cambio;
    private $sum_tot_extra_co;
    private $sum_tot_commissioni_sitiweb;
    private $sum_tot_supervisor_pulizie;
    private $sum_tot_totale_biancheria;
    private $sum_row;
    private $sum_tot_totale_row;

    public function getDataTables(Request $request)
    {
        $year = $request->year ? $request->year : now()->year;

        $data = Booking::select([
            Booking::raw('MONTH(tx_mask_p_data_arrivo) as monthed'),
            Booking::raw('MONTHNAME(STR_TO_DATE(MONTH(tx_mask_p_data_arrivo), "%m")) as month'),
            Booking::raw('SUM(costi_check_in_self_check_in) as costi_check_in_self_check_in'),
            Booking::raw('SUM(tx_mask_t3_p_s_extra_checkin) as tx_mask_t3_p_s_extra_checkin'),
            Booking::raw('SUM(totale_pulizie) as totale_pulizie'),
            Booking::raw('SUM(tx_mask_t3_p_extra_p) as tx_mask_t3_p_extra_p'),
            Booking::raw('SUM(costo_co) as costo_co'),
            Booking::raw('SUM(costi_costo_operatore_cambio_biancheria) as costi_costo_operatore_cambio_biancheria'),
            Booking::raw('SUM(tx_mask_t1_op_costo_extra_cambio_biancheria) as tx_mask_t1_op_costo_extra_cambio_biancheria'),
            Booking::raw('SUM(tx_mask_t3_p_s_ex_checkout) as tx_mask_t3_p_s_ex_checkout'),
            Booking::raw('(SUM(costi_costo_kit) + SUM(costi_costo_cambi)) as totale_biancheria')
            ])
            ->where(function ($q) use ($year) {
            $q->where(Typo::raw('YEAR(tx_mask_p_data_arrivo)'), '=', $year)
                ->orWhere(Typo::raw('YEAR(tx_mask_p_data_partenza)'), '=', $year);
            })
            ->where('tx_mask_cod_reservation_status', '!=', "CANC")
            ->orderBy('monthed', 'ASC')
//            ->orderBy('tx_mask_p_data_partenza', 'ASC')
            ->groupBy(Booking::raw('MONTH(tx_mask_p_data_arrivo)'))
            ->get();

        return Datatables::of($data)
            ->addColumn('month', function ($row) {
                return ucwords($row->month);
            })
            ->addColumn('costo_cin', function ($row) {
                $costo_cin = $row->costi_check_in_self_check_in + $row->tx_mask_t3_p_s_extra_checkin;
                return '<span class='. ($costo_cin > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($costo_cin, 2, ',', '.').'</span>';
            })
            ->addColumn('totale_pulizie', function ($row) {
                return '<span class='. ($row->totale_pulizie > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($row->totale_pulizie, 2, ',', '.').'</span>';
            })
            ->addColumn('supervisor_pulizie', function($row) {
                return '<span class='. ($row->tx_mask_t3_p_extra_p > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($row->tx_mask_t3_p_extra_p, 2, ',', '.').'</span>';
            })
            ->addColumn('costo_co', function ($row) {
                $tot_costo_co = $row->costo_co + $row->tx_mask_t3_p_s_ex_checkout;
                return '<span class='. ($tot_costo_co > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($tot_costo_co, 2, ',', '.').'</span>';
            })
            ->addColumn('costi_costo_operatore_cambio_biancheria', function ($row) {
                $totale = $row->tx_mask_t1_op_costo_extra_cambio_biancheria + $row->costi_costo_operatore_cambio_biancheria;
                return '<span class='. ($totale > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($totale, 2, ',', '.').'</span>';
            })
            ->addColumn('tx_mask_t3_p_s_ex_checkout', function ($row) {
                return '<span class='. ($row->tx_mask_t3_p_s_ex_checkout > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($row->tx_mask_t3_p_s_ex_checkout, 2, ',', '.').'</span>';
            })
            ->addColumn('tx_mask_p_perc_importo_fisso', function ($row) {
                return '<span class='. ($row->tx_mask_p_perc_importo_fisso > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($row->tx_mask_p_perc_importo_fisso, 2, ',', '.').'</span>';
            })
            ->addColumn('totale_biancheria', function ($row) {
                return '<span class='. ($row->totale_biancheria > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($row->totale_biancheria, 2, ',', '.').'</span>';
            })
            ->addColumn('sum_row', function ($row) {
                $this->sum_row =
                    $row->costi_check_in_self_check_in + $row->tx_mask_t3_p_s_extra_checkin +
                    $row->totale_pulizie +
                    $row->tx_mask_t3_p_extra_p +
                    $row->costo_co + $row->tx_mask_t3_p_s_ex_checkout +
                    $row->tx_mask_t1_op_costo_extra_cambio_biancheria + $row->costi_costo_operatore_cambio_biancheria +
                    $row->tx_mask_p_perc_importo_fisso +
                    $row->totale_biancheria;
                return '<span class='. ($this->sum_row > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($this->sum_row, 2, ',', '.').'</span>';
            })
            ->addColumn('sum_costo_cin', function ($row) {
                $costo_cin = $row->costi_check_in_self_check_in + $row->tx_mask_t3_p_s_extra_checkin;
                $this->sum_costo_cin = $this->sum_costo_cin + $costo_cin;
                return '<span class='. ($this->sum_costo_cin > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($this->sum_costo_cin, 2, ',', '.').'</span>';
            })
            ->addColumn('sum_tot_pulizie', function ($row) {
                $this->sum_tot_pulizie = $this->sum_tot_pulizie + $row->totale_pulizie;
                return '<span class='. ($this->sum_tot_pulizie > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($this->sum_tot_pulizie, 2, ',', '.').'</span>';
            })
            ->addColumn('sum_tot_extra_co', function ($row) {
                $this->sum_tot_extra_co = $this->sum_tot_extra_co + $row->tx_mask_t3_p_s_ex_checkout;
                return '<span class='. ($this->sum_tot_extra_co > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($this->sum_tot_extra_co, 2, ',', '.').'</span>';
            })
            ->addColumn('sum_tot_costo_co', function ($row) {
                $this->sum_tot_costo_co = $this->sum_tot_costo_co + $row->costo_co;
                $tot_sum_tot_costo_co = $this->sum_tot_costo_co + $this->sum_tot_extra_co;
                return '<span class='. ($tot_sum_tot_costo_co > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($tot_sum_tot_costo_co, 2, ',', '.').'</span>';
            })
            ->addColumn('sum_tot_op_cambio', function ($row) {
                $this->sum_tot_op_cambio = $this->sum_tot_op_cambio + $row->tx_mask_t1_op_costo_extra_cambio_biancheria + $row->costi_costo_operatore_cambio_biancheria;
                return '<span class='. ($this->sum_tot_op_cambio > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($this->sum_tot_op_cambio, 2, ',', '.').'</span>';
            })
            ->addColumn('sum_tot_commissioni_sitiweb', function ($row) {
                $this->sum_tot_commissioni_sitiweb = $this->sum_tot_commissioni_sitiweb + $row->tx_mask_p_perc_importo_fisso;
                return '<span class='. ($this->sum_tot_commissioni_sitiweb > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($this->sum_tot_commissioni_sitiweb, 2, ',', '.').'</span>';
            })
            ->addColumn('sum_tot_supervisor_pulizie', function ($row) {
                $this->sum_tot_supervisor_pulizie = $this->sum_tot_supervisor_pulizie + $row->tx_mask_t3_p_extra_p;
                return '<span class='. ($this->sum_tot_supervisor_pulizie > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($this->sum_tot_supervisor_pulizie, 2, ',', '.').'</span>';
            })
            ->addColumn('sum_tot_totale_biancheria', function ($row) {
                $this->sum_tot_totale_biancheria = $this->sum_tot_totale_biancheria + $row->totale_biancheria;
                return '<span class="font-weight-bolder">€ '.number_format($this->sum_tot_totale_biancheria, 2, ',', '.').'</span>';
            })
            ->addColumn('sum_tot_totale_row', function ($row) {
                $this->sum_tot_totale_row = $this->sum_tot_totale_row + $this->sum_row;
                return '<span class="font-weight-bolder">€ '.number_format($this->sum_tot_totale_row, 2, ',', '.').'</span>';
            })

            ->rawColumns([
                'month', 'costo_cin', 'totale_pulizie', 'supervisor_pulizie', 'costo_co', 'costi_costo_operatore_cambio_biancheria',
                'tx_mask_t3_p_s_ex_checkout', 'tx_mask_p_perc_importo_fisso', 'totale_biancheria', 'sum_row',
                'sum_costo_cin', 'sum_tot_pulizie', 'sum_tot_costo_co' , 'sum_tot_op_cambio', 'sum_tot_extra_co',
                'sum_tot_commissioni_sitiweb', 'sum_tot_supervisor_pulizie', 'sum_tot_totale_biancheria', 'sum_tot_totale_row'
            ])
            ->make(true);
    }

}
