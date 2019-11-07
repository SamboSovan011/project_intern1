<?php

namespace App\Http\Controllers;

use Cart;
use App\User;
use App\Products;
use Illuminate\Http\Request;
use Auth;
use Exception;
use Stripe\Stripe;
use Stripe\Charge;

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function store(Request $request)
    {

        // dd($request->all());

        if (!empty($request->input('email2')) && !empty($request->input('phone2'))) {
            $dataValidate = $request->validate([
                'fullname' => 'required|max:20',
                'email1' => 'required|email|max:225',
                'email2' => 'email|max:225',
                'phone1' => 'required|integer|digits_between:8,20',
                'phone2' => 'integer|digits_between:8,20',
                'address1' => 'required',
                'country' => 'required',
                'city' => 'required',
                'zip' => 'required',
            ]);
        } elseif (!empty($request->input('email2')) && empty($request->input('phone2'))) {
            $dataValidate = $request->validate([
                'fullname' => 'required|max:20',
                'email1' => 'required|email|max:225',
                'email2' => 'email|max:225',
                'phone1' => 'required|integer|digits_between:8,20',
                'address1' => 'required',
                'country' => 'required',
                'city' => 'required',
                'zip' => 'required',
            ]);
        } elseif (empty($request->input('email2')) && !empty($request->input('phone2'))) {
            $dataValidate = $request->validate([
                'fullname' => 'required|max:20',
                'email1' => 'required|email|max:225',
                'phone1' => 'required|integer|digits_between:8,20',
                'phone2' => 'integer|digits_between:8,20',
                'address1' => 'required',
                'country' => 'required',
                'city' => 'required',
                'zip' => 'required',
            ]);
        } else {
            $dataValidate = $request->validate([
                'fullname' => 'required|max:20',
                'email1' => 'required|email|max:225',
                'phone1' => 'required|integer|digits_between:8,20',
                'address1' => 'required',
                'country' => 'required',
                'city' => 'required',
                'zip' => 'required',
            ]);
        }


        if ($dataValidate) {
            foreach (Cart::content() as $product) {
                $user_id = Auth::user()->id;
                $user = User::find($user_id);
                // dd($user);
                $products = $product->id;
                $user->products()->attach([
                    $products => [
                        'fullname' => $request->fullname,
                        'qty' => $product->qty,
                        'email1' => $request->email1,
                        'email2' => $request->email2,
                        'phone1' => $request->phone1,
                        'phone2' => $request->phone2,
                        'address1' => $request->address1,
                        'address2' => $request->address2,
                        'country' => $request->country,
                        'city_province' => $request->city,
                        'zip' => $request->zip,
                        '_token' => $request->_token,
                        'subtotal' => $product->subtotal,
                        'total' => $product->total,
                    ]
                ]);


                $item = Products::where('id', $product->id)->first();
                $stock = number_format($item->stock);
                $qty = number_format($product->qty);

                $stock_after = $stock - $qty;
                Products::where('id', $product->id)->update([
                    'stock' => $stock_after,
                ]);



            }


            Stripe::setApiKey('sk_test_uSwHYtVuuUEX7NC0T5DfQ6bZ00mwyc4QKV');
            $charge = Charge::create([
                'amount' => Cart::total() * 100,
                'currency' => 'usd',
                'description' => 'Potted Pan Product Payment',
                'source' => $request->stripeToken,
            ]);

            Cart::destroy();
        }

        session()->flash('success', 'You have successfully checkout your purchase');
        return redirect('/');
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
