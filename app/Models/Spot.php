<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;

    protected $fillable = [
        'airport_admin_id',
        'name'
    ];

    public function aircraft()
    {
        return $this->belongsToMany(Aircraft::class)->withTimestamps();
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }
}
