<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presensis = Presensi::with(['user', 'kelas'])
            ->where('id_user', Auth::id())
            ->latest()
            ->get();
            
        return view('presensi.index', compact('presensis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Kelas $kelas)
    {
        $existingPresensi = Presensi::where('id_user', Auth::id())
            ->where('id_kelas', $kelas->id_kelas)
            ->whereDate('created_at', today())
            ->first();

        if ($existingPresensi) {
            return redirect()->route('presensi.edit', ['kelas' => $kelas, 'presensi' => $existingPresensi]);
        }

        return view('user.kelas.edit', [
            'kelas' => $kelas,
            'presensi' => new Presensi()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
 * Store a newly created resource in storage.
 */
public function store(Request $request, Kelas $kelas)
    {
        $request->validate([
            'status' => 'required|in:belum hadir,hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $existingPresensi = Presensi::where('id_user', Auth::id())
            ->where('id_kelas', $kelas->id_kelas)
            ->whereDate('created_at', today())
            ->first();

        if ($existingPresensi) {
            return redirect()->route('presensi.edit', ['kelas' => $kelas, 'presensi' => $existingPresensi])
                ->with('error', 'Anda sudah melakukan presensi untuk kelas ini hari ini.');
        }

        $gambarPath = 'default.jpg';
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('presensi', 'public');
        }

        Presensi::create([
            'id_user' => Auth::id(),
            'id_kelas' => $kelas->id_kelas,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'gambar' => $gambarPath
        ]);

        return redirect()->route('kelas.show', $kelas)
            ->with('success', 'Presensi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presensi $presensi)
    {
        if ($presensi->id_user !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.kelas.show', compact('presensi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas, Presensi $presensi)
    {
        if ($presensi->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Pastikan presensi terkait dengan kelas yang benar
        if ($presensi->id_kelas !== $kelas->id_kelas) {
            abort(404, 'Presensi tidak ditemukan untuk kelas ini.');
        }

        return view('user.kelas.edit', compact('presensi', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas, Presensi $presensi)
    {
        if ($presensi->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($presensi->id_kelas !== $kelas->id_kelas) {
            abort(404, 'Presensi tidak ditemukan untuk kelas ini.');
        }

        $request->validate([
            'status' => 'required|in:belum hadir,hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ];

        if ($request->hasFile('gambar')) {
            if ($presensi->gambar !== 'default.jpg') {
                Storage::disk('public')->delete($presensi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('presensi', 'public');
        }

        $presensi->update($data);

        return redirect()->route('kelas.show', $kelas)
            ->with('success', 'Presensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presensi $presensi)
    {
        if ($presensi->id_user !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        if ($presensi->gambar !== 'default.jpg') {
            Storage::disk('public')->delete($presensi->gambar);
        }

        $presensi->delete();

        return redirect()->route('presensi.index')
            ->with('success', 'Presensi berhasil dihapus.');
    }

    /**
     * Method untuk menampilkan form presensi berdasarkan kelas
     */
    public function createByKelas(Kelas $kelas)
    {
        return $this->create($kelas);
    }
}