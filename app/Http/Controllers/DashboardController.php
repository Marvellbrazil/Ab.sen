<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            // Untuk admin: tampilkan kelas yang dibuat oleh admin
            $kelas = Kelas::where('id_user', $user->id_user)
                        ->latest()
                        ->limit(4)
                        ->get();
        } else {
            // Untuk user: tampilkan kelas yang diikuti
            $kelas = Kelas::whereHas('anggota', function($query) use ($user) {
                        $query->where('bergabungs.id_user', $user->id_user); // Specify table
                    })
                    ->latest()
                    ->limit(4)
                    ->get();
        }

        // Query presensi terbaru
        $presensi = Presensi::with(['kelas', 'user'])
                    ->where('id_user', $user->id_user)
                    ->latest()
                    ->limit(5)
                    ->get();

        return view('dashboard', compact('kelas', 'presensi'));
    }
}