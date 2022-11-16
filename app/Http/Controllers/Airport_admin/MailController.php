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

        $mail = $request->all();

        return view('airport_admin.mail-confirm', compact('mail'));

    }

    public function send(Request $request){

        $subject = $request->subject;
        $text = $request->text;

        $user = User::whereNotNull('email_verified_at')->get();

        
        foreach($user as $user){
            Mail::to($user)->send(new AirportAdminMail($subject, $text));
        }

        return redirect('airport_admin/mail')->with('success', 'メール送信完了しました');
    }

}
