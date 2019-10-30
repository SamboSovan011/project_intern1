<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
            if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2){
                return $next($request);
            }
            else{
                return redirect("/");
            }
        }else{
            return redirect("/");
        }


    }
}
