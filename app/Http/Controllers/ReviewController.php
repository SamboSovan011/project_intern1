<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Products;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request){
        $review = new Review();
        $review->product_id = $request->input('product_id');
        $review->user_id = Auth::user()->id;
        $review->comment = $request->input('comment');
        $review->rating = $request->input('rating');

        $review->save();

        return redirect()->back();
    }


}
