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

        $reservation = [];
        $reservation["spot_id"] = $requests["spot_id"];
        $reservation["aircraft_id"] = $requests["aircraft_id"];
        $reservation["user_id"] = 1;
        $reservation["tel"] = "123456789";

        $start_month = substr($requests["start_date"], 0 ,2);
        $start_day = substr($requests["start_date"], 3 ,2);
        $end_month = substr($requests["end_date"], 0 ,2);
        $end_day = substr($requests["end_date"], 3 ,2);

        $dt = new Carbon;

        $reservation["start_at"] = $dt->create(
                                    $requests["start_year"], 
                                    $start_month,
                                    $start_day,
                                    $requests["start_hour"], 
                                    $requests["start_minutes"], 
                                    00)->toDateTimeString();

        $reservation["end_at"] = $dt->create(
                                    $requests["end_year"], 
                                    $end_month,
                                    $end_day,
                                    $requests["end_hour"], 
                                    $requests["end_minutes"], 
                                    00)->toDateTimeString();

        if($reservation["start_at"] >= $reservation["end_at"]){
            return null;
        }

        else{
        $r = Reservation::where('spot_id', $reservation["spot_id"])
                        ->get();

        $reserved_a = Reservation::where('spot_id', $reservation["spot_id"])
                                ->where('end_at', "<=", $reservation["start_at"])
                                ->get();

        $reserved_b = Reservation::where('spot_id', $reservation["spot_id"])
                                ->where('start_at', ">", $reservation["end_at"])
                                ->get();
        
        $diff = $r->diff($reserved_a)->diff($reserved_b);

        return array($reservation, $diff);
        }
    }
}