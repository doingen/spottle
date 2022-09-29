<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircraft;

class ReserveController extends Controller
{
    public function index(){
        $selected = 0;
        $aircraft = Aircraft::all();

        return view('reserve', ['selected' => $selected, 'aircraft' => $aircraft]);
    }

    public function first_search(Request $request){
        $selected = $request->aircraft_id;
        $aircraft = Aircraft::all();
        $spots = Aircraft::where('id', $request->aircraft_id)
                        ->with('spots')
                        ->get();
        
        return view('reserve', ['selected' => $selected, 'aircraft' => $aircraft, 'spots' => $spots]);
    }
}
