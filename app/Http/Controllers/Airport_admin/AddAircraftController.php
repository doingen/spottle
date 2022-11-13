<?php

namespace App\Http\Controllers\Airport_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Spot;

class AddAircraftController extends Controller
{
    public function index(){

        $spots = Spot::all();

        return view('airport_admin.aircraft_add', compact('spots'));
        
    }
}
