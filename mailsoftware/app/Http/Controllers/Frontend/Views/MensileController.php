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

class MensileController extends Controller
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

        return view('frontend.viste.mensile')
            ->with(compact('houses_color'))
            ->with(compact('years'))
            ->with(compact('months'))
            ->with(compact('sites_kross'))
            ->with(compact('sites_array'))
            ->with(compact('op_check_out'))
            ->with(compact('houses_typo'));
    }

    public function indexOperatori()
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

        return view('frontend.viste.mensile.operatori')
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
        $this->sum_costo_cin = ($data->sum('costi_check_in_self_check_in') + $data->sum('tx_mask_t3_p_s_extra_checkin'));
        $this->sum_supervisor_pulizie = $data->sum('tx_mask_t3_p_extra_p');
        $this->sum_costo_co = $data->sum('costo_co');
        $this->sum_ex_co = $data->sum('tx_mask_t3_p_s_ex_checkout');
        $this->sum_cash_operatore_co = $data->sum('tx_mask_t3_p_cash_op_cout');
        $this->sum_cash_simo_co = $data->sum('tx_mask_t3_p_cash_simo');
        $this->sum_mancia_cli = $data->sum('mancia_cli');

        if($data->count() > 0){
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
        } else {
            return response([
                'draw'              => 0,
                'recordsTotal'      => 0,
                'recordsFiltered'   => 0,
                'data'              => [],
                'error'             => 'Non ci sono prenotazioni per il mese selezionato!',
            ]);
        }


    }

    public function getDataOperatori(Request $request)
    {
        $month = $request->month ? $request->month : now()->month;
        $year = $request->year ? $request->year : now()->year;

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
        $this->sum_costi_costo_kit = $data->sum('costi_costo_kit');

        if($data->count() > 0){
            return Datatables::of($data)
                ->addColumn('note_alert', function ($row) {
                    $note_alert = '';
                    if($row->tx_mask_t1_op_note)
                        $note_alert = '<span class="badge badge-warning"><i class="fas fa-exclamation" aria-hidden="true"></i> note</span>';

                    if($row->tx_mask_t1_op_chechin != 21)
                        $note_alert = '<span class="badge badge-warning"><i class="fas fa-exclamation" aria-hidden="true"></i> Check-In</span>';
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

                    return '<span class="font-weight-bolder"> '.$row->tx_mask_t1_ore_pulizie.'</span> (€ '.number_format($row->costo_orario, 2, ',', '.').')';
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
                ->addColumn('costo_extra_op_bi', function($row) {
                    return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t1_op_costo_extra_cambio_biancheria, 2, ',', '.').'</span>';
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
                ->addColumn('kit_base', function ($row){
                    $kit_base = '<p class="text-danger text-uppercase">Selezionare Biancheria su Typo3</p>';
                    if($row->tx_mask_t2_p_bianc){
                        $typo_el_bianc = Typo::select('uid','header', 'subheader', 'tx_mask_bianc_tradit', 'tx_mask_bianc_traden', 'tx_mask_t1_bianc_qy_m', 'tx_mask_t1_bianc_qy_s', 'tx_mask_t1_bianc_qy_ba', 'tx_mask_t1_bianc_qy_v', 'tx_mask_t1_bianc_qy_f', 'tx_mask_t1_bianc_qy_bi')
                            ->where('Ctype', 'mask_db_alg_el_bianc')
                            ->where('uid',$row->tx_mask_t2_p_bianc)
                            ->first();

                        $kit_base = $typo_el_bianc->header .' [<span class="">€ '.number_format($row->costi_costo_kit, 2, ',', '.').'</span>]';
                    }

                    $lenzuola = '';
                    $asciugamani = '';
                    $cambio = '';
                    $icon = '';
                    $span = '';

                    if($row->tx_mask_t2_p_cambi_l > 0 || $row->tx_mask_t2_p_cambi_a > 0){
                        $icon = '<span class="badge badge-warning costi"><i class="fa fa-copyright"></i><span class="font-weight-bolder">';
                        $span = '</span>';
                    }


                    if($row->tx_mask_t2_p_cambi_l > 0)
                        $lenzuola = $row->tx_mask_t2_p_cambi_l.' Len';

                    if($row->tx_mask_t2_p_cambi_a > 0)
                        $asciugamani = $row->tx_mask_t2_p_cambi_a .' Asc';

                    if($row->costi_costo_cambi > 0)
                        $cambio = ' <span class="font-size-xs">['.number_format($row->costi_costo_cambi, 2, ',', '.').']</span>';

                    return $kit_base . '</br>' . $icon . ' ' . $lenzuola . ' ' . $asciugamani . $span . $cambio . $span;

                })
                ->rawColumns([
                    'note_alert', 'header', 'data_arrivo', 'data_partenza', 'city_tax','costo_orario', 'totale_pulizie', 'supervisor_pulizie',
                    'cash_operatore_co', 'cash_simo_co', 'costo_co', 'costo_extra_op_bi', 'costo_ex_co',
                    'mancia_cli', 'mancia_cli_or', 'extra_cash_ospite', 'costi_costo_operatore_cambio_biancheria',
                    'sum_tot_pulizie', 'sum_supervisor_pulizie', 'sum_costo_co',
                    'sum_ex_co', 'sum_cash_operatore_co', 'sum_cash_simo_co',
                    'sum_mancia_cli', 'extra_mondezza', 'kit_base'
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

    public function indexTotaliOperatori(Request $request)
    {
        $typo = new Typo();
        $years = $this->getYears();
        $months = $typo->months;

        return view('frontend.viste.mensile.totali_operatori')
            ->with(compact('years'))
            ->with(compact('months'));
    }

    private $costi_check_in_self_check_in = 0;
    private $tx_mask_t3_p_s_extra_checkin = 0;
    private $totale_pulizie = 0;
    private $supervisor_pulizie = 0;
    private $costo_co = 0;
    private $extra_co = 0;
    private $cash_op_co = 0;
    private $costi_costo_operatore_cambio_biancheria = 0;

    public function getDataTotaliOperatori(Request $request)
    {
        $month = $request->month ? $request->month : now()->month;
        $year = $request->year ? $request->year : now()->year;

        $check_in = Booking::select('tx_mask_t1_op_chechin')
            ->selectRaw('SUM(costi_check_in_self_check_in) as costi_check_in_self_check_in')
            ->selectRaw('SUM(tx_mask_t3_p_s_extra_checkin) as tx_mask_t3_p_s_extra_checkin ')
            ->where(Typo::raw('YEAR(tx_mask_p_data_arrivo)'), '=', $year)
            ->where(Typo::raw('MONTH(tx_mask_p_data_arrivo)'), '=', $month)
            ->where('tx_mask_cod_reservation_status', '!=', "CANC")
            ->groupBy('tx_mask_t1_op_chechin')
            ->get();

        $pulizie = Booking::select('tx_mask_t1_op_pulizie')
            ->selectRaw('SUM(totale_pulizie) as totale_pulizie')
            ->selectRaw('SUM(tx_mask_t3_p_extra_p) as supervisor_pulizie ')
            ->where(Typo::raw('YEAR(tx_mask_p_data_arrivo)'), '=', $year)
            ->where(Typo::raw('MONTH(tx_mask_p_data_arrivo)'), '=', $month)
            ->where('tx_mask_cod_reservation_status', '!=', "CANC")
            ->groupBy('tx_mask_t1_op_pulizie')
            ->get();

        $check_out = Booking::select('tx_mask_t1_op_checkout')
                ->selectRaw('SUM(costo_co) as costo_co')
                ->selectRaw('SUM(tx_mask_t3_p_s_ex_checkout) as extra_co')
                ->selectRaw('SUM(tx_mask_t3_p_cash_op_cout) as cash_op_co')
            ->where(Typo::raw('YEAR(tx_mask_p_data_partenza)'), '=', $year)
            ->where(Typo::raw('MONTH(tx_mask_p_data_partenza)'), '=', $month)
            ->where('tx_mask_cod_reservation_status', '!=', "CANC")
            ->groupBy('tx_mask_t1_op_checkout')
            ->get();

        $cambi = Booking::select('tx_mask_t1_op_cambio_biancheria')
            ->selectRaw('SUM(costi_costo_operatore_cambio_biancheria) as costi_costo_operatore_cambio_biancheria')
            ->where(Typo::raw('YEAR(tx_mask_p_data_partenza)'), '=', $year)
            ->where(Typo::raw('MONTH(tx_mask_p_data_partenza)'), '=', $month)
            ->where('tx_mask_cod_reservation_status', '!=', "CANC")
            ->groupBy('tx_mask_t1_op_cambio_biancheria')
            ->get();

        $operators = Operator::all();
        $data = new Collection;

        $operators->each(function ($operator) use ($data, $check_in, $pulizie, $check_out, $cambi){

            if($check_in->contains('tx_mask_t1_op_chechin', $operator->uid)){
                $this->costi_check_in_self_check_in = $check_in->where('tx_mask_t1_op_chechin', $operator->uid)->first()->costi_check_in_self_check_in;
                $this->tx_mask_t3_p_s_extra_checkin = $check_in->where('tx_mask_t1_op_chechin', $operator->uid)->first()->tx_mask_t3_p_s_extra_checkin;
            } else {
                $this->costi_check_in_self_check_in = 0;
                $this->tx_mask_t3_p_s_extra_checkin = 0;
            }

            if($pulizie->contains('tx_mask_t1_op_pulizie', $operator->uid)){
                $this->totale_pulizie = $pulizie->where('tx_mask_t1_op_pulizie', $operator->uid)->first()->totale_pulizie;
                $this->supervisor_pulizie = $pulizie->where('tx_mask_t1_op_pulizie', $operator->uid)->first()->supervisor_pulizie;
            } else {
                $this->totale_pulizie = 0;
                $this->supervisor_pulizie = 0;
            }

            if($check_out->contains('tx_mask_t1_op_checkout', $operator->uid)){
                $this->costo_co = $check_out->where('tx_mask_t1_op_checkout', $operator->uid)->first()->costo_co;
                $this->extra_co = $check_out->where('tx_mask_t1_op_checkout', $operator->uid)->first()->extra_co;
                $this->cash_op_co = $check_out->where('tx_mask_t1_op_checkout', $operator->uid)->first()->cash_op_co;
            } else {
                $this->costo_co = 0;
                $this->extra_co = 0;
                $this->cash_op_co = 0;
            }

            if($cambi->contains('tx_mask_t1_op_cambio_biancheria', $operator->uid)){
                $this->costi_costo_operatore_cambio_biancheria = $cambi->where('tx_mask_t1_op_cambio_biancheria', $operator->uid)->first()->costi_costo_operatore_cambio_biancheria;
            } else {
                $this->costi_costo_operatore_cambio_biancheria = 0;
            }

            if ($this->costi_check_in_self_check_in || $this->tx_mask_t3_p_s_extra_checkin ||$this->totale_pulizie > 0 || $this->supervisor_pulizie > 0 || $this->costo_co > 0 || $this->extra_co > 0 || $this->cash_op_co > 0 || $this->costi_costo_operatore_cambio_biancheria > 0) {
                $data->push([
                    'uid' => $operator->uid,
                    'costi_check_in_self_check_in' => $this->costi_check_in_self_check_in,
                    'tx_mask_t3_p_s_extra_checkin' => $this->tx_mask_t3_p_s_extra_checkin,
                    'totale_pulizie' => $this->totale_pulizie,
                    'supervisor_pulizie' => $this->supervisor_pulizie,
                    'costo_co' => $this->costo_co,
                    'extra_co' => $this->extra_co,
                    'cash_op_co' => $this->cash_op_co,
                    'costi_costo_operatore_cambio_biancheria' => $this->costi_costo_operatore_cambio_biancheria,
                ]);
            }

        });

        $data = $data->sortBy([
            ['costi_check_in_self_check_in', 'desc'],
            ['tx_mask_t3_p_s_extra_checkin', 'desc'],
            ['totale_pulizie', 'desc'],
            ['supervisor_pulizie', 'desc'],
            ['costo_co', 'desc'],
            ['extra_co', 'desc'],
            ['cash_op_co', 'desc'],
            ['costi_costo_operatore_cambio_biancheria', 'desc'],
        ]);

        return Datatables::of($data)
            ->addColumn('uid', function ($row) {
                $users = $this->getUsersArray();
                $user = $users[$row['uid']] ? $users[$row['uid']] : $row->uid;
                return '<a href="#" data-toggle="tooltip"  class="text-dark-75 text-hover-primary mb-1 font-size-lg text-capitalize text-left">' . $user . '</a>';
            })
            ->addColumn('costi_cin', function ($row) {
                $costi_cin = $row['costi_check_in_self_check_in'] + $row['tx_mask_t3_p_s_extra_checkin'];
                return '<span class="'. ($costi_cin > 0 ? 'font-weight-bolder' : '') .'">€ '.number_format($costi_cin, 2, ',', '.').'</span>';
            })
            ->addColumn('totale_pulizie', function ($row) {
                return '<span class="'. ($row['totale_pulizie'] > 0 ? 'font-weight-bolder' : '') .'">€ '.number_format($row['totale_pulizie'], 2, ',', '.').'</span>';
            })
            ->addColumn('supervisor_pulizie', function ($row) {
                return '<span class="'. ($row['supervisor_pulizie'] > 0 ? 'font-weight-bolder' : '') .'">€ '.number_format($row['supervisor_pulizie'], 2, ',', '.').'</span>';
            })
            ->addColumn('costo_co', function ($row) {
                return '<span class="'. ($row['costo_co'] > 0 ? 'font-weight-bolder' : '') .'">€ '.number_format($row['costo_co'], 2, ',', '.').'</span>';
            })
            ->addColumn('extra_co', function ($row) {
                return '<span class="'. ($row['extra_co'] > 0 ? 'font-weight-bolder' : '') .'">€ '.number_format($row['extra_co'], 2, ',', '.').'</span>';
            })
            ->addColumn('cash_op_co', function ($row) {
                return '<span class="'. ($row['cash_op_co'] > 0 ? 'font-weight-bolder' : '') .'">€ '.number_format($row['cash_op_co'], 2, ',', '.').'</span>';
            })
            ->addColumn('costi_costo_operatore_cambio_biancheria', function ($row) {
                return '<span class="'. ($row['costi_costo_operatore_cambio_biancheria'] > 0 ? 'font-weight-bolder' : '') .'">€ '.number_format($row['costi_costo_operatore_cambio_biancheria'], 2, ',', '.').'</span>';
            })
            ->rawColumns([
                'uid', 'costi_cin', 'totale_pulizie', 'supervisor_pulizie', 'costo_co', 'extra_co', 'cash_op_co', 'costi_costo_operatore_cambio_biancheria'
            ])
            ->make(true);

    }

}
