<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Login
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
        if(Auth::user()){
            if (Auth::user()->status == "3" || Auth::user()->status == "2")
            {
                return $next($request);
            }else{
                return redirect(route('masuk'))->withInfo('Anda belum melakukan aktifasi');
            }
        }else{
            return redirect(route('masuk'));
        }        
    }
}
