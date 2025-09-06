<?php

use App\Http\Middleware\CheckLogin;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Authentication Routes


// USER routes
Route::get('/user/login', [UserAuthController::class, 'showLogin'])->name('user.login');
Route::post('/user/login', [UserAuthController::class, 'login'])->name('user.login.post');
Route::get('/user/register', [UserAuthController::class, 'showRegister'])->name('user.register');
Route::post('/user/register', [UserAuthController::class, 'register'])->name('user.register.post');
Route::post('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');


// ADMIN routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::get('/admin/register', [AdminAuthController::class, 'showRegister'])->name('admin.register');
Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// Routes
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('layouts.landing');
});

Route::get('/dashboard', function () {
    return view('layouts.home');
});

// Validation Routes



// Protected Routes
Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.home');
    })->name('dashboard');
});
