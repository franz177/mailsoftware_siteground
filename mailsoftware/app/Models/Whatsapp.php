<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whatsapp extends Model
{
    use HasFactory;

    protected $table = 'whatsapps';
    protected $primaryKey = 'uid';

    protected $fillable = [
        'id',
        'uid',
        'stato',
    ];
}
