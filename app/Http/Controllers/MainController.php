<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Information;

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
}
