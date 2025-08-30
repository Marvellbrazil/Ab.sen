<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
    $creds = $request->only('username', 'password');

    if (Auth::attempt($creds)) {
        return redirect('/dashboard')->with('success', 'Welcome back, ' . Auth::user()->name . '!');
    } else {
        return back()->with('error', 'Invalid Username or Password.');
    }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
