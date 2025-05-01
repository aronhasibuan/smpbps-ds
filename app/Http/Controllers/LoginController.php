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
            if(Auth::user()->role == 'ketuatim'){
                return redirect('/monitoringkegiatan')->with('success', 'Login berhasil, selamat datang!');
            }elseif(Auth::user()->role == 'anggotatim'){
                return redirect('/home')->with('success', 'Login berhasil, selamat datang!');
            }elseif(Auth::user()->role == 'kepalakantor'){
                return redirect('/monitoringkegiatan')->with('success', 'Login berhasil, selamat datang!');
            }elseif(Auth::user()->role == 'administrator'){
                return redirect('/administrator')->with('success', 'Login berhasil, selamat datang!');
            }else{
                return redirect('/login')->with('error', 'Role akun tidak dikenali, silakan hubungi administrator');
            }
        } else {
            return redirect('/login')->with('error', 'Email atau Password yang dimasukkan tidak sesuai, silakan coba lagi');
        }
    }
}