<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Products;
use Auth;
class ShoppingCartController extends Controller
{
    public function addToCart(){
        $products = Products::find(request()->pdt_id);
        $cart = Cart::add([
            'id' => $products->id,
            'name' =>$products->name,
            'price' =>$products->priceAfterPro,
            'qty' =>request()->qty,
            'weight' => 0,

        ]);


        Cart::associate($cart->rowId, 'App\Products');
        return redirect()->route('shopping.index');
    }

    public function index(){

        // dd(Cart::content()->count());
        $countCart = Cart::content()->count();
        return view('cart.cart', compact('countCart'));
    }

    public function delete($id) {
        Cart::remove($id);

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
