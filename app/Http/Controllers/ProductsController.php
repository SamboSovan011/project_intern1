<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Categories;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Products\CreateProductsRequest;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Products\UpdateRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        $productSub = Products::where('email', Auth::user()->email)->get();
        return view('dashboard.products')->with('products', $products)->with('productSub', $productSub);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Categories::where('is_approved', 2)->get();
        return view('products.post_products')->with('categories', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(CreateProductsRequest $request)
    {
        $image = $request->image->store('Products');


        if(! empty($request->discount)){
            $validate = $request->validate([
                'discount' => 'required|between:0,100',
                'startDate' => 'required|date_format:m/d/Y',
                'endDate' => 'required|date_format:m/d/Y'
            ]);
            $currPrice = $request->price;
            $disc = $request->discount;
            $priceDisc = ($currPrice * $disc) / 100;
            $priceAfter = $currPrice - $priceDisc;
            Products::create([
                'name' => $request->name,
                'description' =>$request->description,
                'stock' =>$request->stock,
                'SKU' =>$request->SKU,
                'price' =>$request->price,
                'image' =>$image,
                'email'=>Auth::user()->email,
                'categories_id'=>$request->category,
                'discount' => $request->discount,
                'startDatePro' => $request->startDate,
                'stopDatePro' => $request->endDate,
                'priceAfterPro' => $priceAfter,
            ]);
            session()->flash('success', 'You have post a new product!');

            return redirect()->route('products.index');
        }else{
            Products::create([
                'name' => $request->name,
                'description' =>$request->description,
                'stock' =>$request->stock,
                'SKU' =>$request->SKU,
                'price' =>$request->price,
                'image' =>$image,
                'email'=>Auth::user()->email,
                'categories_id'=>$request->category,
                'priceAfterPro' => $request->price,
            ]);
            session()->flash('success', 'You have post a new product!');

            return redirect()->route('products.index');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        $category = Categories::where('is_approved', 2)->get();
        return view('products.post_products')->with('products', $product)->with('categories', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request,Products $product)
    {
        $data = $request->only(['name', 'description', 'price', 'SKU', 'stock']);

        if($request->hasFile('image')){
            $image = $request->image->store('Products');
            Storage::delete($product->image);
            $data['image'] = $image ;
        }
        $data['categories_id'] = $request->category;
        $data['is_approved'] = 1;
        $product->update($data);


        session()->flash('success', 'You have edited a new product!');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::withTrashed()->where('id',$id)->firstOrFail();

        if($product->trashed()){
            Storage::delete($product->image);
            $product->forceDelete();


            session()->flash('success', 'You have delete a product!');

            return redirect(route('products.trashed'));
        }else{
            $product->delete();
            session()->flash('success', 'You have delete a product!');

            return redirect(route('products.index'));
        };

    }

    public function trash(){
        $trashed = Products::onlyTrashed()->get();

        return view('dashboard.products')->with('products', $trashed)->with('trash',$trashed);
    }

    public function restore($id){
        $product = Products::withTrashed()->where('id',$id)->firstOrFail();
        $cate = Categories::withTrashed()
                ->join('products', 'products.categories_id', 'category.id')
                ->where('products.id', $id)
                ->first();
        $cate->restore();
        $product->restore();

        session()->flash('success', 'You have restore a product!');

        return redirect()->back();
    }

    public function approve($id){
        if (Products::findOrFail($id)) {
            Products::where('id', $id)
                ->update(['is_approved' => 2]);
            session()->flash('success', 'You just approved a product post!');
        }

        return redirect()->route('products.index');
    }

    public function block($id){
        if (Products::findOrFail($id)) {
            Products::where('id', $id)
                ->update(['is_approved' => 0]);
            session()->flash('success', 'You just approved a product post!');
        }

        return redirect()->route('products.index');
    }


}
