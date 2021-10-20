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

    private $sum_tot_pulizie;

    public function getDataTables(Request $request)
    {
        $month = $request->month ? $request->month : now()->month;
        $year = $request->year ? $request->year : now()->year;

        $data = Booking::select([
            Booking::raw('MONTH(tx_mask_p_data_arrivo) as month'),
            Booking::raw('SUM(totale_pulizie) as totale_pulizie'),
            Booking::raw('SUM(costo_co) as costo_co'),
            Booking::raw('SUM(costi_costo_operatore_cambio_biancheria) as costi_costo_operatore_cambio_biancheria'),
            Booking::raw('SUM(tx_mask_t3_p_s_ex_checkout) as tx_mask_t3_p_s_ex_checkout'),
            Booking::raw('SUM(tx_mask_p_perc_importo_fisso) as tx_mask_p_perc_importo_fisso'),
            ])
            ->where(function ($q) use ($year) {
            $q->where(Typo::raw('YEAR(tx_mask_p_data_arrivo)'), '=', 2019)
                ->orWhere(Typo::raw('YEAR(tx_mask_p_data_partenza)'), '=', 2019);
            })
//            ->where(function ($q) use ($month) {
//                $q->where(Typo::raw('MONTH(tx_mask_p_data_arrivo)'), '=', $month)
//                    ->orWhere(Typo::raw('MONTH(tx_mask_p_data_partenza)'), '=', $month);
//            })
            ->where('tx_mask_cod_reservation_status', '!=', "CANC")
            ->orderBy('tx_mask_p_data_arrivo', 'ASC')
            ->orderBy('tx_mask_p_data_partenza', 'ASC')
            ->groupBy(Booking::raw('MONTH(tx_mask_p_data_arrivo)'))
            ->get();

        return Datatables::of($data)
            ->addColumn('month', function ($row) {
                return $row->month;
            })
            ->addColumn('totale_pulizie', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->totale_pulizie, 2, ',', '.').'</span>';
            })
            ->addColumn('costo_co', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->costo_co, 2, ',', '.').'</span>';
            })
            ->addColumn('costi_costo_operatore_cambio_biancheria', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->costi_costo_operatore_cambio_biancheria, 2, ',', '.').'</span>';
            })
            ->addColumn('tx_mask_t3_p_s_ex_checkout', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_t3_p_s_ex_checkout, 2, ',', '.').'</span>';
            })
            ->addColumn('tx_mask_p_perc_importo_fisso', function ($row) {
                return '<span class="font-weight-bolder">€ '.number_format($row->tx_mask_p_perc_importo_fisso, 2, ',', '.').'</span>';
            })

            ->rawColumns(['month', 'totale_pulizie', 'costo_co', 'costi_costo_operatore_cambio_biancheria', 'tx_mask_t3_p_s_ex_checkout', 'tx_mask_p_perc_importo_fisso'])
            ->make(true);
    }

}
