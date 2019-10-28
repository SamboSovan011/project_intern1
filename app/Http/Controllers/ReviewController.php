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

    public function approveReview($id){

        $user_name = User::with('reviews')->where('reviews.id', $id)->with(['users' => function ($query){
                            $query->select(['fname'])->whereColumn('id', 'reviews.user_id');
        }])->first();
        $data = [
            'title' => 'You have been assign as User',
            'reciever' => $user_name,
            'content' => 'Potted Pan has assign your account to User Account!',
            'updater' => Auth::user()->email,
            'salutation' => 'Potted Pan Team'
        ];

        if(Review::find($id)){
            Review::where('id', $id)->update([
                'is_approved' => 1
            ]);

            session()->flash('success', 'You have approved a review!');
            return redirect()->back();
        }else{
            session()->flash('error', 'There is error occur!');
            return redirect()->back();
        }
    }



}
