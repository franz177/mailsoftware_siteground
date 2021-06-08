<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityTax extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'description',
        'mese_da',
        'mese_a',
        'debit',
        'notti_max',
        'anni_max_adulti',
        'anni_max_bambini',
    ];

    protected $dateFormat = 'Y-m-d';

    protected $dates = ['mese_da', 'mese_a'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'mese_da' => 'date',
        'mese_a' => 'date',
    ];

    public function getMeseDaAttribute()
    {
        if($this->attributes['mese_da'])
            return Carbon::createFromFormat('Y-m-d', $this->attributes['mese_da'])->format('Y-m-d');
    }

    public function getMeseAAttribute()
    {
        if($this->attributes['mese_a'])
            return Carbon::createFromFormat('Y-m-d', $this->attributes['mese_a'])->format('Y-m-d');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

//    public function setMeseDa($value){}
//    public function setMeseA($value){}
//    public function getMeseDa($value){}
//    public function getMeseA($value){}
}
