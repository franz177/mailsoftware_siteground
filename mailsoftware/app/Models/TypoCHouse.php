<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypoCHouse extends Typo
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'tt_content';
    public $CType = 'mask_db_alg_c_casa';

}
