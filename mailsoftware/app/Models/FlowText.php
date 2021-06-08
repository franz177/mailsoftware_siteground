<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowText extends Model
{
    use HasFactory;

    protected $table = 'flow_text';

    protected $fillable = [
        'id',
        'flow_id',
        'text_id',
        'block_id',
        'section_id'
    ];

    public function flow()
    {
        return $this->belongsTo(Flow::class);
    }

    public function text()
    {
        return $this->belongsTo(Text::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
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
