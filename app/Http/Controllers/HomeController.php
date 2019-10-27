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
        $products = Products::all();
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

    public function show($id){
        $products = Products::find($id);
        $productItems = Products::where('id', $id)->with('reviews.users')->get();
        return view('frontend.single_product', compact('productItems'))->with('product', $products);
    }
}
