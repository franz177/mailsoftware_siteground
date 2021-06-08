<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'typeanswer_id',
        'type_id',
        'site_uid',
        'house_uid'
    ];

    public function typeanswer()
    {
        return $this->belongsTo(Typeanswer::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function house()
    {
        $this->primaryKey = 'uid';
        return $this->belongsTo(TypoHouses::class);
    }

    public function site()
    {
        $this->primaryKey = 'uid';
        return $this->belongsTo(TypoSite::class);
    }

    public function texts()
    {
        return $this->belongsToMany(Text::class)->withPivot('block_id', 'section_id');
    }

    public function flow_text()
    {
        return $this->hasMany(FlowText::class);
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

    public $typeanswer_id_old = 0;
    public $type_id_old = 0;

    public function matchGroup($typeanswer_id, $type_id)
    {
        if($this->typeanswer_id_old === $typeanswer_id && $this->type_id_old === $type_id){
            return TRUE;
        }

        $this->typeanswer_id_old = $typeanswer_id;
        $this->type_id_old = $type_id;

        return FALSE;
    }

}
