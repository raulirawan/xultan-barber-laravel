<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        if(Auth::user() && Auth::user()->roles == 'ADMIN')
        {
             return $next($request);
        }

        if(Auth::user() && Auth::user()->roles == 'BARBER')
        {
             return redirect()->route('dashboard');
        }
        
        return redirect()->route('dashboard');
       
    }
}
