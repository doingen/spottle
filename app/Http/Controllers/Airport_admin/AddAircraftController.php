<?php

namespace App\Http\Controllers\Airport_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Spot;
use App\Models\Aircraft;

class AddAircraftController extends Controller
{
    public function index(){

      $spots = Spot::all();
      
      $number = $spots->count();

      return view('airport_admin.aircraft-add', compact('spots', 'number'));
        
    }

    public function create(Request $request){
      
      $create = $request->all();

      $aircraft_spot = $create["spot_id"];

      unset($create["_token"]);
      unset($create["spot_id"]);

      $create["airport_admin_id"] = 1;

      Aircraft::create($create)->spots()->attach($aircraft_spot);

      return view('airport_admin.main');
    }
}