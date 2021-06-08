<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypoUserGroup extends Typo
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'pid',
    ];

    protected $table = 'fe_groups';

}
