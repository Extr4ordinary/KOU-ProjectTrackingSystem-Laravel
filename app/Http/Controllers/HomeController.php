<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('client.home.home');
    }

    public function userData(){
        // find active user and return data
        $user = User::find(auth()->user()->id);
        return $user;
    }
}
