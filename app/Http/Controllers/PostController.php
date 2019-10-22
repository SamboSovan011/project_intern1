<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Categories;
use App\User;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('dashboard.product')->with('post', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Categories::all();
        return view('post.post_products')->with('categories', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->all()) {
            $validateData = $request->validate([
                'name' => 'required|max:500',
                'description' => 'required|max:65535',
                'image' => 'required|mimes:jpeg,png,jpg,svg,gif',
                'price' => 'required',
                'stock' => 'required|unique:posts',
                'sku'   => 'required'

            ]);

            if ($validateData) {
                $product = new Post();
                $product->email = Auth::user()->email;
                $product->name = $request->input('name');
                $product->description = $request->input('description');
                $product->price = $request->input('price');
                $product->stock = $request->input('stock');
                $product->sku = $request->input('sku');



                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('product_img/', $filename);
                    $filepath = '/product_img/' . $filename;
                    $product->image = $filepath;

                    session()->flash('success', 'You have post a new product!');
                }

                $product->save();
                return redirect()->route('post.index');
            }
        } else {
            session()->flash('error', 'Sorry! We could not get all data. Please reinsert again!');
            return redirect()->route('product.create');
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
    public function getdata($id)
    {
        if (request()->ajax()) {
            $data = Post::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatepost(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:500',
            'description' => 'required|max:65535',
            'image' => 'required|mimes:jpeg,png,jpg,svg,gif',
            'price' => 'required',
            'stock' => 'required|unique:posts',
            'sku'   => 'required'
        ]);

        if ($validateData) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . "." . $extension;
                $file->move('product_img/', $filename);
                $img_path = "/product_img/" . time() . "." . $extension;
                Slide::where('id', $id)->update([
                    'name' => $request->input('title'),
                    'price' => $request->input('price'),
                    'sku' => $request->input('sku'),
                    'stock' => $request->input('stock'),
                    'description' => $request->input('description'),
                    'img_path' => $img_path,

                ]);
                session()->flash('success', 'You have successfully update a post!');

                return redirect()->route('post.index');
            } else {
                Slide::where('id', $id)->update([
                    'name' => $request->input('title'),
                    'price' => $request->input('price'),
                    'sku' => $request->input('sku'),
                    'stock' => $request->input('stock'),
                    'description' => $request->input('description'),
                ]);
                session()->flash('success', 'You have successfully update a post!');

                return redirect()->route('post.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Post::findOrFail($id)) {
            Post::where('id', $id)
                ->delete();
            session()->flash('success', 'You just deleted a slide!');
        } else {
            session()->flash('error', 'Sorry, there is some wrong occur!');
        }

        return redirect()->route('post.index');
    }
}
