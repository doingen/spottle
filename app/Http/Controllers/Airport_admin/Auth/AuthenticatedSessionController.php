<?php

namespace App\Http\Controllers\Airport_admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Models\Airport_admin;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('airport_admin.login');
    }

    public function setPassword(Request $request){  
        
        return view('airport_admin.change-password', ['user' => $request->user]);

    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended('airport_admin')->with('result', 'ログインしました');
    }

    public function update(Request $request){

        if($request->password == "spottle1120"){
            return redirect()->back()
                            ->with('error', '初期パスワードは再利用しないでください');
        }

        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::min(8),'max:191']
        ]);
        
        $update["password"] = Hash::make($request->password);

        Airport_admin::where('id', $request->id)->update($update);

        return redirect('airport_admin/login')->with('result', 'パスワードを変更完了しました');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('airport_admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('airport_admin/login')->with('result', 'ログアウトしました');
    }
}
