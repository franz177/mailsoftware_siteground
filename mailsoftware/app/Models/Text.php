<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'priority_id',
        'testo',
        'text'
    ];

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function flows()
    {
        return $this->belongsToMany(Flow::class)
            ->withPivot('block_id', 'section_id')
            ->withTimestamps();
    }

    public function flow_text()
    {
        return $this->hasMany(FlowText::class);
    }

    public function text_user()
    {
        return $this->hasMany(TextUser::class);
    }

}
