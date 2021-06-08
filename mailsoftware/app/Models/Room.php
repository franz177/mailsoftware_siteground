<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'descrizione',
        'description'
    ];

    public function houses()
    {
        return $this->belongsToMany(House::class);
    }

    public function house_room()
    {
        return $this->hasMany(HouseRoom::class);
    }
}
