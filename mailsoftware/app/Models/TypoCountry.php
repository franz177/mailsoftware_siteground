<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypoCountry extends Typo
{
    use HasFactory;

    protected $fillable = [
        'uid',
    ];

    protected $table = 'static_countries';

}
