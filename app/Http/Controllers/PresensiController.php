<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    /**
     * Tampilkan halaman buat presensi baru.
     */
    public function create(Kelas $kelas)
    {
        $existingPresensi = Presensi::where('id_user', auth()->id())
                                    ->where('id_kelas', $kelas->id_kelas)
                                    ->whereDate('created_at', today())
                                    ->first();

        if ($existingPresensi) {
            return redirect()->route('kelas.show', $kelas->id_kelas)
                            ->with('error', 'Anda sudah melakukan presensi hari ini.');
        }

        return view('presensi.create', compact('kelas'));
    }

    /**
     * Simpan data presensi ke database.
     */
    public function store(Request $request, $id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $status = $request->status;

        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $existingPresensi = Presensi::where('id_user', auth()->id())
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
            'id_user' => auth()->id(),
            'id_kelas' => $kelas->id_kelas,
            'status' => $status,
            'keterangan' => $request->keterangan,
            'gambar' => $gambarPath,
            'tanggal' => now(),
        ]);

        return redirect()->route('kelas.show', $kelas->id_kelas)
                        ->with('success', 'Presensi berhasil disimpan!');
    }

    public function show($id_kelas, $id_presensi)
    {
        $kelas = Kelas::findOrFail($id_kelas);

        $presensi = Presensi::with(['user', 'kelas.user'])
                            ->where('id_presensi', $id_presensi)
                            ->where('id_kelas', $id_kelas) // Pastikan presensi ini dari kelas yang dimaksud
                            ->firstOrFail();

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
                                    ->where('id_kelas', $id_kelas)
                                    ->latest()
                                    ->get();

        return view('presensi.show', compact('presensi', 'riwayatPresensi', 'kelas'));
    }

    /**
     * Tampilkan halaman edit presensi.
     */
    public function edit($id_presensi)
    {
        // Authorization: hanya user yang membuat presensi yang bisa edit
        $presensi = Presensi::findOrFail($id_presensi);
        if (!Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Cek apakah presensi masih bisa diedit (misal: maksimal 1 jam setelah dibuat)
        $createdTime = $presensi->created_at;
        $currentTime = now();
        $diffInHours = $createdTime->diffInHours($currentTime);

        if ($diffInHours > 24) {
            return redirect()->route('kelas.show', $presensi->id_kelas)
                            ->with('error', 'Presensi sudah tidak dapat diubah (lebih dari 24 jam).');
        }

        $kelas = $presensi->kelas;

        return view('presensi.edit', compact('presensi', 'kelas'));
    }

    /**
     * Update data presensi.
     */
    public function update(Request $request, Presensi $presensi)
    {
        if ($presensi->id_user !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPath = $presensi->gambar;

        if ($request->has('hapus_gambar') && $request->hapus_gambar == '1') {
            if ($gambarPath && Storage::exists($gambarPath)) {
                Storage::delete($gambarPath);
            }
            $gambarPath = null;
        } elseif ($request->hasFile('gambar')) {
            if ($gambarPath && Storage::exists($gambarPath)) {
                Storage::delete($gambarPath);
            }
            $gambarPath = $request->file('gambar')->store('presensi', 'public');
        }

        $presensi->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('kelas.show', $presensi->id_kelas)
                        ->with('success', 'Presensi berhasil diperbarui!');
    }

    /**
     * Menampilkan daftar presensi untuk kelas tertentu.
     */
    public function index(Kelas $kelas)
    {
        $presensi = Presensi::where('id_kelas', $kelas->id_kelas)
            ->with('user')
            ->latest()
            ->get();

        return view('presensi.index', compact('kelas', 'presensi'));
    }
}