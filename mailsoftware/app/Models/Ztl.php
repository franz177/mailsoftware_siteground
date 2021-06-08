<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ztl extends Model
{
    use HasFactory;

    protected $table = 'ztls';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'city_id',
        'description',
        'ztl_da_am',
        'ztl_a_am',
        'ztl_out_am',
        'ztl_da_pm',
        'ztl_a_pm',
        'ztl_out_pm',
    ];

    public function houses()
    {
        return $this->hasMany(House::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
