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

        $reservation_model = new Reservation;
        list($calendar_row, $last_key) = $reservation_model->getCalendarArray($start_hour, $end_hour, $open_days);
        $reserved_date = $reservation_model->getCalenderKey($start_hour, $end_hour, $open_days, $reserved);
        
        return view('reserve', compact('open_days', 'aircraft', 'selected_a', 'selected_s', 'spots', 'calendar_row', 'last_key', 'reserved_date'));
    }

    public function create(Request $request){
        $requests = $request->all();
        $reservation = new Reservation;
        $reservation = $reservation->prepareForCreate($requests);
        
        $r = Reservation::where('spot_id', $reservation["spot_id"])->get();
        $reserved_a = Reservation::where('spot_id', $reservation["spot_id"])->where('end_at', "<=", $reservation["start_at"])->get();
        $reserved_b = Reservation::where('spot_id', $reservation["spot_id"])->where('start_at', ">", $reservation["end_at"])->get();
        
        $diff = $r->diff($reserved_a)->diff($reserved_b);
        
        if($diff->isNotEmpty()){
            return back()->with('error', 'スケジュールが重複します')
                        ->withInput();
        }
        else{
            Reservation::create($reservation);
        }
        
    }

}
