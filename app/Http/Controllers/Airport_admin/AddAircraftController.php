<?php

namespace App\Http\Controllers\Airport_admin;

use Illuminate\Http\Request;
use App\Http\Requests\Airport_admin\ChangeAircraftRequest;
use App\Http\Controllers\Controller;
use App\Models\Spot;
use App\Models\Aircraft;

class AddAircraftController extends Controller
{
    public function index(){

      $spots = Spot::all();

      $aircraft = Aircraft::all();
      
      $number = $spots->count();

      $selected = null;

      return view('airport_admin.aircraft-add', compact('spots', 'aircraft', 'number', 'selected'));
        
    }

    public function create(Request $request){

      $request->validate([
        'name' => 'required|unique:aircraft|max:191',
        'spot_id' => 'required'
      ]);
      
      $create = $request->except(['_token']);

      $aircraft_spot = $create["spot_id"];

      unset($create["spot_id"]);

      $create["airport_admin_id"] = \Auth::user()->id;

      Aircraft::create($create)->spots()->attach($aircraft_spot);

      $added_aircraft = $create["name"];

      return redirect('airport_admin/add_aircraft')->with(['success' => 'を追加しました',
                                                        'added_aircraft' => $added_aircraft]);
    }

    public function show(Request $request){

      $a = [$request->aircraft_id];
      
      $spots = Spot::all();

      $aircraft = Aircraft::all();

      $selected = Aircraft::where('id', $a)->first();
      
      $selected_spot = Spot::whereHas('aircraft', function($query) use($a)  {
                          $query->where('aircraft_spot.aircraft_id', $a);
                        })->pluck('id')->toArray();

      return view('airport_admin.aircraft-add', compact('spots', 'aircraft', 'selected', 'selected_spot'));
    }

    public function update(ChangeAircraftRequest $request){
        
      Aircraft::where('id', $request->aircraft_id)
              ->update(["airport_admin_id" => \Auth::user()->id, 
                        "name" => $request->changed_name]);

      Aircraft::find($request->aircraft_id)->spots()->sync($request->changed_spot_id);

      return redirect('airport_admin/add_aircraft')->with('changed_success', '変更しました');
      
    }
}