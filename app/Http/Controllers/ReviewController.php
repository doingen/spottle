<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Spot_review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function show(Request $request){

        $reservation = Reservation::where('id', $request->reservation_id)
                                    ->with('aircraft', 'spot')
                                    ->get();

        return view('review', compact('reservation'));

    }

    public function create(Request $request){

        $review = $request->all();
        
        unset($review['_token']);

        Spot_review::create($review);

        return view('thanks');
    }
}
