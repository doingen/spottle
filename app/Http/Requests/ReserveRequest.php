<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Models\Reservation;

class ReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(){

        $start_month = substr($this->start_date, 0 ,2);
        $start_day = substr($this->start_date, 3 ,2);
        $end_month = substr($this->end_date, 0 ,2);
        $end_day = substr($this->end_date, 3 ,2);

        $dt = new Carbon;

        $start_at = $dt->create(
                                $this->start_year, 
                                $start_month,
                                $start_day,
                                $this->start_hour, 
                                $this->start_minutes, 
                                00)->toDateTimeString();

        $end_at = $dt->create(
                                $this->end_year, 
                                $end_month,
                                $end_day,
                                $this->end_hour, 
                                $this->end_minutes, 
                                00)->toDateTimeString();
        
        $this->merge([
            'start_at' => $start_at,
            'end_at'=> $end_at
        ]);
    }

    public function withValidator($validator){
        $validator->after(function ($validator) {
            if($this->input('start_at') >= $this->input('end_at')){
                $validator->errors()->add('date', '入力された日時が正しくありません');
            }
            elseif($this->input('start_at') <= date("Y-m-d H:i:s")){
                $validator->errors()->add('date', '過去の日時は入力できません');
            }
            else{
                $r = Reservation::where('spot_id', $this->input('spot_id'))
                                ->get();

                $reserved_a = Reservation::where('spot_id', $this->input('spot_id'))
                                ->where('end_at', "<=", $this->input('start_at'))
                                ->get();

                $reserved_b = Reservation::where('spot_id', $this->input('spot_id'))
                                        ->where('start_at', ">", $this->input('end_at'))
                                        ->get();
        
                $diff = $r->diff($reserved_a)->diff($reserved_b);
                
                if($diff->isNotEmpty()){
                
                foreach($diff as $diff){
                    $user_reserved = $diff->id;
                }
                    if($this->input('reservation_id') != $user_reserved){
                        $validator->errors()->add('reserved', 'すでに予約された日時が含まれています');
                    }
                }
            }
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
