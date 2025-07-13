<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->user_role == 'kepalabps'){
                return redirect('/beranda-kepala-bps')->with('success', 'Login berhasil, selamat datang!');
            }elseif(Auth::user()->user_role == 'ketuatim'){
                return redirect()->route('team-leader-home-page')->with('success', 'Login berhasil, selamat datang!');
            }else{
                return redirect()->route('team-member-home-page')->with('success', 'Login berhasil, selamat datang!');
            }
        } else {
            return redirect('/login')->with('error', 'Email atau Password yang dimasukkan tidak sesuai, silakan coba lagi');
        }
    }
}