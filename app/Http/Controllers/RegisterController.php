<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show() {

        return view('register');
        
    }

    public function confirm(RegisterRequest $request) {

        $r = $request->all();

        return view('register_confirm', ['register' => $r]);
    }

    public function create(Request $request) {

        $register = $request->register;

        $user = User::create([
            'name' => $register["name"],
            'email' => $register["email"],
            'tel' => $register["tel"],
            'password' => Hash::make($register["password"]),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}
