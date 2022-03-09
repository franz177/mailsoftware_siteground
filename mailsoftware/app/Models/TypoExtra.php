<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypoExtra extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'tx_mask_t5_repeat_metodo';
}
