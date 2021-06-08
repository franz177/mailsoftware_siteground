<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypoViewSites extends Typo
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'name',
    ];

    protected $table = 'getSites';


}
