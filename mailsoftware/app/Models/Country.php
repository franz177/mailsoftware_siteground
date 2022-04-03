<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /*
        Semplice wrapper per accedere al nome (il cui attributo reale ha un nome
        assai poco mnemonico)
    */
    public function getNameAttribute()
    {
        return $this->cn_short_it;
    }
}
