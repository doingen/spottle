<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    use HasFactory;

    protected $fillable = [
        'airport_admin_id',
        'name'
    ];

    public function spots()
    {
        return $this->belongsToMany(Spot::class)->withTimestamps();
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }
}
