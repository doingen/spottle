<?php

namespace App\Http\Controllers\Airport_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Spot;

class AddSpotController extends Controller
{
    public function index(){

        return view('airport_admin.spot-add');

    }

    public function create(Request $request){

        $request->validate([
            'name' => 'required|unique:spots|max:10'
        ]);
        
        $create = $request->all();

        unset($create["_token"]);

        $create["airport_admin_id"] = 1;

        Spot::create($create);

        $added_spot = $create["name"];

        return redirect('airport_admin/add_spot')->with(['success' => 'を追加しました',
                                                        'added_spot' => $added_spot]);
    }
}
