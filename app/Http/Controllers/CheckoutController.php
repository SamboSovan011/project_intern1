<?php

namespace App\Http\Controllers;
use Cart;
use App\Products;
use Illuminate\Http\Request;
use Auth;
use Exception;
use Stripe\Stripe;
use Stripe\Charge;

class CheckoutController extends Controller
{
    public function checkout(){
        return view('frontend.checkout');
    }

    public function store(Request $request){
        // dd($request->all());
        Stripe::setApiKey('sk_test_uSwHYtVuuUEX7NC0T5DfQ6bZ00mwyc4QKV');
        $charge = Charge::create([
            'amount' => Cart::total() * 100,
            'currency' => 'usd',
            'description' => 'Potted Pan Product Payment',
            'source' => $request->stripeToken,
        ]);

        return redirect()->back();

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
