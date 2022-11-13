<?php

namespace App\Http\Controllers\Airport_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Information;

class AddInfoController extends Controller
{
    public function index(){

        return view('airport_admin.info-add');

    }

    public function create(Request $request){

        $request->validate([
            'title' => 'required|max:50',
            'text'=> 'required'
        ]);
        
        $create = $request->all();
        
        unset($create["_token"]);

        $create["airport_admin_id"] = 1;

        Information::create($create);

        return redirect('airport_admin/add_info')->with(['success' => '追加完了しました']);

    }
}
