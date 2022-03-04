<?php

namespace App\Http\Controllers\Frontend\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Carbon\Carbon;

use App\Models\Typo;
use App\Models\House;

class SinotticoController extends Controller
{
    public function index(Request $request)
    {
        $years = $this->getYears();
		$year = $request->input('year', date('Y'));
		$houses = House::all();

		$typo = new Typo();
		$months = $typo->months;

		$data = [];

		foreach($houses as $house) {
			/*
				Per ogni casa popolo un array che rappresenta tutto l'anno,
				mettendo il valore 0 per ogni giorno, e poi man mano che itero
				le prenotazioni sovrascrivo tale valore con quello effettivo (il
				costo medio a notte)
			*/

			$start = Carbon::create($year, 1, 1);
			$end = Carbon::create($year, 12, 31);
			$all_days = new \DatePeriod($start, new \DateInterval('P1D'), $end->addDays(1));
			$allocated = [];

			foreach($all_days as $ad) {
				$month = (int) $ad->format('m');
				if (!isset($allocated[$month])) {
					$allocated[$month] = [];
				}

				$allocated[$month][(int) $ad->format('d')] = 0;
			}

			$bookings = $house->bookings()->where(function($query) use ($year) {
				$query->where(DB::raw('YEAR(tx_mask_p_data_arrivo)'), $year)->orWhere(DB::raw('YEAR(tx_mask_p_data_partenza)'), $year);
			})->get();

			foreach($bookings as $booking) {
				$days = $booking->explodedDays();
				foreach($days as $d) {
					if ($d->format('Y') == $year) {
						$allocated[(int) $d->format('m')][(int) $d->format('d')] = $booking->prop_costo_medio_a_notte;
					}
				}
			}

			$data[$house->id] = $allocated;
		}

        return view('frontend.viste.sinottico')->with(compact('years', 'houses', 'months', 'data'));
    }
}
