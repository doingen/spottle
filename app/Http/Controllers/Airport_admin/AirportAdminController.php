<?php

namespace App\Http\Controllers\Airport_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Airport_admin;

class AirportAdminController extends Controller
{
    public function index(){

        $spots = Spot::all();

        return view('airport_admin.main', compact('spots'));
        
    }
}
