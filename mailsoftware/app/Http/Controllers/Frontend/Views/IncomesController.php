<?php

namespace App\Http\Controllers\Frontend\Views;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\House;
use App\Models\Typo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IncomesController extends Controller
{
    protected $CType = 'mask_db_alg_pren';

    private const SOLO_EXTRA = 'tx_mask_t3_p_cash_op_cout + tx_mask_t3_p_cash_simo - tx_mask_t3_p_city_tax_amount';
    private const LORDO = 'tx_mask_t3_p_stay + tx_mask_t3_p_s_checkout';

    private $sum_tot_lordo_incassi;
    private $sum_importo_stay;
    private $sum_perc_importo_fisso;
    private $sum_cleaning_fee_amount;
    private $sum_city_tax_amount;
    private $sum_s_checkout;
    private $sum_cash_op_cout;
    private $sum_cash_simo;
    private $sum_solo_extra;
    private $sum_stay_extra;
    private $sum_s_chin;
    private $sum_s_b;
    private $sum_kross_payment_total_amount;
    private $sum_banca1;
    private $sum_c_p;
    private $avg_c_m;

    private function htmlBalance($arg)
    {
        return '<span class=' . ($arg > 0 ? "font-weight-bolder" : ($arg < 0 ? '"text-danger font-weight-bold"' : "font-weight-normal")) . '>' . number_format($arg, 2, ',', '.') . '</span>';
    }

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

        return view('frontend.incassi.index')
            ->with(compact('houses_color'))
            ->with(compact('years'))
            ->with(compact('months'))
            ->with(compact('sites_kross'))
            ->with(compact('sites_array'))
            ->with(compact('op_check_out'))
            ->with(compact('houses_typo'));
    }

    public function indexAnnualeMesi()
    {
        $typo = new Typo();
        $houses_typo = $this->getHousesAbbrArray();
        $years = $this->getYears();

        $op_check_out = $this->getUsersArray();

        return view('frontend.incassi.annuale_mesi')
            ->with(compact('years'))
            ->with(compact('houses_typo'));
    }

    public function getDataTablesMonths(Request $request)
    {
        $year = $request->year ? $request->year : now()->year;
        $house = $request->house ? $request->house : NULL;

        $data =
            Booking::select([
                Booking::raw('MONTH(tx_mask_p_data_arrivo) as monthed'),
                Booking::raw('MONTHNAME(STR_TO_DATE(MONTH(tx_mask_p_data_arrivo), "%m")) as month'),
                Booking::raw('SUM(tx_mask_t3_p_stay) as importo_stay'),
                Booking::raw('SUM(tx_mask_p_perc_importo_fisso) as perc_importo_fisso'),
                Booking::raw('SUM(tx_mask_t3_p_cleaning_fee_amount) as cleaning_fee_amount'),
                Booking::raw('SUM(tx_mask_t3_p_city_tax_amount) as city_tax_amount'),
                Booking::raw('SUM(tx_mask_t3_p_s_checkout) as s_checkout'),
                Booking::raw('SUM(tx_mask_t3_p_cash_op_cout) as cash_op_cout'),
                Booking::raw('SUM(tx_mask_t3_p_cash_simo) as cash_simo'),
                Booking::raw('SUM(' . self::SOLO_EXTRA . ') as solo_extra'),
                Booking::raw('SUM(' . self::LORDO . ') as tot_lordo_incassi'),
                Booking::raw('SUM(tx_mask_t5_kross_payment_total_amount + ' . self::SOLO_EXTRA . ' - tx_mask_p_perc_importo_fisso ) as stay_extra'),
                Booking::raw('SUM(tx_mask_t3_p_s_chin) as s_chin'),
                Booking::raw('SUM(tx_mask_t3_p_s_b) as s_b'),
                // Booking::raw('CONCAT("[",GROUP_CONCAT(tx_mask_t5_kross_payments SEPARATOR ","),"]") as kross_payments_json'),
                Booking::raw('SUM(tx_mask_t5_kross_payment_total_amount) as kross_payment_total_amount'),
                Booking::raw('SUM(tx_mask_t3_p_stay - tx_mask_t3_p_s_b) as banca1'),
                Booking::raw('SUM(tx_mask_t5_kross_payment_total_amount + ' . self::SOLO_EXTRA . ' - (' . self::LORDO . ')) as c_p'),
                Booking::raw('AVG(prop_costo_medio_a_notte) as c_m'),
            ])
            ->where(function ($q) use ($year) {
                $q->where(Booking::raw('YEAR(tx_mask_p_data_arrivo)'), '=', $year);
                // ->orWhere(Typo::raw('YEAR(tx_mask_p_data_partenza)'), '=', $year);
            })
            ->when($house, function ($q, $house) {
                return $q->whereIn('tx_mask_p_casa', $house);
            })
            ->where('tx_mask_cod_reservation_status', '!=', "CANC")
            ->orderBy('monthed', 'ASC')
            ->groupBy(Booking::raw('MONTH(tx_mask_p_data_arrivo)'))
            ->get();

        $this->sum_tot_lordo_incassi = $data->sum('tot_lordo_incassi');
        $this->sum_importo_stay = $data->sum('importo_stay');
        $this->sum_perc_importo_fisso = $data->sum('perc_importo_fisso');
        $this->sum_cleaning_fee_amount = $data->sum('cleaning_fee_amount');
        $this->sum_city_tax_amount = $data->sum('city_tax_amount');
        $this->sum_s_checkout = $data->sum('s_checkout');
        $this->sum_cash_op_cout = $data->sum('cash_op_cout');
        $this->sum_cash_simo = $data->sum('cash_simo');
        $this->sum_solo_extra = $data->sum('solo_extra');
        $this->sum_stay_extra = $data->sum('stay_extra');
        $this->sum_s_chin = $data->sum('s_chin');
        $this->sum_s_b = $data->sum('s_b');
        $this->sum_kross_payment_total_amount = $data->sum('kross_payment_total_amount');
        $this->sum_banca1 = $data->sum('banca1');
        $this->sum_c_p = $data->sum('c_p');
        $this->avg_c_m = $data->avg('c_m');

        return Datatables::of($data)
            ->addColumn('month', function ($row) {
                return ucwords($row->month);
            })
            ->addColumn('tot_lordo_incassi', function ($row) {
                return $this->htmlBalance($row->tot_lordo_incassi);
            })
            ->addColumn('importo_stay', function ($row) {
                return $this->htmlBalance($row->importo_stay);
            })
            ->addColumn('perc_importo_fisso', function ($row) {
                return $this->htmlBalance($row->perc_importo_fisso);
            })
            ->addColumn('cleaning_fee_amount', function ($row) {
                return $this->htmlBalance($row->cleaning_fee_amount);
            })
            ->addColumn('city_tax_amount', function ($row) {
                return $this->htmlBalance($row->city_tax_amount);
            })
            ->addColumn('s_checkout', function ($row) {
                return $this->htmlBalance($row->s_checkout);
            })
            ->addColumn('cash_op_cout', function ($row) {
                return $this->htmlBalance($row->cash_op_cout);
            })
            ->addColumn('cash_simo', function ($row) {
                return $this->htmlBalance($row->cash_simo);
            })
            ->addColumn('solo_extra', function ($row) {
                return $this->htmlBalance($row->solo_extra);
            })
            ->addColumn('stay_extra', function ($row) {
                return $this->htmlBalance($row->stay_extra);
            })
            ->addColumn('banca1', function ($row) {
                return $this->htmlBalance($row->banca1);
            })
            ->addColumn('s_chin', function ($row) {
                return $this->htmlBalance($row->s_chin);
            })
            ->addColumn('s_b', function ($row) {
                return $this->htmlBalance($row->s_b);
            })
            ->addColumn('kross_payment_total_amount', function ($row) {
                // $clean_json = str_replace(',,', ',', $row->kross_payments_json);
                // $dirty_array = json_decode($clean_json);
                // $clean_array = array_filter(
                //     $dirty_array,
                //     function ($item) {
                //         return count($item) > 0;
                //     }
                // );
                // $kross_payments = array_reduce(
                //     $clean_array,
                //     function ($carry, $item) {
                //         return $carry + array_reduce(
                //             $item,
                //             function ($subcarry, $subitem) {
                //                 return $subcarry + $subitem->amount;
                //             },
                //             0
                //         );
                //     },
                //     0
                // );
                // $this->sum_kross_payments += $kross_payments;
                return $this->htmlBalance($row->kross_payment_total_amount);
            })
            ->addColumn('c_p', function ($row) {
                return $this->htmlBalance($row->c_p);
            })
            ->addColumn('c_m', function ($row) {
                return $this->htmlBalance($row->c_m);
            })
            ->addColumn('sum_tot_lordo_incassi', function ($row) {
                return $this->htmlBalance($this->sum_tot_lordo_incassi);
            })
            ->addColumn('sum_importo_stay', function ($row) {
                return $this->htmlBalance($this->sum_importo_stay);
            })
            ->addColumn('sum_perc_importo_fisso', function ($row) {
                return $this->htmlBalance($this->sum_perc_importo_fisso);
            })
            ->addColumn('sum_cleaning_fee_amount', function ($row) {
                return $this->htmlBalance($this->sum_cleaning_fee_amount);
            })
            ->addColumn('sum_city_tax_amount', function ($row) {
                return $this->htmlBalance($this->sum_city_tax_amount);
            })
            ->addColumn('sum_s_checkout', function ($row) {
                return $this->htmlBalance($this->sum_s_checkout);
            })
            ->addColumn('sum_cash_op_cout', function ($row) {
                return $this->htmlBalance($this->sum_cash_op_cout);
            })
            ->addColumn('sum_cash_simo', function ($row) {
                return $this->htmlBalance($this->sum_cash_simo);
            })
            ->addColumn('sum_solo_extra', function ($row) {
                return $this->htmlBalance($this->sum_solo_extra);
            })
            ->addColumn('sum_stay_extra', function ($row) {
                return $this->htmlBalance($this->sum_stay_extra);
            })
            ->addColumn('sum_banca1', function ($row) {
                return $this->htmlBalance($this->sum_banca1);
            })
            ->addColumn('sum_s_chin', function ($row) {
                return $this->htmlBalance($this->sum_s_chin);
            })
            ->addColumn('sum_s_b', function ($row) {
                return $this->htmlBalance($this->sum_s_b);
            })
            ->addColumn('sum_kross_payment_total_amount', function ($row) {
                return $this->htmlBalance($this->sum_kross_payment_total_amount);
            })
            ->addColumn('sum_c_p', function ($row) {
                return $this->htmlBalance($this->sum_c_p);
            })
            ->addColumn('avg_c_m', function ($row) {
                return $this->htmlBalance($this->avg_c_m);
            })
            ->rawColumns([
                'month', 'importo_stay', 'perc_importo_fisso', 'cleaning_fee_amount', 'city_tax_amount',
                's_checkout', 'cash_op_cout', 'cash_simo', 'solo_extra', 'tot_lordo_incassi',
                'stay_extra', 's_chin', 's_b', 'kross_payment_total_amount', 'banca1',
                'c_p', 'c_m',
                'sum_importo_stay', 'sum_tot_lordo_incassi', 'sum_perc_importo_fisso', 'sum_cleaning_fee_amount',
                'sum_city_tax_amount', 'sum_s_checkout', 'sum_cash_op_cout', 'sum_cash_simo', 'sum_solo_extra',
                'sum_stay_extra', 'sum_s_chin', 'sum_s_b', 'sum_kross_payment_total_amount', 'sum_banca1',
                'sum_c_p', 'avg_c_m'
            ])
            ->make(true);
    }

    public function getDataTables(Request $request)
    {
        $month = $request->month ? $request->month : now()->month;
        $year = $request->year ? $request->year : now()->year;
        $house = $request->house ? $request->house : NULL;

        $data =
            Booking::select([
                Booking::raw('tx_mask_t1_op_note'),
                Booking::raw('header'),
                Booking::raw('tx_mask_p_data_arrivo'),
                Booking::raw('tx_mask_p_data_partenza'),
                Booking::raw('tx_mask_p_sito'),
                Booking::raw('tx_mask_p_casa as casa'),
                Booking::raw('tx_mask_t1_ora_checkin'),
                Booking::raw('tx_mask_t1_ora_checkout'),
                Booking::raw('MONTHNAME(STR_TO_DATE(MONTH(tx_mask_p_data_arrivo), "%m")) as month'),
                Booking::raw('(tx_mask_t3_p_stay) as importo_stay'),
                Booking::raw('(tx_mask_p_perc_importo_fisso) as perc_importo_fisso'),
                Booking::raw('(tx_mask_t3_p_cleaning_fee_amount) as cleaning_fee_amount'),
                Booking::raw('(tx_mask_t3_p_city_tax_amount) as city_tax_amount'),
                Booking::raw('(tx_mask_t3_p_s_checkout) as s_checkout'),
                Booking::raw('(tx_mask_t3_p_cash_op_cout) as cash_op_cout'),
                Booking::raw('(tx_mask_t3_p_cash_simo) as cash_simo'),
                Booking::raw('(' . self::SOLO_EXTRA . ') as solo_extra'),
                Booking::raw('(' . self::LORDO . ') as tot_lordo_incassi'),
                Booking::raw('(tx_mask_t5_kross_payment_total_amount + ' . self::SOLO_EXTRA . ' - tx_mask_p_perc_importo_fisso ) as stay_extra'),
                Booking::raw('(tx_mask_t3_p_s_chin) as s_chin'),
                Booking::raw('(tx_mask_t3_p_s_b) as s_b'),
                Booking::raw('(tx_mask_t5_kross_payments) as kross_payments_json'),
                Booking::raw('(tx_mask_t5_kross_payment_total_amount) as kross_payment_total_amount'),
                Booking::raw('(tx_mask_t3_p_stay - tx_mask_t3_p_s_b) as banca1'),
                Booking::raw('(tx_mask_t5_kross_payment_total_amount + ' . self::SOLO_EXTRA . ' - (' . self::LORDO . ')) as c_p'),
                Booking::raw('(prop_costo_medio_a_notte) as c_m'),
            ])
            ->where(function ($q) use ($year) {
                $q->where(Booking::raw('YEAR(tx_mask_p_data_arrivo)'), '=', $year);
                // ->orWhere(Typo::raw('YEAR(tx_mask_p_data_partenza)'), '=', $year);
            })
            ->where(function ($q) use ($month) {
                $q->where(Booking::raw('MONTH(tx_mask_p_data_arrivo)'), '=', $month);
                // ->orWhere(Typo::raw('MONTH(tx_mask_p_data_partenza)'), '=', $month);
            })
            ->when($house, function ($q, $house) {
                return $q->whereIn('tx_mask_p_casa', $house);
            })
            ->where('tx_mask_cod_reservation_status', '!=', "CANC")
            ->orderBy('tx_mask_p_data_arrivo', 'ASC')
            // ->orderBy('tx_mask_p_data_partenza', 'ASC')
            ->get();

        $this->sum_tot_lordo_incassi = $data->sum('tot_lordo_incassi');
        $this->sum_importo_stay = $data->sum('importo_stay');
        $this->sum_perc_importo_fisso = $data->sum('perc_importo_fisso');
        $this->sum_cleaning_fee_amount = $data->sum('cleaning_fee_amount');
        $this->sum_city_tax_amount = $data->sum('city_tax_amount');
        $this->sum_s_checkout = $data->sum('s_checkout');
        $this->sum_cash_op_cout = $data->sum('cash_op_cout');
        $this->sum_cash_simo = $data->sum('cash_simo');
        $this->sum_solo_extra = $data->sum('solo_extra');
        $this->sum_stay_extra = $data->sum('stay_extra');
        $this->sum_s_chin = $data->sum('s_chin');
        $this->sum_s_b = $data->sum('s_b');
        $this->sum_kross_payment_total_amount = $data->sum('kross_payment_total_amount');
        $this->sum_banca1 = $data->sum('banca1');
        $this->sum_c_p = $data->sum('c_p');
        $this->avg_c_m = $data->avg('c_m');

        return Datatables::of($data)
            ->addColumn('note_alert', function ($row) {
                $note_alert = '';
                if ($row->tx_mask_t1_op_note)
                    $note_alert = '<span class="badge badge-warning"><i class="fas fa-exclamation" aria-hidden="true"></i> note</span>';
                return $note_alert;
            })
            ->addColumn('header', function ($row) {
                $header = preg_replace('/(\([a-zA-Z0-9\s]+\)\s?)/', '', $row->header);
                return '<a href="#" data-toggle="tooltip"  class="text-dark-75 text-hover-primary mb-1 font-size-lg text-capitalize text-left">' . $header . '</a>';
            })
            ->addColumn('data_arrivo', function ($row) {
                $h = $row->tx_mask_t1_ora_checkin ? $row->tx_mask_t1_ora_checkin : '<span class="text-danger">NaN</span>';
                $arrivo = Carbon::createFromFormat('d-m-y', $row->tx_mask_p_data_arrivo)->format('Y-m-d');
                $partenza = Carbon::createFromFormat('d-m-y', $row->tx_mask_p_data_partenza)->format('Y-m-d');
                $arrivo = Carbon::parse($arrivo);
                $partenza = Carbon::parse($partenza);
                $diff = $partenza->diffInDays($arrivo);
                return $row->tx_mask_p_data_arrivo . ' </br> <span class="text-dark-75">h</span> ' . $h . ' <i class="fas fa-moon text-dark-75"></i> ' . $diff;
            })
            ->addColumn('data_partenza', function ($row) {
                $h = $row->tx_mask_t1_ora_checkout ? $row->tx_mask_t1_ora_checkout : '<span class="text-danger">NaN</span>';
                return $row->tx_mask_p_data_partenza . ' </br> <span class="text-dark-75">h</span> ' . $h;
            })
            ->addColumn('payments', function ($row) {
                $d = json_decode($row->kross_payments_json);
                if ($d) {
                    $ret = [];

                    foreach ($d as $dr) {
                        $ret[] = '<div>' .  $dr->date . ' - € ' . $this->htmlBalance($dr->amount) . '</div>';
                    }

                    return join('', $ret);
                } else {
                    return 'assenti';
                }
            })
            // ->addColumn('chin', function ($row) {
            //     return '<span class="font-weight-bolder">€ ' . number_format($row->tx_mask_t3_p_s_chin, 2, ',', '.') . '</span>';
            // })
            ->addColumn('month', function ($row) {
                return ucwords($row->month);
            })
            ->addColumn('tot_lordo_incassi', function ($row) {
                return $this->htmlBalance($row->tot_lordo_incassi);
            })
            ->addColumn('importo_stay', function ($row) {
                return $this->htmlBalance($row->importo_stay);
            })
            ->addColumn('perc_importo_fisso', function ($row) {
                return $this->htmlBalance($row->perc_importo_fisso);
            })
            ->addColumn('cleaning_fee_amount', function ($row) {
                return $this->htmlBalance($row->cleaning_fee_amount);
            })
            ->addColumn('city_tax_amount', function ($row) {
                return $this->htmlBalance($row->city_tax_amount);
            })
            ->addColumn('s_checkout', function ($row) {
                return $this->htmlBalance($row->s_checkout);
            })
            ->addColumn('cash_op_cout', function ($row) {
                return $this->htmlBalance($row->cash_op_cout);
            })
            ->addColumn('cash_simo', function ($row) {
                return $this->htmlBalance($row->cash_simo);
            })
            ->addColumn('solo_extra', function ($row) {
                return $this->htmlBalance($row->solo_extra);
            })
            ->addColumn('stay_extra', function ($row) {
                return $this->htmlBalance($row->stay_extra);
            })
            ->addColumn('banca1', function ($row) {
                return $this->htmlBalance($row->banca1);
            })
            ->addColumn('s_chin', function ($row) {
                return $this->htmlBalance($row->s_chin);
            })
            ->addColumn('s_b', function ($row) {
                return $this->htmlBalance($row->s_b);
            })
            ->addColumn('kross_payment_total_amount', function ($row) {
                // $clean_json = str_replace(',,', ',', $row->kross_payments_json);
                // $dirty_array = json_decode($clean_json);
                // $clean_array = array_filter(
                //     $dirty_array,
                //     function ($item) {
                //         return count($item) > 0;
                //     }
                // );
                // $kross_payments = array_reduce(
                //     $clean_array,
                //     function ($carry, $item) {
                //         return $carry + array_reduce(
                //             $item,
                //             function ($subcarry, $subitem) {
                //                 return $subcarry + $subitem->amount;
                //             },
                //             0
                //         );
                //     },
                //     0
                // );
                // $this->sum_kross_payments += $kross_payments;
                return $this->htmlBalance($row->kross_payment_total_amount);
            })
            ->addColumn('c_p', function ($row) {
                return $this->htmlBalance($row->c_p);
            })
            ->addColumn('c_m', function ($row) {
                return $this->htmlBalance($row->c_m);
            })
            ->addColumn('sum_tot_lordo_incassi', function ($row) {
                return $this->htmlBalance($this->sum_tot_lordo_incassi);
            })
            ->addColumn('sum_importo_stay', function ($row) {
                return $this->htmlBalance($this->sum_importo_stay);
            })
            ->addColumn('sum_perc_importo_fisso', function ($row) {
                return $this->htmlBalance($this->sum_perc_importo_fisso);
            })
            ->addColumn('sum_cleaning_fee_amount', function ($row) {
                return $this->htmlBalance($this->sum_cleaning_fee_amount);
            })
            ->addColumn('sum_city_tax_amount', function ($row) {
                return $this->htmlBalance($this->sum_city_tax_amount);
            })
            ->addColumn('sum_s_checkout', function ($row) {
                return $this->htmlBalance($this->sum_s_checkout);
            })
            ->addColumn('sum_cash_op_cout', function ($row) {
                return $this->htmlBalance($this->sum_cash_op_cout);
            })
            ->addColumn('sum_cash_simo', function ($row) {
                return $this->htmlBalance($this->sum_cash_simo);
            })
            ->addColumn('sum_solo_extra', function ($row) {
                return $this->htmlBalance($this->sum_solo_extra);
            })
            ->addColumn('sum_stay_extra', function ($row) {
                return $this->htmlBalance($this->sum_stay_extra);
            })
            ->addColumn('sum_banca1', function ($row) {
                return $this->htmlBalance($this->sum_banca1);
            })
            ->addColumn('sum_s_chin', function ($row) {
                return $this->htmlBalance($this->sum_s_chin);
            })
            ->addColumn('sum_s_b', function ($row) {
                return $this->htmlBalance($this->sum_s_b);
            })
            ->addColumn('sum_kross_payment_total_amount', function ($row) {
                return $this->htmlBalance($this->sum_kross_payment_total_amount);
            })
            ->addColumn('sum_c_p', function ($row) {
                return $this->htmlBalance($this->sum_c_p);
            })
            ->addColumn('avg_c_m', function ($row) {
                return $this->htmlBalance($this->avg_c_m);
            })
            ->rawColumns([
                'note_alert', 'header', 'data_arrivo', 'data_partenza', 'tx_mask_p_sito', 'casa',
                'month', 'importo_stay', 'perc_importo_fisso', 'cleaning_fee_amount', 'city_tax_amount',
                's_checkout', 'cash_op_cout', 'cash_simo', 'solo_extra', 'tot_lordo_incassi',
                'stay_extra', 's_chin', 's_b', 'kross_payment_total_amount', 'banca1',
                'c_p', 'c_m', 'payments',
                'sum_importo_stay', 'sum_tot_lordo_incassi', 'sum_perc_importo_fisso', 'sum_cleaning_fee_amount',
                'sum_city_tax_amount', 'sum_s_checkout', 'sum_cash_op_cout', 'sum_cash_simo', 'sum_solo_extra',
                'sum_stay_extra', 'sum_s_chin', 'sum_s_b', 'sum_kross_payment_total_amount', 'sum_banca1',
                'sum_c_p', 'avg_c_m'
            ])
            ->make(true);
    }
}
