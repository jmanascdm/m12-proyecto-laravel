<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->admin != 1) {
            $error_title = 'Accés prohibit';
            $error_msg = 'No tens permís per accedir a aquesta pàgina. Si creus que podria ser un error, si us plau, 
            preguem que ho notifiquis a un administrador.';

            return redirect( route('error',compact('error_title','error_msg')) );
        }
        return $next($request);
    }
}
