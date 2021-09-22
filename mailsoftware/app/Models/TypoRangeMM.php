<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypoRangeMM extends Typo
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'tx_mask_r_mm';

    protected $primaryKey = 'parentid';

}
