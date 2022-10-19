<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircraft;
use App\Models\Reservation;
use App\Models\Spot;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

class ReserveController extends Controller
{
    protected $start_hour = 7;
    protected $end_hour = 22;
    protected $open_days = 14;

    public function getCalendarArray(){

        $reservation_model = new Reservation;

        $date= $reservation_model->getCalendarArray($this->start_hour, $this->end_hour, $this->open_days);

        return $date;
    }

    public function index(){

        $selected_a = 0;

        $aircraft = Aircraft::all();

        list($calendar_row, $last_key) = $this->getCalendarArray();

        $open_days = $this->open_days;

        return view('reserve', compact('selected_a', 'aircraft', 'calendar_row', 'last_key', 'open_days'));
    }

    public function first_search(Request $request){

        $selected_a = $request->aircraft_id;

        $selected_s = 0;

        $aircraft = Aircraft::all();

        $spots = Aircraft::where('id', $request->aircraft_id)
                        ->with('spots')
                        ->get();

        list($calendar_row, $last_key) = $this->getCalendarArray();
        $open_days = $this->open_days;

        return view('reserve', compact('selected_a', 'selected_s', 'aircraft', 'spots', 'calendar_row', 'last_key', 'open_days'));
    }

    public function second_search(Request $request, $aircraft_id){

        $open_days = $this->open_days;

        $aircraft = Aircraft::all();

        $selected_a = $aircraft_id;

        $selected_s = $request->spot_id;

        $spots = Aircraft::where('id', $aircraft_id)
                        ->with('spots')
                        ->get();

        $reserved = Reservation::where('spot_id', $selected_s)->get();
        list($calendar_row, $last_key) = $this->getCalendarArray();

        $reservation_model = new Reservation;

        $reserved_date = $reservation_model->getReservedDate($this->start_hour, $this->end_hour, $this->open_days, $reserved);
        
        return view('reserve', compact('open_days', 'aircraft', 'selected_a', 'selected_s', 'spots', 'calendar_row', 'last_key', 'reserved_date'));
    }

    public function confirm(Request $request){

        $requests = $request->all();
        
        $reservation = new Reservation;

        $create_info = $reservation->prepareForCreate($requests);

        if($create_info != null){

            list($reservation, $diff) = $create_info;

            if($diff->isEmpty()){
                $aircraft = Aircraft::find($request->aircraft_id);
                $reservation["aircraft_name"] = $aircraft->name;
                
                $spot = Spot::find($request->spot_id);
                $reservation["spot_name"] = $spot->name;

                return view('confirm', ['reservation' => $reservation]);
            }
            else{
                return back()->with('reserve_error', 'すでに予約された日時が含まれています')
                            ->withInput();
            }
        }

        else{
            return back()->with('date_error', '入力された日時が正しくありません')
                        ->withInput();
        }
    }

    public function create(Request $request){

        $reservation = $request->reservation;

        unset($reservation["aircraft_name"]);
        unset($reservation["spot_name"]);

        Reservation::create($reservation);

        return view('thanks');
    }

}
