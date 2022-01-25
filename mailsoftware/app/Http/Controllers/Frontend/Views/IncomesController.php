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

        $this->sum_tot_stay = $data->sum('tx_mask_t3_p_stay');
        $this->sum_saldo_cash = $data->sum('tx_mask_t3_p_s_chin');


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
            ->addColumn('stay', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_stay, 2, ',', '.').'</span>';
            })
            ->addColumn('chin', function($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_s_chin, 2, ',', '.').'</span>';
            })
            ->rawColumns([
                'note_alert', 'header', 'data_arrivo', 'data_partenza', 'stay', 'chin'
            ])
            ->make(true);
    }
}
