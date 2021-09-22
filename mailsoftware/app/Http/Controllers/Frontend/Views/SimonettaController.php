<?php

namespace App\Http\Controllers\Frontend\Views;

use App\Http\Controllers\Controller;
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

    public function getDataTable()
    {
        $year = now()->year;

        $data = Typo::select([
                    Typo::raw('LCASE(tt_content.header) as headerl'),
                    Typo::raw('IFNULL(tt_content.tx_mask_p_casa,0) casa'),
                    Typo::raw('SUM(tt_content.tx_mask_t3_p_stay) tot_stay'),
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
            ->where('tt_content.tx_mask_cod_reservation_status', '!=', "CANC")
            ->groupBy(Typo::raw('MONTH(tt_content.tx_mask_p_data_arrivo)'))
            ->orderBy(Typo::raw('MONTH(tt_content.tx_mask_p_data_arrivo)'), 'ASC')
            ->orderBy('tt_content.tx_mask_p_data_partenza', 'ASC')
            ->get();

        return Datatables::of($data)
            ->addColumn('month', function ($row) {
                return Carbon::createFromFormat('d-m-Y', $row->tx_mask_p_data_arrivo)->format('M');
            })
            ->addColumn('stay', function ($row) {
                return $row->tot_stay;
            })

            ->rawColumns(['month', 'stay'])
            ->make(true);
    }
}
