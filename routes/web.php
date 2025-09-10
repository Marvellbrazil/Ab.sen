<?php

use App\Http\Middleware\BlockAssetsMiddleware;
use App\Http\Middleware\CheckLogin;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// View Routes

// Routes
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('layouts.landing');
});

Route::get('/dashboard', function() {
    return view('dashboard');
});

// Validation Routes



// Protected Routes;
Route::middleware([BlockAssetsMiddleware::class])->group(function () {
    Route::get('/assets/{any}', function () {
        abort(403, 'Akses ke /assets/ diblokir.');
    })->where('any', '.*');
});

//use tokenization

// /*
// |--------------------------------------------------------------------------
// | Authentication Routes
// |--------------------------------------------------------------------------
// |
// | These routes handle user authentication including login, registration,
// | logout, and password reset functionality.
// |
// */

// // Guest routes (only accessible when not authenticated)
// Route::middleware('guest')->group(function () {
//     // Login routes
//     Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
//     Route::post('/login', [AuthController::class, 'login'])->name('user.login.post');

//     // Registration routes
//     Route::get('/user/register', [AuthController::class, 'showRegister'])->name('register');
//     Route::post('/register', [AuthController::class, 'register'])->name('register.post');

//     // Forgot password routes
//     Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
//     Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

//     // AJAX validation endpoints
//     Route::post('/check-username', [AuthController::class, 'checkUsername'])->name('check.username');
//     Route::post('/check-email', [AuthController::class, 'checkEmail'])->name('check.email');
// });

// // Authenticated routes
// Route::middleware('auth')->group(function () {
//     // Logout route
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//     Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');

//     // Dashboard routes (you'll need to create these controllers)
//     Route::get('/dashboard', function () {
//         if (auth()->user()->role === 'admin') {
//             return redirect()->route('admin.dashboard');
//         }
//         return redirect()->route('user.dashboard');
//     })->name('dashboard');

//     // Admin routes
//     Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
//         Route::get('/dashboard', function () {
//             return view('admin.dashboard');
//         })->name('dashboard');
//         // Add more admin routes here
//     });

//     // User routes
//     Route::middleware('user')->prefix('user')->name('user.')->group(function () {
//         Route::get('/dashboard', function () {
//             return view('user.dashboard');
//         })->name('dashboard');
//         // Add more user routes here
//     });
// });

// // Redirect root to appropriate dashboard or login
// Route::get('/', function () {
//     if (auth()->check()) {
//         return redirect()->route('dashboard');
//     }
//     return redirect()->route('login');
// })->name('home');
