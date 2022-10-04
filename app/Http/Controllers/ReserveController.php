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
        $selected_a = 0;
        $aircraft = Aircraft::all();

        return view('reserve', compact('selected_a', 'aircraft'));
    }

    public function first_search(Request $request){
        $selected_a = $request->aircraft_id;
        $selected_s = 0;
        $aircraft = Aircraft::all();
        $spots = Aircraft::where('id', $request->aircraft_id)
                        ->with('spots')
                        ->get();
        return view('reserve', compact('selected_a', 'selected_s', 'aircraft', 'spots'));
    }

    public function second_search(Request $request, $aircraft_id){
        $start_hour = 7;
        $end_hour = 22;
        $open_days = 14;

        $aircraft = Aircraft::all();
        $selected_a = $aircraft_id;
        $selected_s = $request->spot_id;
        $spots = Aircraft::where('id', $aircraft_id)
                        ->with('spots')
                        ->get();
        $reserved = Reservation::where('spot_id', $selected_s)->get();

        $dt = new Carbon;
        $calender_array = [];
        for($i=$start_hour; $i<$end_hour; $i++) {
            for($j=0; $j<=45; $j=$j+15){
                for($k=0; $k<$open_days; $k++){
                    $td = $dt->today()->addDay($k)->addHour($i)->addMinutes($j);
                    $calender_array[] = $td;
                }
            }
        }
        $last_key = array_key_last($calender_array);
        
        $time_array = [];
        for($i=0; $i<$open_days; $i++){
            $start_time = $dt->today()->addDay($i)->addHour($start_hour);
            $end_time = $dt->today()->addDay($i)->addHour($end_hour);
            $period = CarbonPeriod::create($start_time, $end_time)->minute(15);
            $time_array[] = $period;
        }

        $arr = [];
        foreach($time_array as $time){
            foreach($time as $time){
                $date = $time->format('Y-m-d H:i:s');
                $result = $reserved->where('start_at','<=',$date)->where('end_at','>',$date);
                if($result->isNotEmpty()){
                    $arr[] = $date;
                }
            }
        }

        return view('reserve', compact('open_days', 'aircraft', 'selected_a', 'selected_s', 'spots', 'calender_array','last_key', 'arr'));
    }
}
