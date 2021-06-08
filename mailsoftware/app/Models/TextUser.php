<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextUser extends Model
{
    use HasFactory;

    protected $table = 'text_user';

    protected $fillable = [
        'id',
        'user_uid',
        'text_id',
    ];

    public function text()
    {
        return $this->belongsTo(Text::class);
    }
}
