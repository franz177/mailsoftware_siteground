<?php

namespace App\Http\Controllers\Frontend\Views;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Typo\TypoController;
use Illuminate\Http\Request;
use App\Models\Typo;
use Yajra\DataTables\DataTables;

class VisteController extends Controller
{
    protected $CType_pren = 'mask_db_alg_pren';
    protected $CType_costi_op = 'mask_db_alg_c_casa';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $typo = new Typo();
        $years = $this->getYears();
        $houses = $this->getHousesAbbArray();
        $seasons = $typo->seasons;
        $sub_seasons = $typo->sub_seasons;
        $house_groups = $typo->house_groups;
        $months = $typo->months;

        $bookings = $this->bookings();
        $costo_operatore = $this->getCostoOpertore($bookings);

        dd($costo_operatore);

        return view('frontend.viste.viste')
            ->with(compact('years'))
            ->with(compact('houses'))
            ->with(compact('seasons'))
            ->with(compact('sub_seasons'))
            ->with(compact('house_groups'))
            ->with(compact('months'))
            ;
    }

    public function bookings()
    {
        $bookings =  Typo::select(['uid','tx_mask_p_casa', 'tx_mask_p_data_arrivo', 'tx_mask_t1_op_checkout', 'tx_mask_t1_ore_pulizie', Typo::raw('YEAR(tx_mask_p_data_arrivo) as YEAR'), Typo::raw('CONCAT(FORMAT(SUM(tx_mask_t3_p_stay), 2, "it_IT"), " €") as STAY')])
            ->where('CType', $this->CType_pren)
            ->where('hidden', 0)
            ->where('deleted', 0)
            ->where('uid', 1277) //1386=>Metodo1 - 1442=>Importo Pulizie - 1277=>tutti i campi
            ->where('tt_content.tx_mask_cod_reservation_status', '!=', "CANC")
            ->first();

        return $bookings;
    }

    public function getDataForm(Request $request)
    {

    }

    public function getCostoOpertore($bookings)
    {
        $costo_operatore = Typo::select(['uid','header', 'tx_mask_c_cod_costo_orario_operatore', 'tx_mask_t3_govout_metodo', 'tx_mask_t3_govout_c_cout','tx_mask_t3_govout_ritiro_immondizia','tx_mask_t3_govout_ritiro_soldi','tx_mask_t2_lav_c_cambio_b_cout',
            'tx_mask_t2_lav_prep_kit_cliente','tx_mask_t2_lav_costo_dotazione_casa','tx_mask_t2_lav_prep_kit_dotazione_casa'])
            ->where('CType', $this->CType_costi_op)
            ->where('hidden', 0)
            ->whereIn('tx_mask_c_cod_feuser', [$bookings->tx_mask_t1_op_checkout])
            ->first();

        if($bookings->tx_mask_t1_ore_pulizie > 0)
            $pulizie =  $bookings->tx_mask_t1_ore_pulizie*$costo_operatore->tx_mask_c_cod_costo_orario_operatore;

        if($costo_operatore->tx_mask_t3_govout_metodo == 1){
            return 'metodo 1';
        }else{
            return $pulizie - ($costo_operatore->tx_mask_t3_govout_c_cout + $costo_operatore->tx_mask_t3_govout_ritiro_immondizia + $costo_operatore->tx_mask_t3_govout_ritiro_soldi + $costo_operatore->tx_mask_t2_lav_c_cambio_b_cout);
        }

        return $costo_operatore;
    }

    public function getCostoCheckOut($bookings)
    {

    }
}
