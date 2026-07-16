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

// ==========================
// AUTH ROUTES
// ==========================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================
// DASHBOARD & AUTH PROTECTED ROUTES
// ==========================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ==========================
    // KELAS ROUTES
    // ==========================
    Route::resource('kelas', KelasController::class);
    Route::get('/kelas/{kelas}/anggota', [KelasController::class, 'getAnggota'])->name('kelas.anggota');

    // User join kelas
    Route::post('/kelas/join', [KelasController::class, 'join'])->name('kelas.join');

    // ==========================
    // PRESENSI ROUTES
    // ==========================
    Route::prefix('kelas/{kelas}')->group(function () {
        Route::get('/presensi/create', [PresensiController::class, 'create'])->name('presensi.create');
        Route::post('/presensi', [PresensiController::class, 'store'])->name('presensi.store');
        Route::get('/presensi/{presensi}', [PresensiController::class, 'show'])->name('presensi.show');
        Route::get('/presensi/{presensi}/edit', [PresensiController::class, 'edit'])->name('presensi.edit');
        Route::put('/presensi/{presensi}', [PresensiController::class, 'update'])->name('presensi.update');
    });

    // ==========================
    // NOTIFIKASI ROUTES
    // ==========================
    Route::prefix('notifikasi')->group(function () {
        Route::get('/', [NotifikasiController::class, 'index'])->name('notifikasi.index');
        Route::post('/mark-as-read/{id}', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.markAsRead');
        Route::post('/mark-all-read', [NotifikasiController::class, 'markAllAsRead'])->name('notifikasi.markAllAsRead');
        Route::post('/mark-as-checked/{id}', [NotifikasiController::class, 'markAsChecked'])->name('notifikasi.markAsChecked');
        Route::delete('/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
        Route::post('/clear-all', [NotifikasiController::class, 'clearAll'])->name('notifikasi.clearAll');
        Route::get('/get-notifications', [NotifikasiController::class, 'getNotifications'])->name('notifikasi.getNotifications');
    });

    // ==========================
    // PROFIL ROUTES
    // ==========================
    Route::resource('profil', ProfilController::class);
    Route::view('/profiledit', 'profil.edit')->name('profil.edit');
});

// ==========================
// ROOT REDIRECT
// ==========================
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login.form');
});