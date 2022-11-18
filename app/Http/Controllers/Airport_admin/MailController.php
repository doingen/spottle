<?php

namespace App\Http\Controllers\Airport_admin;

use App\Http\Controllers\Controller;
use App\Mail\AirportAdminMail;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(){

        return view('airport_admin.create-mail');

    }

    public function sendConfirm(Request $request){

        $request->validate([
            'subject' => 'required',
            'text' => 'required'
        ]);

        $users = User::all();
        $verified = collect();

        foreach($users as $user){
            if($user->hasVerifiedEmail()){
                $verified->push($user);
            }
        }

        if($verified->isEmpty()){
            return redirect('airport_admin/mail')->withInput()
                                                ->with('error', '送信先が存在しません');
        }

        $mail = $request->all();

        return view('airport_admin.mail-confirm', compact('mail'));

    }

    public function send(Request $request){

        $subject = $request->subject;
        $text = $request->text;

        $users = User::all();
        $verified = collect();

        foreach($users as $user){
            if($user->hasVerifiedEmail()){
                Mail::to($user->email)->send(new AirportAdminMail($subject, $text));
            }
        }

        $request->session()->regenerate();

        return view('airport_admin.mail-thanks');
    }

}
