<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    if (auth()->user()->isAdmin()) {
        $kelas = Kelas::where('id_user', auth()->id())
                    ->with(['user', 'anggota'])
                    ->withCount('anggota')
                    ->latest()
                    ->paginate(10);
    } else {
        // PERBAIKAN: Specify table di whereHas
        $kelas = Kelas::whereHas('anggota', function($query) {
                    $query->where('bergabungs.id_user', auth()->id());
                })
                ->with(['user', 'anggota'])
                ->withCount('anggota')
                ->latest()
                ->paginate(10);
    }

    return view('kelas.index', compact('kelas'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nama_kelas' => 'required|string|max:255',
        'deskripsi_kelas' => 'nullable|string|max:500',
        'gambar_kelas' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'waktu_mulai' => 'required|date_format:H:i',
        'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
    ]);

    if (!auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized action.');
    }

    $gambarKelas = null;
    if ($request->hasFile('gambar_kelas')) {
        $gambarKelas = $request->file('gambar_kelas')->store('kelas', 'public');
    }

    // PASTIKAN SEMUA FIELD TERISI DENGAN VALUE
    $kelas = Kelas::create([
        'nama_kelas' => $request->nama_kelas ?? 'Kelas Baru',
        'deskripsi_kelas' => $request->deskripsi_kelas ?? 'Deskripsi kelas',
        'gambar_kelas' => $gambarKelas,
        'waktu_mulai' => $request->waktu_mulai ?? '08:00',
        'waktu_selesai' => $request->waktu_selesai ?? '10:00',
        'id_user' => auth()->id(),
        'kode_kelas' => Str::upper(Str::random(6)),
    ]);

    // Notifikasi ke admin pembuat kelas
    notifyUser(
        auth()->id(),
        "✅ Kelas '{$kelas->nama_kelas}' berhasil dibuat. Kode kelas: {$kelas->kode_kelas}",
        'success',
        $kelas->id_kelas
    );

    // Notifikasi ke semua admin lainnya tentang kelas baru
    $adminUsers = User::where('role', 'admin')
        ->where('id_user', '!=', auth()->id())
        ->get();

    foreach ($adminUsers as $admin) {
        notifyUser(
            $admin->id_user,
            "📚 Kelas baru '{$kelas->nama_kelas}' dibuat oleh " . auth()->user()->username,
            'info',
            $kelas->id_kelas
        );
    }

    return redirect()->route('kelas.show', $kelas)
        ->with('success', 'Kelas berhasil dibuat.');
}

    /**
     * Display the specified resource.
     */
