<?php

use App\Http\Middleware\BlockAssetsMiddleware;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// =====================
// Public (Guest) Routes
// =====================
Route::middleware('guest')->group(function () {
    // Authentication
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // Forgot password
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

    // AJAX validation
    Route::post('/check-username', [AuthController::class, 'checkUsername'])->name('check.username');
    Route::post('/check-email', [AuthController::class, 'checkEmail'])->name('check.email');
});

// =====================
// Authenticated Routes
// =====================
Route::middleware('auth')->group(function () {
    // Logout
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard redirect based on role
    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    })->name('dashboard');

    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
        // Add more admin routes here
    });

    // User routes
    Route::middleware('user')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', fn() => view('user.dashboard'))->name('dashboard');
        // Add more user routes here
    });
});

// =====================
// Middleware: Block Assets
// =====================
Route::middleware(BlockAssetsMiddleware::class)->group(function () {
    Route::get('/assets/{any}', function () {
        abort(403, 'Akses ke /assets/ diblokir.');
    })->where('any', '.*');
});

// =====================
// Root Redirect
// =====================
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : view('layouts.landing');
})->name('home');
