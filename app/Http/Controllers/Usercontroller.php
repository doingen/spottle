<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Usercontroller extends Controller
{
    public function index(){

        $user = Reservation::where('user_id', Auth::id())
                    ->where('start_at', '>=', date("Y-m-d H:i:s"))
                    ->orderBy('start_at', 'asc')
                    ->with('aircraft')
                    ->with('spot')
                    ->get();
                    
        return view('mypage', ['user' => $user]);
    }
}