public function show($id)
{
    // Bypass route model binding, load manual
    $kelas = Kelas::with(['user', 'presensi.user'])
                ->findOrFail($id);

    // Load anggota dengan pagination
    $anggota = $kelas->anggota()->paginate(10); // 10 item per page
    
    // Set relation manually
    $kelas->setRelation('anggota', $anggota);

    return view('kelas.show', compact('kelas'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $kelas = Kelas::findOrFail($id);

        if ($kelas->id_user !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Anda hanya bisa mengedit kelas yang Anda buat.');
        }

        return view('kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi_kelas' => 'nullable|string|max:500',
            'gambar_kelas' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
        ]);

        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        if ($kelas->id_user !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Anda hanya bisa mengupdate kelas yang Anda buat.');
        }

        // Simpan data lama untuk perbandingan
        $oldData = [
            'nama_kelas' => $kelas->nama_kelas,
            'deskripsi_kelas' => $kelas->deskripsi_kelas,
            'waktu_mulai' => $kelas->waktu_mulai,
            'waktu_selesai' => $kelas->waktu_selesai,
        ];

        $data = [
            'nama_kelas' => $request->nama_kelas,
            'deskripsi_kelas' => $request->deskripsi_kelas,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ];

        // Handle upload gambar jika ada
        if ($request->hasFile('gambar_kelas')) {
            if ($kelas->gambar_kelas && Storage::exists($kelas->gambar_kelas)) {
                Storage::delete($kelas->gambar_kelas);
            }
            $data['gambar_kelas'] = $request->file('gambar_kelas')->store('kelas', 'public');
        }

        $kelas->update($data);

        // Kirim notifikasi detail perubahan
        $this->sendEditNotifications($kelas, $oldData, $request->all());

        return redirect()->route('kelas.show', $kelas)
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $kelas = Kelas::findOrFail($id);

        if ($kelas->id_user !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Anda hanya bisa menghapus kelas yang Anda buat.');
        }

        $namaKelas = $kelas->nama_kelas;
        $idKelas = $kelas->id_kelas;

        // Kirim notifikasi sebelum menghapus
        notifyKelas(
            $idKelas,
            "❌ Kelas '{$namaKelas}' telah dihapus oleh pengajar",
            'warning'
        );

        // Notifikasi ke admin lain
        $otherAdmins = User::where('role', 'admin')
            ->where('id_user', '!=', auth()->id())
            ->get();

        foreach ($otherAdmins as $admin) {
            notifyUser(
                $admin->id_user,
                "❌ " . auth()->user()->username . " menghapus kelas '{$namaKelas}'",
                'warning'
            );
        }

        if ($kelas->gambar_kelas && Storage::exists($kelas->gambar_kelas)) {
            Storage::delete($kelas->gambar_kelas);
        }

        $kelas->delete();

        notifyUser(
            auth()->id(),
            "✅ Kelas '{$namaKelas}' berhasil dihapus",
            'info'
        );

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }

    /**
     * Join kelas dengan kode
     */
    public function join(Request $request)
{
    $request->validate([
        'kode_kelas' => 'required|string|max:10'
    ]);

    $kelas = Kelas::where('kode_kelas', $request->kode_kelas)->first();

    if (!$kelas) {
        return response()->json([
            'success' => false,
            'message' => 'Kode kelas tidak valid.'
        ], 404);
    }

    // PERBAIKAN: Specify table untuk menghindari ambiguous column
    $alreadyJoined = $kelas->anggota()
        ->where('bergabungs.id_user', auth()->id()) // Specify table
        ->exists();

    if ($alreadyJoined) {
        return response()->json([
            'success' => false,
            'message' => 'Anda sudah bergabung dengan kelas ini.'
        ], 400);
    }

    // Bergabung dengan kelas
    $kelas->anggota()->attach(auth()->id());

    // Notifikasi ke user
    notifyUser(
        auth()->id(),
        "🎉 Anda berhasil bergabung dengan kelas '{$kelas->nama_kelas}'",
        'success',
        $kelas->id_kelas
    );

    // Notifikasi ke pengajar
    if ($kelas->id_user !== auth()->id()) {
        $pengajar = User::find($kelas->id_user);
        if ($pengajar) {
            notifyUser(
                $pengajar->id_user,
                "👥 " . auth()->user()->username . " bergabung dengan kelas '{$kelas->nama_kelas}'",
                'info',
                $kelas->id_kelas
            );
        }
    }

    return response()->json([
        'success' => true,
        'message' => 'Berhasil bergabung dengan kelas.',
        'kelas' => [
            'id_kelas' => $kelas->id_kelas,
            'nama_kelas' => $kelas->nama_kelas
        ]
    ]);
}

    /**
     * Leave kelas
     */
    public function leave($id)
{
    $kelas = Kelas::findOrFail($id);

    // PERBAIKAN: Specify table
    $isMember = $kelas->anggota()
        ->where('bergabungs.id_user', auth()->id())
        ->exists();

    if (!$isMember) {
        return redirect()->back()->with('error', 'Anda bukan anggota kelas ini.');
    }

    // Cek apakah user adalah pengajar
    if ($kelas->id_user === auth()->id()) {
        return redirect()->back()->with('error', 'Pengajar tidak bisa meninggalkan kelas sendiri.');
    }

    $kelas->anggota()->detach(auth()->id());

    // Notifikasi ke user
    notifyUser(
        auth()->id(),
        "Anda telah keluar dari kelas '{$kelas->nama_kelas}'",
        'info'
    );

    // Notifikasi ke pengajar
    if ($kelas->id_user !== auth()->id()) {
        $pengajar = User::find($kelas->id_user);
        if ($pengajar) {
            notifyUser(
                $pengajar->id_user,
                "👋 " . auth()->user()->username . " keluar dari kelas '{$kelas->nama_kelas}'",
                'info',
                $kelas->id_kelas
            );
        }
    }

    return redirect()->route('kelas.index')->with('success', 'Berhasil keluar dari kelas.');
}

    /**
     * Kelola anggota kelas (admin only)
     */
    // public function manageAnggota(Kelas $kelas)
    // {
    //     if (!auth()->user()->isAdmin() || $kelas->id_user !== auth()->id()) {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     $kelas->load('anggota.presensis');

    //     return view('kelas.manage-anggota', compact('kela'));
    // }

    /**
     * Remove anggota dari kelas (admin only)
     */
    public function removeAnggota(Request $request, $id)
{
    $kelas = Kelas::findOrFail($id);
    
    if (!auth()->user()->isAdmin() || $kelas->id_user !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'user_id' => 'required|exists:users,id_user'
    ]);

    $user = User::findOrFail($request->user_id);

    // Cek apakah user adalah pengajar
    if ($user->id_user === $kelas->id_user) {
        return redirect()->back()->with('error', 'Tidak bisa menghapus pengajar dari kelas.');
    }

    // PERBAIKAN: Specify table
    $isMember = $kelas->anggota()
        ->where('bergabungs.id_user', $user->id_user)
        ->exists();

    if (!$isMember) {
        return redirect()->back()->with('error', 'User bukan anggota kelas ini.');
    }

    $kelas->anggota()->detach($user->id_user);

    // Notifikasi ke user yang dihapus
    notifyUser(
        $user->id_user,
        "❌ Anda telah dikeluarkan dari kelas '{$kelas->nama_kelas}' oleh pengajar",
        'warning'
    );

    // Notifikasi ke pengajar
    notifyUser(
        auth()->id(),
        "✅ {$user->username} telah dikeluarkan dari kelas '{$kelas->nama_kelas}'",
        'info',
        $kelas->id_kelas
    );

    return redirect()->back()->with('success', 'Anggota berhasil dihapus dari kelas.');
}

    /**
     * Get presensi detail for specific date (API)
     */
    public function getPresensiDetail(Kelas $kelas, $date)
    {
        $presensi = \App\Models\Presensi::with('user')
            ->where('id_kelas', $kelas->id_kelas)
            ->whereDate('created_at', $date)
            ->get();
        
        return response()->json([
            'presensi' => $presensi
        ]);
    }

    /**
     * Kirim notifikasi edit kelas ke admin dan user
     */
    private function sendEditNotifications($kelas, $oldData, $newData)
    {
        $changes = $this->getChangesDescription($oldData, $newData);
        
        if (empty($changes)) {
            return; // Tidak ada perubahan yang signifikan
        }

        $changeMessage = "📝 Kelas '{$kelas->nama_kelas}' telah diperbarui:\n" . implode("\n", $changes);

        // 1. Notifikasi ke ADMIN PEMBUAT KELAS
        notifyUser(
            auth()->id(),
            $changeMessage,
            'info',
            $kelas->id_kelas
        );

        // 2. Notifikasi ke ADMIN LAINNYA
        $otherAdmins = User::where('role', 'admin')
            ->where('id_user', '!=', auth()->id())
            ->get();

        foreach ($otherAdmins as $admin) {
            notifyUser(
                $admin->id_user,
                "📝 " . auth()->user()->username . " memperbarui kelas '{$kelas->nama_kelas}'\n" . implode("\n", $changes),
                'info',
                $kelas->id_kelas
            );
        }

        // 3. Notifikasi ke SEMUA ANGGOTA KELAS (USER)
        notifyKelas(
            $kelas->id_kelas,
            $changeMessage,
            'pengumuman'
        );

        \Log::info("Sent edit notifications for kelas: {$kelas->id_kelas}, changes: " . json_encode($changes));
    }

    /**
     * Dapatkan deskripsi perubahan
     */
    private function getChangesDescription($oldData, $newData)
    {
        $changes = [];

        if ($oldData['nama_kelas'] !== $newData['nama_kelas']) {
            $changes[] = "• Nama: '{$oldData['nama_kelas']}' → '{$newData['nama_kelas']}'";
        }

        if ($oldData['deskripsi_kelas'] !== $newData['deskripsi_kelas']) {
            $oldDesc = $oldData['deskripsi_kelas'] ?: '(tidak ada deskripsi)';
            $newDesc = $newData['deskripsi_kelas'] ?: '(tidak ada deskripsi)';
            $changes[] = "• Deskripsi diperbarui";
        }

        if ($oldData['waktu_mulai'] !== $newData['waktu_mulai']) {
            $changes[] = "• Waktu mulai: {$oldData['waktu_mulai']} → {$newData['waktu_mulai']}";
        }

        if ($oldData['waktu_selesai'] !== $newData['waktu_selesai']) {
            $changes[] = "• Waktu selesai: {$oldData['waktu_selesai']} → {$newData['waktu_selesai']}";
        }

        return $changes;
    }

    /**
     * Generate new kode kelas
     */
    public function generateNewKode(Kelas $kelas)
    {
        if (!auth()->user()->isAdmin() || $kelas->id_user !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $oldKode = $kelas->kode_kelas;
        $newKode = Str::upper(Str::random(6));

        $kelas->update(['kode_kelas' => $newKode]);

        // Notifikasi ke pengajar
        notifyUser(
            auth()->id(),
            "🔑 Kode kelas '{$kelas->nama_kelas}' diperbarui: {$oldKode} → {$newKode}",
            'info',
            $kelas->id_kelas
        );

        // Notifikasi ke anggota
        notifyKelas(
            $kelas->id_kelas,
            "🔑 Kode kelas '{$kelas->nama_kelas}' diperbarui: {$newKode}",
            'pengumuman'
        );

        return redirect()->back()->with('success', 'Kode kelas berhasil diperbarui.');
    }

    public function getAnggota(Kelas $kelas, Request $request)
{
    $anggota = $kelas->anggota()->paginate(10);
    
    if ($request->ajax()) {
        return response()->json([
            'html' => view('partials.anggota-table', compact('anggota'))->render(),
            'pagination' => $anggota->links()->toHtml()
        ]);
    }
    
    return view('kelas.show', compact('kelas', 'anggota'));
}
}