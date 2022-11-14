<?php

namespace App\Http\Requests\Airport_admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Aircraft;
use App\Models\Spot;


class ChangeAircraftRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        $original_name = Aircraft::find($this->input('aircraft_id'))->name;

        if($this->input('changed_name') != $original_name){
            return [
                'changed_name' => 'required|max:191',
                'changed_spot_id' => 'required'
            ];
        }
        else{
            return ['changed_spot_id' => 'required'];
        }
    }

    public function withValidator($validator){
        $validator->after(function ($validator) {

            $original_name = Aircraft::find($this->input('aircraft_id'))->name;

            $a = [$this->input('aircraft_id')];
            $original_spot = Spot::whereHas('aircraft', function($query) use($a)  {
                                $query->where('aircraft_spot.aircraft_id', $a);
                            })->pluck('id')->toArray();

            if(Aircraft::all()->pluck('name')->contains($this->input('changed_name')) && $this->input('changed_name') != $original_name){
                $validator->errors()->add('changed_error', 'この名前はすでに使用されています');
            }
            elseif($this->input('changed_spot_id') != null && 
            !array_diff($original_spot, $this->input('changed_spot_id')) && 
            !array_diff($this->input('changed_spot_id'), $original_spot) &&
            $this->input('changed_name') == $original_name){
                $validator->errors()->add('changed_error', '変更がありません');
            }
        });
    }
}
