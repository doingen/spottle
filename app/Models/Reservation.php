<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function aircraft(){
        return $this->belongsTo('App\Models\Aircraft');
    }

    public function spot(){
        return $this->belongsTo('App\Models\Spot');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }


    public function getCalendarArray($start_hour, $end_hour, $open_days){

        $dt = new Carbon;

        $calendar_row = [];

        for($i=$start_hour; $i<$end_hour; $i++) {
            for($j=0; $j<=45; $j=$j+15){
                for($k=0; $k<$open_days; $k++){
                    $td = $dt->today()->addDay($k)->addHour($i)->addMinutes($j);
                    $calendar_row[] = $td;
                }
            }
        }

        $last_key = array_key_last($calendar_row);

        return array($calendar_row, $last_key);
    }

    public function getReservedDate($start_hour, $end_hour, $open_days, $selected_s){

        $dt = new Carbon;

        $time_array = [];

        for($i=0; $i<$open_days; $i++){
            $start_time = $dt->today()
                            ->addDay($i)
                            ->addHour($start_hour);
            $end_time = $dt->today()
                            ->addDay($i)
                            ->addHour($end_hour);
            $period = CarbonPeriod::create($start_time, $end_time)
                                    ->minute(15);
            $time_array[] = $period;
        }

        $reserved_date = [];
        
        $reserved = Reservation::where('spot_id', $selected_s)->get();

        foreach($time_array as $time){
            foreach($time as $time){
                $date = $time->format('Y-m-d H:i:s');
                $result = $reserved->where('start_at','<=',$date)
                                    ->where('end_at','>',$date);
                
                $now = date("Y-m-d H:i:s");

                if($date <= $now || $result->isNotEmpty()){
                    $reserved_date[] = $date;
                }
            }
        }

        return $reserved_date;
    }

    public function prepareForCreate($requests){

        $requests_original = $requests;

        unset($requests["aircraft_id"]);
        unset($requests["spot_id"]);
        unset($requests["start_at"]);
        unset($requests["end_at"]);

        $reservation = array_diff_assoc($requests_original, $requests);

        $reservation["user_id"] = Auth::id();
        $reservation["tel"] = Auth::user()->tel;
        
        $reservation["aircraft_name"] = Aircraft::find($reservation["aircraft_id"])->name;
        
        $reservation["spot_name"] = Spot::find($reservation["spot_id"])->name;

        return $reservation;
    }
    
    static function dateReform($date){
        $d = substr($date, 0, 16);
        return str_replace('-', "/", $d);
    }

    public function getUserReservation($reservation){

        $period = CarbonPeriod::create($reservation->start_at, $reservation->end_at)
                                ->minute(15)->toArray();
                                
        array_pop($period);

        $reserving = [];
        
        foreach($period as $period){
            $r = $period->format('Y-m-d H:i:s');
            $reserving[] = $r;
        }

        return $reserving;
    }

    public function reviewedOrNot($id){
        
        $review = Spot_review::where('reservation_id', $id)->get();
        
        if($review->isEmpty()){
            return true;
        }
        else{
            return false;
        }
    }
}