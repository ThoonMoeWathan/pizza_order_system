<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // direct login page
    Public function loginPage(){
        return view('login');
    }

    // direct register page
    Public function registerPage(){
        return view('register');
    }

    // direct dashboard
    Public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()-> route('category#list');
        }
        return redirect()-> route('user#home');
    }
}
