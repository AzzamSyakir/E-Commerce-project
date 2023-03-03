<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class SessionController extends Controller
{
    public function IndexLogin(){
        return view('login');
    }
    public function loginSession(Request $request){
    $request->validate([
        'email' => 'required|email:dns',
        'password' => 'required|string'
        ]);
        $credentials = request(['email', 'password']);
    if (Auth::attempt($credentials)) {
        $request->session()->put('email', $request->email);
        $request->session()->regenerate();
        return view('home');
    } else {
        return redirect()->back()->with(['message' => 'Username atau password salah']);
    }
}    
}
