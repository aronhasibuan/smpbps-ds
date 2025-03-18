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
                return redirect('/monitoringkegiatan');
            }elseif(Auth::user()->role == 'anggotatim'){
                return redirect('/home');
            }elseif(Auth::user()->role == 'kepalakantor'){
                return redirect('/monitoringkegiatan');
            }
        }
 
        return back()->withErrors('Email dan Password yang dimasukkan tidak sesuai')->withInput();
    }
}
