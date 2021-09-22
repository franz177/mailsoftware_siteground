<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypoBiancCsPeriodo extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'tx_mask_bianc_cs_periodo';
    protected $primaryKey = 'uid';

    protected $dateFormat = 'd-m-Y';

    protected $dates = ['tx_mask_bianc_cs_dal','tx_mask_bianc_cs_al'];

    protected $casts = [
        'tx_mask_bianc_cs_dal' => 'date',
        'tx_mask_bianc_cs_al' => 'date',
    ];

    public function getTxMaskRDalAttribute()
    {
        if($this->attributes['tx_mask_bianc_cs_dal'])
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tx_mask_bianc_cs_dal'])->format('d-m-Y');
    }

    public function getTxMaskRAlAttribute()
    {
        if($this->attributes['tx_mask_bianc_cs_al'])
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tx_mask_bianc_cs_al'])->format('d-m-Y');
    }
}
