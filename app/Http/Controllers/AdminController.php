<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;


class AdminController extends Controller
{
    public function showadminloginform()
    {
        return view('dashboard.adminlogin');
    }
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
            'is_admin' => 1,
        ];

        if ($request->isMethod('post')) {
            if (Auth::attempt($credentials)) {
                Session::put('adminSession', $credentials['email']);
                return redirect('/admin/dashboard');
            } else {
                return redirect('/admin/login');
            }
        }

        return view('dashboard.adminlogin');
    }

    public function dashboard()
    {
        if (Session::has('adminSession')) { } else {
            return redirect('/');
        }
        return view('dashboard.admin');
    }

    public function logout()
    {
        Session::flush;
        return redirect('/')->with('flash_message_success', 'logged out successfully');
    }


}
