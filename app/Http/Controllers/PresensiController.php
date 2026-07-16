<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PresensiController extends Controller
{
    public function create(Kelas $kelas): View|RedirectResponse
    {
        $existingPresensi = Presensi::where('id_user', Auth::id())
                                    ->where('id_kelas', $kelas->id_kelas)
                                    ->whereDate('created_at', today())
                                    ->first();

        if ($existingPresensi) {
            return redirect()->route('kelas.show', $kelas->id_kelas)
                            ->with('error', 'Anda sudah melakukan presensi hari ini.');
        }

        return view('presensi.create', compact('kelas'));
    }

    public function store(Request $request, Kelas $kelas): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $status = $request->status;

        $existingPresensi = Presensi::where('id_user', Auth::id())
                                    ->where('id_kelas', $kelas->id_kelas)
                                    ->whereDate('created_at', today())
                                    ->first();

        if ($existingPresensi) {
            return redirect()->route('kelas.show', $kelas->id_kelas)
                            ->with('error', 'Anda sudah melakukan presensi hari ini.');
        }

        if (Carbon::now()->greaterThan($kelas->waktu_selesai) && $status == 'hadir') {
            $status = 'terlambat';
        }

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('presensi', 'public');
        }

        Presensi::create([
            'id_user' => Auth::id(),
            'id_kelas' => $kelas->id_kelas,
            'status' => $status,
            'keterangan' => $request->keterangan,
            'gambar' => $gambarPath,
            'tanggal' => now(),
        ]);

        return redirect()->route('kelas.show', $kelas->id_kelas)
                        ->with('success', 'Presensi berhasil disimpan!');
    }

    public function show(Kelas $kelas, Presensi $presensi): View
    {
        if (Auth::user()->isUser()) {
            if ($presensi->id_user !== Auth::id()) {
                abort(403, 'Anda hanya bisa melihat presensi sendiri.');
            }
        } elseif (Auth::user()->isAdmin()) {
            if ($kelas->id_user !== Auth::id()) {
                abort(403, 'Anda hanya bisa melihat presensi di kelas yang Anda ajar.');
            }
        }

        $riwayatPresensi = Presensi::where('id_user', $presensi->id_user)
                                    ->where('id_kelas', $kelas->id_kelas)
                                    ->latest()
                                    ->get();

        return view('presensi.show', compact('presensi', 'riwayatPresensi', 'kelas'));
    }

    public function edit(Kelas $kelas, Presensi $presensi): View|RedirectResponse
    {
        if ($presensi->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $createdTime = $presensi->created_at;
        $currentTime = now();
        $diffInHours = $createdTime->diffInHours($currentTime);

        if ($diffInHours > 24) {
            return redirect()->route('kelas.show', $kelas->id_kelas)
                            ->with('error', 'Presensi sudah tidak dapat diubah (lebih dari 24 jam).');
        }

        return view('presensi.edit', compact('presensi', 'kelas'));
    }

    public function update(Request $request, Kelas $kelas, Presensi $presensi): RedirectResponse
    {
        if ($presensi->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPath = $presensi->gambar;

        if ($request->has('hapus_gambar') && $request->hapus_gambar == '1') {
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = null;
        } elseif ($request->hasFile('gambar')) {
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = $request->file('gambar')->store('presensi', 'public');
        }

        $presensi->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('kelas.show', $kelas->id_kelas)
                        ->with('success', 'Presensi berhasil diperbarui!');
    }

    public function index(Kelas $kelas): View
    {
        $presensi = Presensi::where('id_kelas', $kelas->id_kelas)
            ->with('user')
            ->latest()
            ->get();

        return view('presensi.index', compact('kelas', 'presensi'));
    }
}