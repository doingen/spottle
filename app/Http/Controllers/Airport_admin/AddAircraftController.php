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

      $request->validate([
        'name' => 'required|unique:aircraft|max:191',
        'spot_id' => 'required'
      ]);
      
      $create = $request->all();

      $aircraft_spot = $create["spot_id"];

      unset($create["_token"]);
      unset($create["spot_id"]);

      $create["airport_admin_id"] = 1;

      Aircraft::create($create)->spots()->attach($aircraft_spot);

      $added_aircraft = $create["name"];

      return redirect('airport_admin/add_aircraft')->with(['success' => 'を追加しました',
                                                        'added_aircraft' => $added_aircraft]);
    }
}