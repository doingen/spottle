<?php

namespace App\Http\Controllers;

use App\Models\Information;

class InfoController extends Controller
{
    public function show($info_id){

        $info = Information::find($info_id);

        $latest = Information::orderBy('created_at', 'desc')->take(1)->get('id');

        foreach($latest as $id){
            $latest = $id;
        }

        return view('info', ['info' => $info, 'latest' => $latest]);
    }
}
