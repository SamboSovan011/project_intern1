<?php

namespace App\Http\Middleware;

use Closure;
use Cart;
use Illuminate\Support\Facades\Auth;

class checkout
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
            if(Cart::content()->count() <= 0){
                session()->flash('error', 'You can not checkout without buying anything, Sorry!');
                return redirect()->back();
            }else{
                return $next($request);
            }
        }
    }
}
