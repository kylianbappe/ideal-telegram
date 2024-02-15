<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class AuthUser extends Controller
{
    function indexOfAuth() {
        return view("LoginDokter");
    }

     //LOGIN HANDLER
     function login(Request $request) {
        Session::flash('email', $request->email);
        $request->validate([
            'email'=> 'required',
            'password'=> 'required',
        ], [
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);

        $infologin = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];

        if (Auth::attempt($infologin)) {
            return redirect('/')->with('success, berhasil login!');
        }else {
            return redirect('login')->withErrors('Email atau password tidak valid');
        }
    }

    //LOGOUT
    public function destroy() {
        Auth::logout();
        return redirect()->route('login');
    }


}
