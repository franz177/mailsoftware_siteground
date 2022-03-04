<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $table = 'houses';
    protected $primaryKey = 'uid';

    protected $fillable = [
        'uid',
        'bank_id',
        'ztl_id',
        'persone_max',
        'color_id'
    ];

    // Una casa (belongs to) appartiene a una banca
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function house_room()
    {
        return $this->hasMany(HouseRoom::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'tx_mask_p_casa', 'uid');
    }

    public function typo()
    {
        return TypoHouses::find($this->uid);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function ztl()
    {
        return $this->belongsTo(Ztl::class);
    }

    public function getNameAttribute()
    {
        return $this->typo()->header;
    }
}
