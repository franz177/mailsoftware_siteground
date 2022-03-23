<?php

namespace App\Http\Controllers\Frontend\Views;

use App\Http\Controllers\Controller;
use App\Models\Typo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typo = new Typo();
        $years = $this->getYears();
        $houses = $this->getHousesAbbArray();
        $seasons = $typo->seasons;
        $sub_seasons = $typo->sub_seasons;
        $house_groups = $typo->house_groups;
        $months = $typo->months;

        return view('frontend.viste.dashboard')
            ->with(compact('years'))
            ->with(compact('houses'))
            ->with(compact('seasons'))
            ->with(compact('sub_seasons'))
            ->with(compact('house_groups'))
            ->with(compact('months'))
            ;
    }

    public function links()
    {
        return view('frontend.links.index');
    }
}
