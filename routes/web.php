<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKelasController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes untuk semua user yang login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Kelas routes untuk user biasa - hanya bisa melihat, tidak bisa edit/update kelas
    Route::resource('kelas', KelasController::class)->only(['index', 'show', 'store', 'destroy']);
    
    // Presensi routes - user bisa edit presensi mereka
    Route::resource('presensi', PresensiController::class)->except(['create', 'store', 'edit', 'update']);
    Route::get('kelas/{kelas}/presensi/create', [PresensiController::class, 'createByKelas'])->name('presensi.create-by-kelas');
    Route::post('kelas/{kelas}/presensi', [PresensiController::class, 'store'])->name('presensi.store');
    Route::get('kelas/{kelas}/presensi/{presensi}/edit', [PresensiController::class, 'edit'])->name('presensi.edit');
    Route::put('kelas/{kelas}/presensi/{presensi}', [PresensiController::class, 'update'])->name('presensi.update');
    
    // Notifikasi routes
    Route::resource('notifikasi', NotifikasiController::class)->only(['index', 'destroy']);
    Route::post('notifikasi/{notifikasi}/mark-as-read', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.mark-as-read');
    Route::post('notifikasi/{notifikasi}/update-checked', [NotifikasiController::class, 'updateChecked'])->name('notifikasi.update-checked');
    Route::post('notifikasi/mark-all-read', [NotifikasiController::class, 'markAllAsRead'])->name('notifikasi.mark-all-read');

    Route::resource('profil', ProfilController::class);
    Route::view('/profiledit', 'user.profil.edit')->name('profil.edit');
});

// Admin Only Routes
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/kelas', AdminKelasController::class);
});

// Redirect root to dashboard or login
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login.form');
});