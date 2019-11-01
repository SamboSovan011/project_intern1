<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Categories;
use App\Slide;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Products;
use App\Review;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slides = Slide::where('is_approved', 2)->get();
        $cates = Categories::where('is_approved', 2)->get();
        $products = Products::where('is_approved', 2)->paginate(9);
        return view('frontend.home', compact('cates', 'slides', 'products'));
    }

    public function Signup()
    {
        return view('frontend.signup');
    }

    // public function Login(){
    //     return view('auth.login');
    // }


    //User Profile
    public function showUserProfile()
    {
        return view('frontend.userProfile');
    }

    public function updateProfile(Request $request, $id)
    {
        if ($request->all()) {
            $validateData = $request->validate([
                'user-Email' => 'required|email|max:255',
                'user-firstname' => 'required|max:255',
                'user-lastname' => 'required|max:255',
                'user-phone' => 'required|integer|digits_between:8,20',
            ]);
            if ($validateData) {
                User::findOrFail($id)
                    ->update([
                        'fname' => $request->input('user-firstname'),
                        'lname' => $request->input('user-lastname'),
                        'phone' => $request->input('user-phone'),
                        'email' => $request->input('user-Email')
                    ]);
                session()->flash('success', 'You successfully updated your account!');
                return redirect()->route('userprofile');
            }
        } else {
            session()->flash('error', 'Fail to update account!');
            return redirect()->route('userprofile');
        }
    }

    public function changePass(Request $request, $id)
    {
        if ($request->all()) {
            if (User::findOrFail($id)) {
                $validateData =  $request->validate([
                    'current-pass' => 'required|min:8',
                    'new-pass' => 'required|min:8',
                    'confirm-pass' => 'required|min:8'
                ]);

                if ($validateData) {
                    $currentPass = $request->input('current-pass');
                    $newPass = $request->input('new-pass');
                    if (Hash::check($currentPass, Auth::user()->password)) {
                        $request->user()->fill([
                            'password' => Hash::make($newPass)
                        ])->save();
                        session()->flash('success', 'Successfully! Update password.');
                        return redirect()->route('userprofile');
                    } else {
                        session()->flash('error', 'Failed! To Update password.');
                        return redirect()->route('userprofile');
                    }
                }
            } else {
                return redirect()->route('userprofile');
            }
        } else {
            return redirect()->route('userprofile');
        }
    }

    public function show($id)
    {
        $products = Products::find($id);
        $productItemsUser = Products::where('id', $id)->with('reviews.users')->with(['reviews' => function ($query) {
            $query->where('is_approved', 2)->orderBy('updated_at', 'desc');
        }])->get();;
        $productItemsAdmin = Products::where('id', $id)->with('reviews.users')->with(['reviews' => function ($query) {
            $query->orderBy('updated_at', 'desc');
        }])->get();;
        // dd($productItemsUser);
        return view('frontend.single_product', compact('productItemsAdmin', 'productItemsUser'))->with('product', $products);
    }

    //Review

    public function getReview()
    {
        $productItems = Products::where('id', Auth::user()->id)->with('reviews.users')->with(['reviews' => function ($query) {
            $query->orderBy('updated_at', 'desc');
        }])->get();;
        return view('listing.review', compact('productItems'));
    }

    public function getComment($id)
    {
        if (request()->ajax()) {
            $data = Review::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function editReview(Request $request, $id)
    {

        $validateData = $request->validate([
            'comment' => 'required|max:65535'
        ]);
        if ($validateData) {
            if (Review::find($id)) {
                Review::where('id', $id)
                    ->update([
                        'comment' => $request->input('comment'),
                        'rating' => $request->input('rating'),
                        'is_approved' => 1
                    ]);
                session()->flash('success', 'Successfully! Update Review.');
                return redirect()->back();
            }
        }
    }

    //Promotion

    public function checkPromotion($id)
    {
        $product = Products::where('id', $id)->first();
        $startDate = $product->startDatePro;

        $createdAt = Carbon::parse($startDate);
        $startProDate = $createdAt->format('Y-m-d');
        $startPromoDate = Carbon::parse($startProDate);
        // dd($endPromoDate);
        $endDate = $product->stopDatePro;
        $endAt = Carbon::parse($endDate);
        $endProDate = $endAt->format('Y-m-d');
        $endPromoDate = Carbon::parse($endProDate);
        // dd($endPromoDate);
        $currentDate = Carbon::now();


        if ($currentDate->greaterThanOrEqualTo($startPromoDate)) {
            if ($currentDate->greaterThan($endPromoDate)) {
                return Products::where('id', $id)
                    ->update([
                        'discount' => null,
                        'startDatePro' => null,
                        'stopDatePro' => null,
                        'priceAfterPro' => null
                    ]);
            }
        }
    }

    public function promotionProduct()
    {
        $products = Products::whereNotNull('discount')->where('is_approved', 2)->get();
        $currentDate = Carbon::now()->timestamp;

        // dd($products->startDatePro <= date('m/d/Y'));
        foreach ($products as $product) {
            // dd($product->id);
            $this->checkPromotion($product->id);
        }
        $productPro = Products::whereNotNull('discount')->where('is_approved', 2)->where('startDatePro', '<=', date('m/d/Y'))->paginate(9);

        $cates = Categories::where('is_approved', 2)->get();


        return view('frontend.promotion', compact('productPro', 'cates'));
    }
}
