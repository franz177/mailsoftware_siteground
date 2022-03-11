<?php

namespace App\Http\Controllers\Frontend\Views;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use DB;
use Carbon\Carbon;

use App\Models\Typo;
use App\Models\House;
use App\Models\Note;

class SinotticoController extends Controller
{
    public function index(Request $request)
    {
        $years = $this->getYears();
		$current_year = $request->input('year', date('Y'));
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

			$start = Carbon::create($current_year, 1, 1);
			$end = Carbon::create($current_year, 12, 31);
			$all_days = new \DatePeriod($start, new \DateInterval('P1D'), $end->addDays(1));
			$allocated = [];

			foreach($all_days as $ad) {
				$month = (int) $ad->format('m');
				if (!isset($allocated[$month])) {
					$allocated[$month] = [];
				}

				$allocated[$month][(int) $ad->format('d')] = [
                    'color' => $house->color->colore_bg,
                    'amount' => 0,
                ];
			}

			$bookings = $house->bookings()->where(function($query) use ($current_year) {
				$query->where(DB::raw('YEAR(tx_mask_p_data_arrivo)'), $current_year)->orWhere(DB::raw('YEAR(tx_mask_p_data_partenza)'), $current_year);
			})->get();

			foreach($bookings as $booking) {
				$days = $booking->explodedDays();
				foreach($days as $d) {
					if ($d->format('Y') == $current_year) {
						$allocated[(int) $d->format('m')][(int) $d->format('d')]['amount'] = $booking->prop_costo_medio_a_notte;
					}
				}
			}

			$data[$house->id] = $allocated;
		}

        /*
            I dati delle case 5 e 6 (Corte d'Anglona) vanno mergiati insieme.
            TODO: Eventualmente questa routine va astratta e messa in
            App\Models\House per essere riusata in altre circostanze analoghe
        */

        $houses = $houses->reject(function($h) {
            return $h->id == 6;
        });

        foreach($data[6] as $month => $days) {
            foreach($days as $day => $meta) {
                $data[5][$month][$day] = $meta;
            }
        }

        unset($data[6]);

        /*
            Questo è per forzare l'ordinamento delle case. Sarebbe utile
            spostarlo direttamente in House e riusarlo in altre circostanze
        */
        $houses = $houses->sortBy(function($h, $k) {
            return array_search($h->id, [1, 4, 2, 3, 7, 5]);
        });

        return view('frontend.viste.sinottico')->with(compact('years', 'current_year', 'houses', 'months', 'data'));
    }

	public function saveNotes(Request $request)
	{
		$house_id = $request->input('target_id');
		$context = $request->input('context');
		$house = House::find($house_id);

		$note = $house->notes()->where('context', $context)->first();
		if (is_null($note)) {
			$note = new Note();
			$note->context = $context;
			$note->target()->associate($house);
		}

		$n = [];

		foreach($request->all() as $key => $value) {
			if (Str::startsWith($key, 'note_')) {
				$n[$key] = $value;
			}
		}

		$note->content = json_encode($n);
		$note->save();

		return redirect()->route('viste.sinottico');
	}
}
