<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircraft;
use App\Models\Reservation;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

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

    public function second_search(Request $request, $aircraft_id){
        $reserved = Reservation::where('spot_id', $request->spot_id)->get();
        
        
        $timeArray = [];
        $dt = new Carbon;
        for($i=0; $i<=14; $i++){
            $start_time = $dt->today()->addDay($i)->addHour(7);
            $end_time = $dt->today()->addDay($i)->addHour(22);
            $period = CarbonPeriod::create($start_time, $end_time)->minute(15);
            $timeArray[] = $period;
        }

        $arr = [];
        foreach($timeArray as $time){
            foreach($time as $time){
                $date = $time->format('Y-m-d H:i:s');
                $result = $reserved->where('start_at','<=',$date)->where('end_at','>',$date);
                if($result->isNotEmpty()){
                    $arr[$date] = 1;
                }
            }
        }
    }
}
