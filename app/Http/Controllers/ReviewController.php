<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $review = new Review();
        $review->product_id = $request->input('product_id');
        $review->user_id = Auth::user()->id;
        $review->comment = $request->input('comment');
        $review->rating = $request->input('rating');

        $review->save();

        return redirect()->back();
    }

    public function approveReview($id)
    {

        $user_name = DB::table('users')
            ->select('users.fname')
            ->join('reviews', 'reviews.user_id', 'users.id')
            ->where('reviews.id', $id)
            ->first();
        $userName = $user_name->fname;
        // $user_name = 'Sambo';
        // $user_email = 'lucksolent@gmail.com';
        $user_email = DB::table('users')
            ->select('users.email')
            ->join('reviews', 'reviews.user_id', 'users.id')
            ->where('reviews.id', $id)
            ->first();
        $userEmail = $user_email->email;

        $product_name = DB::table('products')
            ->select('products.name')
            ->join('reviews', 'reviews.product_id', 'products.id')
            ->where('reviews.id', $id)
            ->first();

        $product_pic = DB::table('products')
            ->select('products.image')
            ->join('reviews', 'reviews.product_id', 'products.id')
            ->where('reviews.id', $id)
            ->first();
        $review = Review::where('id', $id)->first()->comment;
        $review_date = Review::where('id', $id)->first()->updated_at;
        $rating = Review::where('id', $id)->first()->rating;

        $data = [
            'title' => 'Your review is approved!',
            'reciever' => $user_name->fname,
            'review' => $review,
            'rating' => $rating,
            'product_name' => $product_name->name,
            'product_image' => $product_pic->image,
            'content' => 'Your review on ' . $review_date . ' has been approved!',
            'updater' => Auth::user()->email,
            'salutation' => 'Potted Pan Team'
        ];



        if (Review::find($id)) {

            Mail::send('email.mailReview', $data, function ($message) use ($userEmail, $userName) {


                $message->to($userEmail, $userName);
                $message->subject('Your review is approved!');
            });

            Review::where('id', $id)->update([
                'is_approved' => 2
            ]);



            session()->flash('success', 'You have approved a review!');
            return redirect()->back();
        } else {
            session()->flash('error', 'There is error occur!');
            return redirect()->back();
        }
    }
    public function blockReview($id)
    {

        $user_name = DB::table('users')
            ->select('users.fname')
            ->join('reviews', 'reviews.user_id', 'users.id')
            ->where('reviews.id', $id)
            ->first();
        $userName = $user_name->fname;
        // $user_name = 'Sambo';
        // $user_email = 'lucksolent@gmail.com';
        $user_email = DB::table('users')
            ->select('users.email')
            ->join('reviews', 'reviews.user_id', 'users.id')
            ->where('reviews.id', $id)
            ->first();
        $userEmail = $user_email->email;

        $product_name = DB::table('products')
            ->select('products.name')
            ->join('reviews', 'reviews.product_id', 'products.id')
            ->where('reviews.id', $id)
            ->first();

        $product_pic = DB::table('products')
            ->select('products.image')
            ->join('reviews', 'reviews.product_id', 'products.id')
            ->where('reviews.id', $id)
            ->first();
        $review = Review::where('id', $id)->first()->comment;
        $review_date = Review::where('id', $id)->first()->updated_at;
        $rating = Review::where('id', $id)->first()->rating;

        $data = [
            'title' => 'Your review is blocked!',
            'reciever' => $user_name->fname,
            'review' => $review,
            'rating' => $rating,
            'product_name' => $product_name->name,
            'product_image' => $product_pic->image,
            'content' => 'Your review on ' . $review_date . ' has been blocked due to some inapproprate languages.',
            'addition' => 'We will delete this review soon if there is no updates.',
            'updater' => Auth::user()->email,
            'salutation' => 'Potted Pan Team'
        ];



        if (Review::find($id)) {

            Mail::send('email.mailReview', $data, function ($message) use ($userEmail, $userName) {


                $message->to($userEmail, $userName);
                $message->subject('Your review is blocked!');
            });

            Review::where('id', $id)->update([
                'is_approved' => 0
            ]);



            session()->flash('success', 'You have blocked a review!');
            return redirect()->back();
        } else {
            session()->flash('error', 'There is error occur!');
            return redirect()->back();
        }
    }

    public function deleteReview($id)
    {

        $user_name = DB::table('users')
            ->select('users.fname')
            ->join('reviews', 'reviews.user_id', 'users.id')
            ->where('reviews.id', $id)
            ->first();
        $userName = $user_name->fname;
        // $user_name = 'Sambo';
        // $user_email = 'lucksolent@gmail.com';
        $user_email = DB::table('users')
            ->select('users.email')
            ->join('reviews', 'reviews.user_id', 'users.id')
            ->where('reviews.id', $id)
            ->first();
        $userEmail = $user_email->email;

        $product_name = DB::table('products')
            ->select('products.name')
            ->join('reviews', 'reviews.product_id', 'products.id')
            ->where('reviews.id', $id)
            ->first();

        $product_pic = DB::table('products')
            ->select('products.image')
            ->join('reviews', 'reviews.product_id', 'products.id')
            ->where('reviews.id', $id)
            ->first();
        $comment = Review::where('id', $id)->first()->comment;
        $review_date = Review::where('id', $id)->first()->updated_at;
        $rating = Review::where('id', $id)->first()->rating;

        $data = [
            'title' => 'Your review is deleted!',
            'reciever' => $user_name->fname,
            'review' => $comment,
            'rating' => $rating,
            'product_name' => $product_name->name,
            'product_image' => $product_pic->image,
            'content' => 'Your review on ' . $review_date . ' has been deleted due to some inapproprate languages!',
            'updater' => Auth::user()->email,
            'salutation' => 'Potted Pan Team'
        ];

        $review = Review::withTrashed()->where('id', $id)->firstOrFail();

        if ($review->trashed()) {
            $review->forceDelete();

            Mail::send('email.mailReview', $data, function ($message) use ($userEmail, $userName) {


                $message->to($userEmail, $userName);
                $message->subject('Your review is deleted!');
            });


            session()->flash('success', 'You have delete a review from trash!');
            return redirect(route('trash'));
        } else {
            $review->delete();
            session()->flash('success', 'You have delete a review!');
            return redirect()->back();
        };

    }
}
