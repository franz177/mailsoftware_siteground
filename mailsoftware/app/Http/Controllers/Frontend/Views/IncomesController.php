<?php

namespace App\Http\Controllers\Frontend\Views;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Typo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IncomesController extends Controller
{
    protected $CType = 'mask_db_alg_pren';

    private $sum_tot_lordo_incassi;
    private $sum_importo_stay;
    private $sum_perc_sito;
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
    private $sum_c_m;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typo = new Typo();
        $houses_typo = $this->getHousesAbbrArray();
        $years = $this->getYears();

        $op_check_out = $this->getUsersArray();

        return view('frontend.incomes.index')
            ->with(compact('years'))
            ->with(compact('houses_typo'));
    }

    public function getDataTables(Request $request)
    {
        $year = $request->year ? $request->year : now()->year;
        $house = $request->house ? $request->house : NULL;

        $solo_extra = 'tx_mask_t3_p_cash_op_cout + tx_mask_t3_p_cash_simo - tx_mask_t3_p_city_tax_amount';

        $data =
            Booking::select([
                Booking::raw('MONTH(tx_mask_p_data_arrivo) as monthed'),
                Booking::raw('MONTHNAME(STR_TO_DATE(MONTH(tx_mask_p_data_arrivo), "%m")) as month'),
                Booking::raw('SUM(tx_mask_t3_p_stay) as importo_stay'),
                Booking::raw('SUM(tx_mask_p_perc_sito) as perc_sito'),
                Booking::raw('SUM(tx_mask_t3_p_cleaning_fee_amount) as cleaning_fee_amount'),
                Booking::raw('SUM(tx_mask_t3_p_city_tax_amount) as city_tax_amount'),
                Booking::raw('SUM(tx_mask_t3_p_s_checkout) as s_checkout'),
                Booking::raw('SUM(tx_mask_t3_p_cash_op_cout) as cash_op_cout'),
                Booking::raw('SUM(tx_mask_t3_p_cash_simo) as cash_simo'),
                Booking::raw('SUM(' . $solo_extra . ') as solo_extra'),
                Booking::raw('SUM(tx_mask_t3_p_stay + tx_mask_p_perc_sito + ' . $solo_extra . ') as tot_lordo_incassi'),
                Booking::raw('SUM(tx_mask_t3_p_stay - tx_mask_p_perc_sito + tx_mask_t3_p_cash_op_cout + tx_mask_t3_p_cash_simo) as stay_extra'),
                Booking::raw('SUM(tx_mask_t3_p_s_chin) as s_chin'),
                Booking::raw('SUM(tx_mask_t3_p_s_b) as s_b'),
                // Booking::raw('CONCAT("[",GROUP_CONCAT(tx_mask_t5_kross_payments SEPARATOR ","),"]") as kross_payments_json'),
                Booking::raw('SUM(tx_mask_t5_kross_payment_total_amount) as kross_payment_total_amount'),
                Booking::raw('SUM(tx_mask_t3_p_stay - tx_mask_t3_p_s_b) as banca1'),
                Booking::raw('SUM(tx_mask_t3_p_stay + tx_mask_t3_p_s_checkout - tx_mask_t5_kross_payment_total_amount - (' . $solo_extra . ')) as c_p'),
                // Booking::raw('"Da calcolare" as c_m'),
            ])
            ->where(function ($q) use ($year) {
                $q->where(Typo::raw('YEAR(tx_mask_p_data_arrivo)'), '=', $year);
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
        $this->sum_perc_sito = $data->sum('perc_sito');
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
        $this->sum_c_m = 0;

        function htmlEuro($arg)
        {
            return '<span class=' . ($arg > 0 ? "font-weight-bolder" : ($arg < 0 ? '"text-danger font-weight-bold"' : "font-weight-normal")) . '>€ ' . number_format($arg, 2, ',', '.') . '</span>';
        }

        return Datatables::of($data)
            ->addColumn('month', function ($row) {
                return ucwords($row->month);
            })
            ->addColumn('tot_lordo_incassi', function ($row) {
                return htmlEuro($row->tot_lordo_incassi);
            })
            ->addColumn('importo_stay', function ($row) {
                return htmlEuro($row->importo_stay);
            })
            ->addColumn('perc_sito', function ($row) {
                return htmlEuro($row->perc_sito);
            })
            ->addColumn('cleaning_fee_amount', function ($row) {
                return htmlEuro($row->cleaning_fee_amount);
            })
            ->addColumn('city_tax_amount', function ($row) {
                return htmlEuro($row->city_tax_amount);
            })
            ->addColumn('s_checkout', function ($row) {
                return '<span class=' . ($row->s_checkout > 0 ? "font-weight-bolder" : "text-danger") . '>€ ' . number_format($row->s_checkout, 2, ',', '.') . '</span>';
            })
            ->addColumn('cash_op_cout', function ($row) {
                return htmlEuro($row->cash_op_cout);
            })
            ->addColumn('cash_simo', function ($row) {
                return htmlEuro($row->cash_simo);
            })
            ->addColumn('solo_extra', function ($row) {
                return htmlEuro($row->solo_extra);
            })
            ->addColumn('stay_extra', function ($row) {
                return htmlEuro($row->stay_extra);
            })
            ->addColumn('banca1', function ($row) {
                return htmlEuro($row->banca1);
            })
            ->addColumn('s_chin', function ($row) {
                return htmlEuro($row->s_chin);
            })
            ->addColumn('s_b', function ($row) {
                return htmlEuro($row->s_b);
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
                return htmlEuro($row->kross_payment_total_amount);
            })
            ->addColumn('c_p', function ($row) {
                return htmlEuro($row->c_p);
            })
            ->addColumn('c_m', function ($row) {
                return '<div title="Da calcolare (il campo indicato non è presente nel DB)">!</div>';
            })
            ->addColumn('sum_tot_lordo_incassi', function ($row) {
                return htmlEuro($this->sum_tot_lordo_incassi);
            })
            ->addColumn('sum_importo_stay', function ($row) {
                return htmlEuro($this->sum_importo_stay);
            })
            ->addColumn('sum_perc_sito', function ($row) {
                return htmlEuro($this->sum_perc_sito);
            })
            ->addColumn('sum_cleaning_fee_amount', function ($row) {
                return htmlEuro($this->sum_cleaning_fee_amount);
            })
            ->addColumn('sum_city_tax_amount', function ($row) {
                return htmlEuro($this->sum_city_tax_amount);
            })
            ->addColumn('sum_s_checkout', function ($row) {
                return '<span class=' . ($this->sum_s_checkout > 0 ? "font-weight-bolder" : "text-danger") . '>€ ' . number_format($this->sum_s_checkout, 2, ',', '.') . '</span>';
            })
            ->addColumn('sum_cash_op_cout', function ($row) {
                return htmlEuro($this->sum_cash_op_cout);
            })
            ->addColumn('sum_cash_simo', function ($row) {
                return htmlEuro($this->sum_cash_simo);
            })
            ->addColumn('sum_solo_extra', function ($row) {
                return htmlEuro($this->sum_solo_extra);
            })
            ->addColumn('sum_stay_extra', function ($row) {
                return htmlEuro($this->sum_stay_extra);
            })
            ->addColumn('sum_banca1', function ($row) {
                return htmlEuro($this->sum_banca1);
            })
            ->addColumn('sum_s_chin', function ($row) {
                return htmlEuro($this->sum_s_chin);
            })
            ->addColumn('sum_s_b', function ($row) {
                return htmlEuro($this->sum_s_b);
            })
            ->addColumn('sum_kross_payment_total_amount', function ($row) {
                return htmlEuro($this->sum_kross_payment_total_amount);
            })
            ->addColumn('sum_c_p', function ($row) {
                return htmlEuro($this->sum_c_p);
            })
            ->addColumn('sum_c_m', function ($row) {
                return htmlEuro($this->sum_c_m);
            })
            ->rawColumns([
                'month', 'importo_stay', 'perc_sito', 'cleaning_fee_amount', 'city_tax_amount',
                's_checkout', 'cash_op_cout', 'cash_simo', 'solo_extra', 'tot_lordo_incassi',
                'stay_extra', 's_chin', 's_b', 'kross_payment_total_amount', 'banca1',
                'c_p', 'c_m',
                'sum_importo_stay', 'sum_tot_lordo_incassi', 'sum_perc_sito', 'sum_cleaning_fee_amount',
                'sum_city_tax_amount', 'sum_s_checkout', 'sum_cash_op_cout', 'sum_cash_simo', 'sum_solo_extra',
                'sum_stay_extra', 'sum_s_chin', 'sum_s_b', 'sum_kross_payment_total_amount', 'sum_banca1',
                'sum_c_p', 'sum_c_m'
            ])
            ->make(true);
    }
}
