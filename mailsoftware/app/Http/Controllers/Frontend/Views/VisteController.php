<?php

namespace App\Http\Controllers\Frontend\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Typo;

class VisteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $importo_stay = $this->bookings();
        $importo_stay = $importo_stay->sum('tx_mask_t3_p_stay');

        return view('frontend.viste.viste')
            ->with(compact('importo_stay'))
            ;
    }

    public function bookings()
    {
        return $importo_stay = Typo::where('CType','mask_db_alg_pren')->get();
    }
}
