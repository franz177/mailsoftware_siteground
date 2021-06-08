<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'sorting'
    ];

    public function flows()
    {
        return $this->hasMany(Flow::class);
    }

    public function initials($string)
    {
        $initials = '';

        $words = explode(' ', $string);
        foreach ($words as $word) {
            $initials .= $word[0];
        }

        return $initials;
    }
}
