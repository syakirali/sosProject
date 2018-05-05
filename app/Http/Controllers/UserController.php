<?php

namespace sosProject\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function performLogout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
