<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Products;
use App\Shoppingcart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Session;
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

        // dd(Cart::instance('shopping')->content()->count());
        if (Cart::instance('shopping')->content()->count() <= 0) {
            // dd(Cart::content()->count());
            session()->flash('error', 'You can not checkout without buying anything, Sorry!');
            return redirect()->back();
        } else {
            return $next($request);
        }
    }
}
