<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Categories;
use App\Slide;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slides = Slide::where('is_approved', 2)->get();
        $cates = Categories::where('is_approved', 2)->get();
        return view('frontend.home', compact('cates', 'slides'));
    }

    public function Signup(){
        return view('frontend.signup');
    }

    // public function Login(){
    //     return view('auth.login');
    // }


    //User Profile
    public function showUserProfile(){
        return view('frontend.userProfile');
    }

    public function updateProfile(Request $request, $id){
        if($request->all()){
            $validateData = $request->validate([
                'user-Email' => 'required|email|max:255',
                'user-firstname' => 'required|max:255',
                'user-lastname' => 'required|max:255',
                'user-phone' => 'required|integer|digits_between:8,20',
            ]);
            if($validateData){
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
            else{
                session()->flash('error', 'Fail to update account!');
                return redirect()->route('userprofile');
            }
        }
    }


}
