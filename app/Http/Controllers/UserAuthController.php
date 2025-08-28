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
    $user = User::where('username', $request->username)->first();

    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        Auth::login($user);
        return redirect('/dashboard')->with('success', 'Manual login successful.');
    } else {
        return back()->with('error', 'Manual check failed.');
    }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
