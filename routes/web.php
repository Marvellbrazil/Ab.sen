<?php

use App\Http\Middleware\CheckLogin;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;

const dbor = '/dashboard';

// Authentication Routes


// USER routes
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login.post');

// ADMIN routes
Route::get('/admin', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin', [AdminAuthController::class, 'login'])->name('admin.login.post');


// Routes
Route::get('/', function () {
    if (Auth::check()) {
        return redirect(dbor);
    }
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('home');
});

// Validation Routes



// Protected Routes
Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    });
});

// If you have an admin login form, you can handle it like this:
// If (Auth::guard('admin')->attempt($credentials)) {
//     return redirect()->intended('/dashboard');
// }
// If (Auth::guard('admin')->attempt([
//     'email' => $request->email,
//     'password' => $request->password,
// ])) {
//     // ✅ Password matches the bcrypt hash in DB
//     return redirect()->intended('/admin/dashboard');
// } else {
//     // ❌ Password does not match
//     return back()->withErrors(['email' => 'Invalid admin credentials']);
// }
