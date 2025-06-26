<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->user_role == 'kepalabps'){
                return redirect('/kepalabps/daftarpegawai')->with('success', 'Login berhasil, selamat datang!');
            }elseif(Auth::user()->user_role == 'ketuatim'){
                return redirect('/ketuatim/home')->with('success', 'Login berhasil, selamat datang!');
            }elseif(Auth::user()->user_role == 'anggotatim'){
                return redirect('/anggotatim/beranda')->with('success', 'Login berhasil, selamat datang!');
            }else{
                return redirect('/login')->with('error', 'Role akun tidak dikenali, silakan hubungi administrator');
            }
        } else {
            return redirect('/login')->with('error', 'Email atau Password yang dimasukkan tidak sesuai, silakan coba lagi');
        }
    }
}