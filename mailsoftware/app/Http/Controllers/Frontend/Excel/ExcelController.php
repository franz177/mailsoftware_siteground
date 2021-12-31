<?php

namespace App\Http\Controllers\Frontend\Excel;

use App\Exports\BookingCustomExport;
use App\Exports\BookingsExport;
use App\Http\Controllers\Controller;
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

        return view('frontend.excel.excel')
            ->with(compact('houses_typo'))
            ->with(compact('years'))
            ->with(compact('columns'));
    }

    public function bookingsExport()
    {
        $booking_export = new BookingsExport();
        $booking_export->setFileName(now());
        return  $booking_export;
    }

    public function bookingsCustomExport(Request $request)
    {
        $booking_export = new BookingCustomExport($request->column, $request->year, $request->house);
        $booking_export->setFileName(now());

        $path = '/storage/';
        $filename = 'custom_excel_test.xlsx';

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
