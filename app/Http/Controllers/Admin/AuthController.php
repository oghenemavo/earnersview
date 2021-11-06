<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        $page_title = 'Admin Login';
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credientials = $request->only('email', 'password');
        if (auth()->guard('admin')->attempt($credientials)) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request) 
    {
        auth()->guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
