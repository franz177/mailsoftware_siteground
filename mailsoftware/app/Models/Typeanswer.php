<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeanswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'sorting',
        'color_id'
    ];

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

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
