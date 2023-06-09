<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{



    // ubah password buat user
    public function index1()
    {
        return view('user/password-edit-user');
    }
    public function update1(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:5|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', // mengandung setidaknya 1 huruf besar, 1 huruf kecil, dan 1 angka',
        ], ['password.regex' => ' Mengandung setidaknya 1 huruf besar, 1 huruf kecil, dan 1 angka']);

        if (Hash::check($request->current_password, Auth::guard('user')->user()->password)) {

            Auth::guard('user')->user()->update(['password' => Hash::make($request->password)]);

            return back()->with('message', 'kata sandi anda telah diperbarui');
        }
        throw ValidationException::withMessages([
            'current_password' => 'kata sandi Anda saat ini tidak cocok dengan catatan kami',
        ]);
    }



    // ubah password buat admin
    public function index2()
    {
        return view('admin.password-edit-admin');
    }
    public function update2(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:5|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', // mengandung setidaknya 1 huruf besar, 1 huruf kecil, dan 1 angka',
        ], [
            'password.regex' => ' Mengandung setidaknya 1 huruf besar, 1 huruf kecil, dan 1 angka'
        ]);

        if (Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {

            Auth::guard('admin')->user()->update(['password' => Hash::make($request->password)]);

            return back()->with('message', 'kata sandi anda telah diperbarui');
        }
        throw ValidationException::withMessages([
            'current_password' => 'kata sandi Anda saat ini tidak cocok dengan catatan kami',
        ]);
    }




    // ubah password buat pakar
    public function index3()
    {
        return view('pakar.password-edit-pakar');
    }
    public function update3(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:5|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', // mengandung setidaknya 1 huruf besar, 1 huruf kecil, dan 1 angka',
        ], ['password.regex' => ' Mengandung setidaknya 1 huruf besar, 1 huruf kecil, dan 1 angka']);

        if (Hash::check($request->current_password, Auth::guard('pakar')->user()->password)) {

            Auth::guard('pakar')->user()->update(['password' => Hash::make($request->password)]);

            return back()->with('message', 'kata sandi anda telah diperbarui');
        }
        throw ValidationException::withMessages([
            'current_password' => 'kata sandi Anda saat ini tidak cocok dengan catatan kami',
        ]);
    }
}
