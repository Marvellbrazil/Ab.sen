<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $creds = $request->only('username', 'password');

        if (Auth::guard('web')->attempt($creds)) {
            return redirect('/dashboard')->with('success', 'Login successful!');
        } else {
            return back()->with('error', 'Invalid username or password.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
