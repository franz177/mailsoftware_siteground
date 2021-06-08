<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'uid',
        'flow_id',
        'user_id',
        'title',
        'testo'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $dates = ['created_at'];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function getCreatedAtAttribute()
    {
        if($this->attributes['created_at'])
            return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d-m-Y H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flow()
    {
        return $this->belongsTo(Flow::class);
    }
}
