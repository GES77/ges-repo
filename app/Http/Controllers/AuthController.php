<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // dd(Hash::make(123456));
        if(!empty(Auth::check()))
        {
            return redirect('panel/user');
        }
        return view('auth.login');
    }

    public function auth_login(Request $request)
    {
        // dd($request->all());
        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password], $remember))
        {
            return redirect('panel/user');
        }
        else
        {
            return redirect()->back()->with('error', 'Please enter correct username and password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
