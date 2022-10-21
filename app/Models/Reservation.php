<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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

    public function getReservedDate($start_hour, $end_hour, $open_days, $reserved){

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

        foreach($time_array as $time){
            foreach($time as $time){
                $date = $time->format('Y-m-d H:i:s');
                $result = $reserved->where('start_at','<=',$date)
                                    ->where('end_at','>',$date);

                if($result->isNotEmpty()){
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

        $reservation["user_id"] = 1;
        $reservation["tel"] = "123456789";
        
        $aircraft = Aircraft::find($reservation["aircraft_id"]);
        $reservation["aircraft_name"] = $aircraft->name;
        
        $spot = Spot::find($reservation["spot_id"]);
        $reservation["spot_name"] = $spot->name;

        return $reservation;
    }
}