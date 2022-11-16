<?php

namespace App\Http\Controllers\Airport_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Information;

class AddInfoController extends Controller
{
    public function index(){

        $info = Information::all();

        return view('airport_admin.info-add', compact('info'));

    }

    public function create(Request $request){

        $request->validate([
            'title' => 'required|max:50',
            'text'=> 'required'
        ]);
        
        $create = $request->all();
        
        unset($create["_token"]);

        $create["airport_admin_id"] = \Auth::user()->id;

        Information::create($create);

        return redirect('airport_admin/add_info')->with(['success' => '追加完了しました']);

    }

    public function show(Request $request){

        $id = $request->changed_info_id;

        $info = Information::all();

        $selected_info = Information::find($id);

        return view('airport_admin.info-add', compact('info', 'selected_info'));
    }

    public function update(Request $request){

        $request->validate([
            'changed_title' => 'required|max:50',
            'changed_text' => 'required'
        ]);

        $update = [
            'airport_admin_id' => \Auth::user()->id, 
            'title' => $request->changed_title, 
            'text' => $request->changed_text
        ];

        Information::where('id', $request->changed_info_id)->update($update);

        return redirect('airport_admin/change_info')->with(['changed_success' => '変更完了しました']);
    }
}
