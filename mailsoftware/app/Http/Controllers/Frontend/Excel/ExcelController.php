<?php

namespace App\Http\Controllers\Frontend\Excel;

use App\Exports\BookingCustomExport;
use App\Exports\BookingsExport;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses_typo = $this->getHousesAbbrArray();
        $years = $this->getYears();

        $columns = Schema::getColumnListing('bookings');
        $columns_default = [ 'uid', 'header', 'tx_mask_p_casa','tx_mask_p_data_arrivo', 'tx_mask_p_data_partenza', 'tx_mask_p_data_prenotazione', 'tx_mask_t5_kross_cod_channel', 'tx_mask_t0_lingua',
            'tx_mask_p_perc_importo_fisso', 'tx_mask_p_tot_ospiti', 'tx_mask_p_under_12', 'tx_mask_t0_country',	'tx_mask_t0_email', 'tx_mask_t0_tel', 'tx_mask_t3_p_city_tax_amount',
            'tx_mask_t3_p_cleaning_fee_amount','tx_mask_t3_p_extra_p','tx_mask_t3_p_s_checkout','tx_mask_t3_p_s_chin','tx_mask_t3_p_s_ex_checkout','tx_mask_t3_p_s_extra_checkin',
            'tx_mask_t3_p_saldo_ric_b','tx_mask_t3_p_stay','totale_pulizie','costo_co','mancia_cli','cons_tot_ingresso_banca','cons_totale_extra_cash_ritirato_al_co',
            'cons_incasso_consuntivo_totale_con_extra_no_siti_web','cons_incasso_consuntivo_totale_con_extra_siti_web', 'cons_totale_costi','cons_guadagno',
            'costi_totale_costo_check_in','costi_costo_check_out','costi_totale_costo_check_out','costi_totale_costo_per_cambio_biancheria_costo_lavanderia',
            'costi_totale_costi','prop_percentuale_proprietario','prop_percentuale_simonetta','prop_incasso_ospiti_extra','prop_costo_medio_a_notte',
        ];
        $columns_selected = [ 'uid', 'header', 'tx_mask_p_casa','tx_mask_p_data_arrivo', 'tx_mask_p_data_partenza', 'tx_mask_p_data_prenotazione', 'tx_mask_t5_kross_cod_channel', 'tx_mask_t0_lingua' ];

        $bookings_status = Booking::selectRaw('DISTINCT(tx_mask_cod_reservation_status)')->get();

        return view('frontend.excel.excel')
            ->with(compact('houses_typo'))
            ->with(compact('years'))
            ->with(compact('columns'))
            ->with(compact('columns_default'))
            ->with(compact('columns_selected'))
            ->with(compact('bookings_status'));
    }

    public function bookingsExport()
    {
        $booking_export = new BookingsExport();
        $booking_export->setFileName(now());
        return  $booking_export;
    }

    public function bookingsCustomExport(Request $request)
    {
        $booking_export = new BookingCustomExport($request->column_default,$request->column, $request->year, $request->house, $request->bookings_status);
        $booking_export->setFileName(now());

        $path = '/storage/';
        $filename = 'custom_excel_'.now().'.xlsx';

        $booking_export->store($path.$filename);

        return Response::json(['filename' => $filename]);

    }

    public function downloadBookingCustomExport(Request $request)
    {
        $filename = $request->filename;
        $file = "/home/customer/www/mailsoftware.francescogiliberti.it/mailsoftware/storage/app/storage/".$filename;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file);
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
