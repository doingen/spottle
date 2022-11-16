<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Airport_admin;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    public function index(){

        return view('admin.main');
        
    }

    public function create(Request $request){
        
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:airport_admins'],
        ]);

        $user = Airport_admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => "spottle1120",
        ]);

        event(new Registered($user));

        return redirect('admin')->with('result', '追加登録が完了しました');
    }
}
