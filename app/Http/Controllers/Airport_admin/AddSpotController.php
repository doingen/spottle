<?php

namespace App\Http\Controllers\Airport_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Spot;

class AddSpotController extends Controller
{
    public function index(){

        $spots = Spot::all();

        return view('airport_admin.spot-add', compact('spots'));

    }

    public function create(Request $request){

        $request->validate([
            'name' => 'required|unique:spots|max:10'
        ]);
        
        $create = $request->all();

        unset($create["_token"]);

        $create["airport_admin_id"] = \Auth::user()->id;

        Spot::create($create);

        $added_spot = $create["name"];

        return redirect('airport_admin/add_spot')->with(['success' => 'を追加しました',
                                                        'added_spot' => $added_spot]);
    }

    public function update(Request $request){

        $id = $request->changed_spot_id;
        $name = $request->changed_name;

        $spot = Spot::find($id)->name;

        if($spot == $name){
            return redirect('airport_admin/add_spot')->with(['changed_error' => '名前が変更されていません', 
                                                            'input' => $name]);
        }
        elseif(Spot::all()->pluck('name')->contains($name)){
            return redirect('airport_admin/add_spot')->with(['changed_error' => 'この名前はすでに使用されています', 
                                                            'input' => $name]);
        }

        $request->validate([
            'changed_name' => 'required|max:10'
        ]);

        Spot::where('id', $id)->update(["airport_admin_id" => \Auth::user()->id, 
                                        "name" => $name]);

        return redirect('airport_admin/add_spot')->with('changed_success', '変更しました');

    }
}
