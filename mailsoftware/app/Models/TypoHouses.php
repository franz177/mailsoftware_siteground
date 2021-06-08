<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypoHouses extends Typo
{
    use HasFactory;

    public $CType = 'mask_db_alg_h';

    public $house_type = [
        1 => 'Monolocale',
        2 => 'Monolocale Open space',
        3 => 'Bilocale',
        4 => 'Trilocale',
        5 => 'Casa antica con ingresso indipendente',
    ];

}
