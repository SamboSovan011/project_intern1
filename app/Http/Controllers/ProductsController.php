<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Categories;
use App\Http\Requests\Products\CreateProductsRequest;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Products\UpdateRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        return view('dashboard.products')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Categories::all();
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

        Products::create([
            'name' => $request->name,
            'description' =>$request->description,
            'stock' =>$request->stock,
            'SKU' =>$request->SKU,
            'price' =>$request->price,
            'image' =>$image,
            'email'=>Auth::user()->email,
        ]);

        session()->flash('success', 'You have post a new product!');

        return redirect()->route('products.index');
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
        $category = Categories::all();
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
        $product->restore();

        session()->flash('success', 'You have restore a product!');

        return redirect()->back();
    }
}
