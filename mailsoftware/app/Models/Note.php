<?php

/*
    Questo rappresenta generiche annotazioni che possono essere salvate in
    diversi contesti. Ogni contesto ne gestisce in modo arbitrario i contenuti
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public function target()
    {
        return $this->morphTo();
    }
}
