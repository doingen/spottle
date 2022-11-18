<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Mypagecontroller extends Controller
{
    public function index(){

        $reserve = Reservation::where('user_id', Auth::id())
                    ->where('end_at', '>', date("Y-m-d H:i:s"))
                    ->orderBy('start_at', 'asc')
                    ->with('aircraft', 'spot')
                    ->get();

        $review = Reservation::where('user_id', Auth::id())
                    ->where('end_at', '<=', date("Y-m-d H:i:s"))
                    ->orderBy('end_at', 'desc')
                    ->with('aircraft', 'spot')
                    ->take(3)
                    ->get();

        return view('mypage', compact('reserve', 'review'));
    }
}
