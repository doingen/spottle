<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircraft;
use App\Models\Reservation;
use App\Models\Spot;
use App\Http\Requests\ReserveRequest;

class ReserveController extends Controller
{
    protected $start_hour = 7;
    protected $end_hour = 22;
    protected $open_days = 14;

    public function getCalendarArray(){

        $reservation_model = new Reservation;
        $date= $reservation_model->getCalendarArray(
                    $this->start_hour, 
                    $this->end_hour, 
                    $this->open_days
                );

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
        
        list($calendar_row, $last_key) = $this->getCalendarArray();

        $reservation_model = new Reservation;
        $reserved_date = $reservation_model->getReservedDate(
                                $this->start_hour,
                                $this->end_hour, 
                                $this->open_days, 
                                $selected_s
                            );
        
        return view('reserve', compact('open_days', 'aircraft', 'selected_a', 'selected_s', 'spots', 'calendar_row', 'last_key', 'reserved_date'));
    }

    public function confirm(ReserveRequest $request){

        $requests = $request->all();
        $r = new Reservation;
        $reservation = $r->prepareForCreate($requests);

        return view('reserve_confirm', ['reservation' => $reservation]);
    }

    public function create(Request $request){

        $reservation = $request->reservation;
        unset($reservation["aircraft_name"]);
        unset($reservation["spot_name"]);
        
        Reservation::create($reservation);

        $request->session()->regenerateToken();

        return view('thanks');
    }

    public function show(Request $request){

        $reservation_id = $request -> reserve_id;
        $reservation = Reservation::where('id', $reservation_id)
                                ->get();
        $open_days = $this->open_days;

        foreach($reservation as $reservation) {
            $selected_a = Aircraft::find($reservation->aircraft_id);
            $selected_s = Spot::find($reservation->spot_id);
        }
        
        list($calendar_row, $last_key) = $this->getCalendarArray();

        $reservation_model = new Reservation;
        $reserved_date = $reservation_model->getReservedDate(
                                $this->start_hour, 
                                $this->end_hour, 
                                $this->open_days, 
                                $selected_s->id
                            );
        $reserving = $reservation_model->getUserReservation($reservation);

        return view('reserve', compact('reservation_id', 'open_days', 'selected_a', 'selected_s', 'calendar_row', 'last_key', 'reserved_date', 'reserving'));
    }

    public function updateConfirm(ReserveRequest $request){

        $update = array_slice($request->all() , 9);
        $update["aircraft_name"] = Aircraft::find($update["aircraft_id"])->name;
        $update["spot_name"] = Spot::find($update["spot_id"])->name;

        return view('update_confirm', compact('update'));
    }

    public function update(Request $request){

        $requests = $request->all('update');
        $keys = ['start_at', 'end_at'];
        $update = array_intersect_key($requests['update'], array_flip($keys));
        Reservation::where('id', $requests['update']['reservation_id']) 
                    ->update($update);

        $request->session()->regenerateToken();

        return view('thanks');

    }

    public function deleteConfirm(Request $request){

        $r = Reservation::find($request->reserve_id);
        $name["aircraft_name"] = Aircraft::find($r->aircraft_id)->name;
        $name["spot_name"] = Spot::find($r->spot_id)->name;

        return view('reserve_delete', compact('r', 'name'));

    }

    public function delete(Request $request){

        $delete = $request->reservation;
        Reservation::find($delete)->delete();
        $request->session()->regenerateToken();

        return view('thanks');
    }

}
