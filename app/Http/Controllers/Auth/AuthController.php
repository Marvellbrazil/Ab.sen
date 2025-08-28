<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class AuthController extends Controller
{
    use HasFactory, Notifiable;
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $creds = $request->only('username', 'password');
        if (Auth::guard('admins')->attempt($creds)) {
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors([
                'message' => 'Invalid credentials',
            ]);
        }
    }

    public function logout() {
        Auth::guard('admins')->logout();
        return redirect('/login');
    }
}
