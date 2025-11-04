<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    /**
     * Tampilkan halaman buat presensi baru.
     */
    public function create(Kelas $kelas)
    {
        // Cek apakah sudah presensi hari ini
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

        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek apakah sudah presensi hari ini
        $existingPresensi = Presensi::where('id_user', auth()->id())
                                    ->where('id_kelas', $kelas->id_kelas)
                                    ->whereDate('created_at', today())
                                    ->first();

        if ($existingPresensi) {
            return redirect()->route('kelas.show', $kelas->id_kelas)
                            ->with('error', 'Anda sudah melakukan presensi hari ini.');
        }

        // Handle upload gambar
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('presensi', 'public');
        }

        // Simpan presensi
        Presensi::create([
            'id_user' => auth()->id(),
            'id_kelas' => $kelas->id_kelas,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'gambar' => $gambarPath,
            'tanggal' => now(),
        ]);

        return redirect()->route('kelas.show', $kelas->id_kelas)
                        ->with('success', 'Presensi berhasil disimpan!');
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