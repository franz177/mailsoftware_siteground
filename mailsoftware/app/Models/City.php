<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'city',
        'cap',
        'provincia'
    ];

    public function cityTax()
    {
        return $this->hasMany(CityTax::class);
    }

    public function ztl()
    {
        return $this->hasMany(Ztl::class);
    }

    public function operators()
    {
        return $this->belongsToMany(Operator::class);
    }

}
