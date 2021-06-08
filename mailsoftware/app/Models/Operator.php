<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    protected $primaryKey = 'uid';

    protected $fillable = [
        'uid',
        'gender',
        'transfer',
        'dalle',
        'alle',
        'debit'
    ];

    public $gender_list = [
        0   => 'F',
        1   => 'M',
        99   => 'NON impostato',
    ];

    public $transfer_list = [
        0   => 'NO',
        1   => 'SI',
        99   => 'NON impostato',
    ];

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }
}
