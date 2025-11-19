<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Services\PresensiService;

class AuthController extends Controller
{
    protected $presensiService;

    public function __construct(PresensiService $presensiService)
    {
        $this->presensiService = $presensiService;
    }

    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Process Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $this->presensiService->checkPreviousDaysPresensi(Auth::user());
            
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    // Show Register Form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Process Register
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:admin,user',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'profile_picture' => 'default.png',
            'is_active' => true,
        ]);

        Auth::login($user);

        // Kirim notifikasi welcome
        notifyUser(
            $user->id,
            "Selamat datang di sistem presensi! Akun Anda berhasil dibuat.",
            'success'
        );

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}