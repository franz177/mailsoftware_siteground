<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypoRange extends Typo
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'tt_content';
    public $CType = 'mask_db_alg_range';

    protected $dateFormat = 'd-m-Y';

    protected $dates = ['tx_mask_r_dal','tx_mask_r_al'];

    protected $casts = [
        'tx_mask_r_dal' => 'date',
        'tx_mask_r_al' => 'date',
    ];

    public function getTxMaskRDalAttribute()
    {
        if($this->attributes['tx_mask_r_dal'])
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tx_mask_r_dal'])->format('d-m-Y');
    }

    public function getTxMaskRAlAttribute()
    {
        if($this->attributes['tx_mask_r_al'])
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tx_mask_r_al'])->format('d-m-Y');
    }

}
