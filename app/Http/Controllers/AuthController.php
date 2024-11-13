<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $createlogin = $request->validate(([
            'email' => 'required',
            'password' => 'required',
        ]));
        if (Auth::attempt($createlogin)){
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'Admin'){
                return redirect()->route('admin.index');
            } elseif ($user->role === 'Kasir'){
                return redirect()->route('kasir.index');
            } elseif ($user->role === 'Owner'){
                return redirect()->route('owner.index');
            }
        }
        return back()->withErrors([
            'email' => 'Email atau Password salah'
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}