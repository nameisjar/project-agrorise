<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Signin;

class SigninController extends Controller
{
    function index1()
    {
        return view('sesi.signin');
    }
    public function login1(Request $request)
    {
        // Session::flash('email', $request->input('email'));
        $credentials = $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        // login untuk user
        if (
            Auth::guard('user')->attempt(['email' => $credentials['login'], 'password' => $credentials['password']]) ||
            Auth::guard('user')->attempt(['username' => $credentials['login'], 'password' => $credentials['password']])
        ) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        // login untuk admin
        if (
            Auth::guard('admin')->attempt(['email' => $credentials['login'], 'password' => $credentials['password']]) ||
            Auth::guard('admin')->attempt(['username' => $credentials['login'], 'password' => $credentials['password']])
        ) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'login failed!');
    }
    public function logout1()
    {
        Auth::guard('user')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }

    //login untuk pakar
    function index2()
    {
        return view('sesi.signin-pakar');
    }
    public function login2(Request $request)
    {
        // Session::flash('email', $request->input('email'));
        $credentials = $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);
        if (
            Auth::guard('pakar')->attempt(['email' => $credentials['login'], 'password' => $credentials['password']]) ||
            Auth::guard('pakar')->attempt(['username' => $credentials['login'], 'password' => $credentials['password']])
        ) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->with('loginError', 'login failed!');
    }
    public function logout2()
    {
        Auth::guard('pakar')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
