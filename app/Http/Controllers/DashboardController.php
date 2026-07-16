<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            $kelas = Kelas::where('id_user', $user->id_user)
                        ->latest()
                        ->limit(4)
                        ->get();
        } else {
            $kelas = Kelas::whereHas('anggota', function($query) use ($user) {
                        $query->where('bergabungs.id_user', $user->id_user);
                    })
                    ->latest()
                    ->limit(4)
                    ->get();
        }

        $presensi = Presensi::with(['kelas', 'user'])
                    ->where('id_user', $user->id_user)
                    ->latest()
                    ->limit(5)
                    ->get();

        $kelasIds = $kelas->pluck('id_kelas')->toArray();
        
        $presensiData = Presensi::where('id_user', auth()->id())
                            ->whereIn('id_kelas', $kelasIds)
                            ->whereDate('created_at', today())
                            ->get()
                            ->keyBy('id_kelas');

        return view('dashboard', compact('kelas', 'presensi', 'presensiData'));
    }
}