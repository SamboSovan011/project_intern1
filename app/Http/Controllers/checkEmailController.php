<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class checkEmailController extends Controller
{
    public function checkEmailAvailable(Request $request){
        if($request->get('email')){
            $email = $request->get('email');
            $data = DB::table('users')
                    ->where('email', $email)
                    ->count();
            if($data > 0){
                echo "not unique";


            }
            else{
                echo "unique";

            }
        }

    }
}
