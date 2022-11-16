<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Airport_admin;
use App\Http\Controllers\Airport_admin\Auth\AuthenticatedSessionController;

class FirstLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->password == "spottle1120"){

            $user = Airport_admin::where('email', $request->email)->get();
            
            foreach($user as $user){
                $user_id = $user->id;
            }
            
            return redirect()->route('airport_admin.set_password', ['user' => $user_id]);
        }

        return $next($request);

    }
}
