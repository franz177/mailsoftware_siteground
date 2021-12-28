<?php

namespace App\Http\Controllers;

use App\Exports\BookingsExport;
use App\Jobs\BookingSincronizationJob;
use App\Models\Booking;
use App\Models\Typo;
use App\Models\TypoCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;

class BookingController extends Controller
{
    private $row = array();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Typo::select('sys_category.parent', 'sys_category.title')
            ->selectRaw('YEAR(tt_content.tx_mask_sp_data) as years')
            ->selectRaw('SUM(tt_content.tx_mask_db_importo) as tx_mask_db_importo')
            ->join('sys_category_record_mm', 'sys_category_record_mm.uid_foreign', '=', 'tt_content.uid')
            ->join('sys_category', 'sys_category.uid', '=', 'sys_category_record_mm.uid_local')
            ->where('tt_content.CType', 'mask_al_spese')
            ->where('sys_category.parent', '!=', 1)
            ->orderBy('sys_category.parent', 'ASC')
            ->orderBy('years', 'DESC')
            ->groupBy(Typo::raw('sys_category.parent'))
            ->groupBy(Typo::raw('YEAR(tt_content.tx_mask_sp_data)'))
            ->get();

        $datas->each(function($data) {
           $macro = TypoCategories::select('title')->where('uid', $data->parent)->first();
           $this->row[] = $macro->title.' | '. $data->years .' - '. $data->tx_mask_db_importo;
        });

        dd($this->row);
    }

    public function force()
    {
        BookingSincronizationJob::dispatch();

        Artisan::call('queue:work',['--stop-when-empty' => 1]);

        return back();
    }

    public function bookingsExport()
    {
        $booking_export = new BookingsExport();
        $booking_export->setFileName(now());
        return  $booking_export;
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
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
