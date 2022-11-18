<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Information;
use App\Models\Reservation;

class MainController extends Controller
{
    public function index(){

        $info = Information::orderBy('created_at', 'desc')->take(3)->get();

        return view('main', ['info' => $info]);
    }

    public function show($info_id){

        $info = Information::find($info_id);

        return view('info', ['info' => $info]);

    }

    public function mypage(){

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
