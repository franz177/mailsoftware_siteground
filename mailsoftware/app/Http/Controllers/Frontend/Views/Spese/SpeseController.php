<?php

namespace App\Http\Controllers\Frontend\Views\Spese;

use App\Http\Controllers\Controller;
use App\Models\Typo;
use App\Models\TypoCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;

class SpeseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCostiAziendali()
    {
        $typo = new Typo();
        $houses_typo = $this->getHousesAbbrArray();
        $months = $typo->months;
        return view('frontend.spese.costi_aziendali')
            ->with(compact('houses_typo'))
            ->with(compact('months'))
            ;
    }

    public function getDataCostiAziendali(Request $request)
    {
        $month = $request->months ? $request->months : now()->year;
        $house = $request->houses ? $request->houses : [];

        $data = Typo::select(['header', 'tx_mask_sp_data', 'bodytext', 'tx_mask_db_importo', 'tx_mask_db_negozio', 'tx_mask_db_fiscale', 'tx_mask_db_casa',
            'tx_mask_db_all_case', 'tx_mask_db_tipo_spesa', 'tx_mask_t0_db_tipo_man', 'tx_mask_t0_sp_operatori', 'categories', 'tx_mask_db_operatore'
        ])
            ->where('CType', 'mask_al_spese')
            ->when($house, function ($q, $house){
                return $q->whereIn('tx_mask_db_casa', $house);
            })
            ->where('uid', 1581)
            ->groupBy(Typo::raw('MONTH(tx_mask_sp_data)'))
            ->get();

        return Datatables::of($data)
            ->addColumn('case', function ($row) {
                $case = count(explode(',', $row->tx_mask_db_casa));
                return $case;
            })
            ->addColumn('carta_igienica', function ($row) {
                return $row->tx_mask_db_importo;
            })
            ->addColumn('case_sel', function ($row) use ($house) {
                return count($house);
            })

            ->rawColumns([
                'case',
                'carta_igienica',
                'case_sel',
            ])
            ->make(true);
    }

    private $data = array();
    private $data_ok = array();
    private $sum_of_row;

    public function getDataCostiAziendaliAnno(Request $request)
    {
        $datas = Typo::select('sys_category.parent', 'sys_category.title')
                ->selectRaw('YEAR(tt_content.tx_mask_sp_data) as year')
                ->selectRaw('SUM(tt_content.tx_mask_db_importo) as tx_mask_db_importo')
                ->join('sys_category_record_mm', 'sys_category_record_mm.uid_foreign', '=', 'tt_content.uid')
                ->join('sys_category', 'sys_category.uid', '=', 'sys_category_record_mm.uid_local')
                ->where('tt_content.CType', 'mask_al_spese')
                ->where('sys_category.parent', '!=', 1)
                ->groupBy(Typo::raw('sys_category.parent'))
                ->groupBy(Typo::raw('YEAR(tt_content.tx_mask_sp_data)'))
                ->orderBy('sys_category.parent', 'ASC')
                ->orderBy('year', 'DESC')
                ->get();

        $years = Typo::selectRaw('YEAR(tt_content.tx_mask_sp_data) as year')
            ->where('tt_content.CType', 'mask_al_spese')
            ->groupBy(Typo::raw('YEAR(tt_content.tx_mask_sp_data)'))
            ->get();

        $parents = TypoCategories::select('uid')
            ->selectRaw('LOWER(REPLACE(REPLACE(REPLACE(title, "&", "e"), " -", ""), " ", "_")) as title')
            ->where('parent', 1)
            ->get();

        $years->each(function($year) use($datas, $parents){
            if($year->year){
                $this->data['year'] = $year->year;
                $this->sum_of_row = 0;
                $datas->each(function ($data) use($year, $parents){
                    if($data->year == $year->year){
                        $category = TypoCategories::selectRaw('REPLACE(REPLACE(title, "&", "e"), " ", "_") as title')->where('uid', $data->parent)->first();
                        $this->data[strtolower($category->title)] = $data->tx_mask_db_importo;
                        $this->sum_of_row = $this->sum_of_row + $data->tx_mask_db_importo;
                    }
                });
                $this->data['total_row'] = $this->sum_of_row;
                $this->data_ok[] = $this->data;
            }

        });

        return $this->data_ok;

        return Datatables::of($this->data_ok)
            ->addColumn('utenze_e_tasse', function($row) {
//                return '<span class='. ($row['utenze_e_tasse'] > 0 ? "font-weight-bolder" : "font-weight-normal") .'>€ '.number_format($row['utenze_e_tasse'], 2, ',', '.').'</span>';
            })
            ->rawColumns([
                'utenze_e_tasse'
            ])
            ->make(true);
    }
}
