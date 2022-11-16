<?php

namespace App\Http\Controllers\Airport_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Airport_admin;
use App\Models\Reservation;
use App\Models\Spot;
use Illuminate\Support\Facades\Auth;

class AirportAdminController extends Controller
{
    public function index(){

        return view('airport_admin.main');
        
    }

    public function show(){

        $spots = Spot::all();

        return view('airport_admin.reservation', compact('spots'));
    }

    public function search(Request $request){

        $spots = Spot::all();

        $search = $request->except(["_token"]);

        if($search["date"]){

            $date = $search["date"];

            $spot = Reservation::where('spot_id', $search["spot_id"])->get();

            if($spot->isNotEmpty()){
                $result = Reservation::where('spot_id', $search["spot_id"])     
                                ->where('start_at', 'like', "$date%")
                                ->orWhere('end_at', 'like', "$date%")
                                ->with('aircraft', 'spot', 'user')
                                ->orderBy('start_at', 'asc')
                                ->simplePaginate(7);
            }
            else{
                $result = collect();
            }
        }
        else{
            $result = Reservation::where('spot_id', $search["spot_id"])
                                ->with('aircraft', 'spot', 'user')
                                ->orderBy('start_at', 'asc')
                                ->simplePaginate(7);
        }

        $selected_spot = $search["spot_id"];

        $date = $search["date"];

        return view('airport_admin.reservation', compact('spots', 'result', 'selected_spot', 'date'));
        
    }
}
