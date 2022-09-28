<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircraft;
use App\Models\Spot;

class ReserveController extends Controller
{
    public function index(){
        $aircraft = Aircraft::all();
        return view('reserve', ['aircraft' => $aircraft]);
    }

    public function first_search(Request $request){
        $aircraft = Aircraft::where('id', $request->aircraft_id)
                        ->get();
        
        foreach($aircraft as $aircraft){
            if($aircraft->helicopter = 0){
                
            };
        }
    }
}
