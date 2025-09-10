<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        // Redirect to dashboard if already authenticated
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username is required',
            'password.required' => 'Password is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $credentials = $request->only('username', 'password');

        // Try to authenticate using username
        if (Auth::attempt($credentials)) {
            // Update last login timestamp
            $user = Auth::user();
            $user->last_login = Carbon::now();
            $user->save();

            $request->session()->regenerate();

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back, ' . $user->name . '!');
            } else {
                return redirect()->route('user.dashboard')
                    ->with('success', 'Welcome back, ' . $user->name . '!');
            }
        }

        // If authentication fails, try with email
        $user = Account::where('email', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            // Update last login timestamp
            $user->last_login = Carbon::now();
            $user->save();

            $request->session()->regenerate();

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back, ' . $user->name . '!');
            } else {
                return redirect()->route('user.dashboard')
                    ->with('success', 'Welcome back, ' . $user->name . '!');
            }
        }

        return redirect()->back()
            ->with('error', 'Invalid username/email or password')
            ->withInput($request->except('password'));
    }

    /**
     * Show the registration form
     */
    public function showRegister()
    {
        // Redirect to dashboard if already authenticated
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:75|min:2',
            'username' => 'required|string|max:30|min:3|unique:accounts,username|regex:/^[a-zA-Z0-9_]+$/',
            'email' => 'required|email|max:100|unique:accounts,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Name is required',
            'name.max' => 'Name cannot exceed 75 characters',
            'name.min' => 'Name must be at least 2 characters',
            'username.required' => 'Username is required',
            'username.max' => 'Username cannot exceed 30 characters',
            'username.min' => 'Username must be at least 3 characters',
            'username.unique' => 'Username is already taken',
            'username.regex' => 'Username can only contain letters, numbers, and underscores',
            'email.required' => 'Email is required',
            'email.email' => 'Please provide a valid email address',
            'email.unique' => 'Email is already registered',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except(['password', 'password_confirmation']));
        }

        try {
            // Generate unique profile identifier
            $profile = $this->generateUniqueProfile();

            // Create new account
            $account = Account::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'raw_password' => $request->password, // Store raw password if needed for admin purposes
                'password' => Hash::make($request->password),
                'role' => 'user', // Default role
                'profile' => $profile,
            ]);

            // Automatically login the user
            Auth::login($account);

            // Update last login timestamp
            $account->last_login = Carbon::now();
            $account->save();

            return redirect()->route('user.dashboard')
                ->with('success', 'Registration successful! Welcome, ' . $account->name . '!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Registration failed. Please try again.')
                ->withInput($request->except(['password', 'password_confirmation']));
        }
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword()
    {
        // return view('auth.forgot-password');
    }

    /**
     * Handle forgot password request
     */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:accounts,email',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Please provide a valid email address',
            'email.exists' => 'No account found with this email address',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Here you would typically send a password reset email
        // For now, we'll just return a success message
        return redirect()->back()
            ->with('success', 'If an account with that email exists, we have sent you a password reset link.');
    }

    /**
     * Generate unique profile identifier
     */
    private function generateUniqueProfile()
    {
        do {
            $profile = 'USR-' . strtoupper(Str::random(8)) . '-' . time();
        } while (Account::where('profile', $profile)->exists());

        return $profile;
    }

    /**
     * Check if username is available (AJAX endpoint)
     */
    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $exists = Account::where('username', $username)->exists();

        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Username is already taken' : 'Username is available'
        ]);
    }

    /**
     * Check if email is available (AJAX endpoint)
     */
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $exists = Account::where('email', $email)->exists();

        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Email is already registered' : 'Email is available'
        ]);
    }
}
