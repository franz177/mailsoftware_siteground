<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = 'banks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'nome_banca',
        'beneficiario',
        'indirizzo',
        'bic',
        'swift',
        'iban',
        'causale',
    ];

    public function houses()
    {
        return $this->hasMany(House::class);
    }
}
