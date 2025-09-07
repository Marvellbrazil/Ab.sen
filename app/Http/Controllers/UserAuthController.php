<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.user.login');
    }

    public function showRegister()
    {
        return view('auth.user.register');
    }

    public function login(Request $request)
    {
        $creds = $request->only('username', 'password');

        if (Auth::attempt($creds)) {
            $user = Auth::user();
            $user->last_login = now();
            $user->save();
            return redirect('/dashboard')->with('success', 'Welcome back, ' . Auth::user()->name . '!');
        } else {
            return back()->with('error', 'Invalid Username or Password.');
        }
    }

    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to login page with success message
        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
