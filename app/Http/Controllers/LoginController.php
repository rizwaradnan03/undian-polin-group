<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // dd(Auth::attempt($credentials));
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/pilih-hadiah-undian')->with('berhasil','Berhasil Login!');
        }
        return back()->with('gagal', 'Email / Password tidak valid!');
    }
}
