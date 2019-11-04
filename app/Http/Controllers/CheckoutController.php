<?php

namespace App\Http\Controllers;
use Cart;
use App\Products;
use Illuminate\Http\Request;
use Auth;

class CheckoutController extends Controller
{
    public function checkout(){
        return view('frontend.checkout');
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
          Cart::instance('shopping');
          Cart::restore(Auth::id());

          return $next($request);
      });
    }
    public function __destruct()
    {
        Cart::instance('shopping')->store(Auth::id());
    }
}
