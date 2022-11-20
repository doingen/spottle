<?php

namespace App\Http\Controllers\Airport_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Spot;

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

        if($search["date"] && $search["spot_id"]){

            $date = $search["date"];

            $spot = Reservation::where('spot_id', $search["spot_id"])->get();

            $result = Reservation::where('spot_id', $search["spot_id"])     
                            ->where('start_at', 'like', "$date%")
                            ->orWhere('end_at', 'like', "$date%")
                            ->with('aircraft', 'spot', 'user')
                            ->orderBy('start_at', 'asc')
                            ->simplePaginate(7);
            
            $selected_spot = $search["spot_id"];
            $date = $search["date"];

        }
        elseif($search["spot_id"]){
            $result = Reservation::where('spot_id', $search["spot_id"])
                                ->with('aircraft', 'spot', 'user')
                                ->orderBy('start_at', 'asc')
                                ->simplePaginate(7);
            
            $selected_spot = $search["spot_id"];
            $date = 0;
        }
        elseif($search["date"]){

            $date = $search["date"];

            $result = Reservation::where('start_at', 'like', "$date%")
                            ->orWhere('end_at', 'like', "$date%")
                            ->with('aircraft', 'spot', 'user')
                            ->orderBy('start_at', 'asc')
                            ->simplePaginate(7);

            $selected_spot = 0;
            $date = $search["date"];
        }
        else{
            $result = Reservation::with('aircraft', 'spot', 'user')
                                ->orderBy('start_at', 'asc')
                                ->simplePaginate(7);

            $selected_spot = 0;
            $date = 0;
        }

        return view('airport_admin.reservation', compact('spots', 'result', 'selected_spot', 'date'));
        
    }
}
