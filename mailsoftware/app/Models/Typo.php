<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tx_mask_p_old_uid',
        'uid',
        'header',
    ];

    protected $connection = 'mysql2';
    protected $table = 'tt_content';
    protected $primaryKey = 'uid';
    public $CType = 'mask_db_alg_pren';

    protected $dateFormat = 'd-m-Y';

    protected $dates = ['tx_mask_p_data_arrivo', 'tx_mask_p_data_partenza', 'tx_mask_p_data_prenotazione'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tx_mask_p_data_arrivo' => 'date',
        'tx_mask_p_data_partenza' => 'date',
        'tx_mask_p_data_prenotazione' => 'date',
    ];

    public function getTxMaskPDataArrivoAttribute()
    {
        if($this->attributes['tx_mask_p_data_arrivo'])
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tx_mask_p_data_arrivo'])->format('d-m-Y');
    }

    public function getTxMaskPDataPartenzaAttribute()
    {
        if($this->attributes['tx_mask_p_data_partenza'])
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tx_mask_p_data_partenza'])->format('d-m-Y');
    }
    public function getTxMaskPDataPrenotazioneAttribute()
    {
        if($this->attributes['tx_mask_p_data_prenotazione'])
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tx_mask_p_data_prenotazione'])->format('d-m-Y');
    }

    public $languages = [
        'IT' => 'IT',
        'EN' => 'EN'
    ];


    public $color_case = [
        0   => ['NULL', 'black'],
        1   => ['CA'  , 'blue-steel'],
        3   => ['VER' , 'green-seagreen'],
        4   => ['PE'  , 'green'],
        5   => ['LA'  , 'purple-medium'],
        6   => ['NU'  , 'warning'],
        7   => ['NJ'  , 'purple-soft'],
        8   => ['STE' , 'yellow-casablanca'],
    ];

    public $color_siti = [
        0   => ['NULL'  , 'black'],
        9   => ['BK'    , ' text-center font-weight-bolder'],
        15  => ['AB'    , ' text-center font-weight-bolder'],
        19  => ['HW'    , ' text-center font-weight-bolder'],
        20  => ['EX'    , ' text-center font-weight-bolder'],
        22  => ['AG'    , ' text-center font-weight-bolder'],
        47  => ['MAIL'  , ' text-center font-weight-bolder'],
        60  => ['TA'    , ' text-center font-weight-bolder'],
        580 => ['AB'    , ' text-center font-weight-bolder'],
        607 => ['BK', ' text-center font-weight-bolder'],
        1342 => ['AB', ' text-center font-weight-bolder'],
        1398 => ['ST', ' text-center font-weight-bolder'],

    ];

    public $seasons = [
        'bassa' => [11,12,1,2],
        'media' => [10,3,4,5],
        'alta'  => [6,7,8,9]
    ];

    public $sub_seasons = [
      0 => [['GEN','DIC'],[1,12]],
      1 => [['FEB','NOV'],[2,11]],
      2 => [['MAR','APR'],[3,4]],
      4 => [['MAG','OTT'],[5,10]],
      5 => [['GIU','SET'],[6,9]],
      6 => [['LUG','AGO'],[7,8]],
    ];

    public $house_groups = [
      'Alguerhome'  => [1,3,4],
      'Nulvi'       => [6,7],
      'Altre'       => [5,8],
    ];

    public $months = [
      1 => "GEN", 2 => "FEB",
      3 => "MAR", 4 => "APR",
      5 => "MAG", 6 => "GIU",
      7 => "LUG", 8 => "AGO",
      9 => "SET", 10 => "OTT",
      11 => "NOV", 12 => "DIC",
    ];


//    protected $primaryKey = 'tx_mask_p_old_uid';
}
