<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request){
        //Log::info($request->post());
        if (Auth::attempt(['eposta'=>$request->email,'password'=>$request->password])) {
            return redirect('takip/');
        }
        return redirect('/')->withErrors('Email veya şifre hatalı !');
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
