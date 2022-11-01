<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;

    public function aircraft()
    {
        return $this->belongsToMany(Aircraft::class)->withTimestamps();
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }
}
