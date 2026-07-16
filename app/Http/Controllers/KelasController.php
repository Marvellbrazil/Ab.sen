<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Events\ClassCreated;
use App\Events\ClassUpdated;
use App\Events\ClassDeleted;
use App\Events\UserJoinedClass;
use App\Events\UserLeftClass;
use App\Events\UserRemovedFromClass;
use App\Events\ClassCodeRegenerated;
use App\Http\Responses\KelasAnggotaResponse;

class KelasController extends Controller
{
    public function index(): View
    {
        $search = request('search');

        if (Auth::user()->isAdmin()) {
            $kelas = Kelas::where('id_user', Auth::id())
                        ->with(['user', 'anggota'])
                        ->withCount('anggota')
                        ->when($search, function($query, $search) {
                            return $query->where('nama_kelas', 'like', '%' . $search . '%');
                        })
                        ->latest()
                        ->paginate(10);
        } else {
            $kelas = Kelas::whereHas('anggota', function($query) {
                        $query->where('bergabungs.id_user', Auth::id());
                    })
                    ->with(['user', 'anggota'])
                    ->withCount('anggota')
                    ->when($search, function($query, $search) {
                        return $query->where(function($q) use ($search) {
                            $q->where('nama_kelas', 'like', '%' . $search . '%')
                              ->orWhereHas('user', function($q2) use ($search) {
                                  $q2->where('username', 'like', '%' . $search . '%');
                              });
                        });
                    })
                    ->latest()
                    ->paginate(10);
        }

        $kelasIds = $kelas->pluck('id_kelas')->toArray();

        $presensiData = Presensi::where('id_user', Auth::id())
                            ->whereIn('id_kelas', $kelasIds)
                            ->whereDate('created_at', today())
                            ->get()
                            ->keyBy('id_kelas');

        return view('kelas.index', compact('kelas', 'presensiData'));
    }

    public function create(): View
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return view('kelas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi_kelas' => 'nullable|string|max:500',
            'gambar_kelas' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $gambarKelas = null;
        if ($request->hasFile('gambar_kelas')) {
            $gambarKelas = $request->file('gambar_kelas')->store('kelas', 'public');
        }

        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'deskripsi_kelas' => $request->deskripsi_kelas,
            'gambar_kelas' => $gambarKelas,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'id_user' => Auth::id(),
            'kode_kelas' => Str::upper(Str::random(6)),
        ]);

        event(new ClassCreated($kelas, Auth::user()));

        return redirect()->route('kelas.show', $kelas)
            ->with('success', 'Kelas berhasil dibuat.');
    }

    public function show(int $id): View
    {
        $kelas = Kelas::with(['user', 'presensi.user'])->findOrFail($id);

        $anggota = $kelas->anggota()->paginate(10);
        $kelas->setRelation('anggota', $anggota);

        $isExists = $anggota->contains('id_user', Auth::user()->id_user);

        if (!$isExists && Auth::user()->isUser()) {
            abort(403, 'Tidak Diberikan Akses.');
        }

        return view('kelas.show', compact('kelas'));
    }

    public function edit(int $id): View
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $kelas = Kelas::findOrFail($id);

        if ($kelas->id_user !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Anda hanya bisa mengedit kelas yang Anda buat.');
        }

        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi_kelas' => 'nullable|string|max:500',
            'gambar_kelas' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
        ]);

        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        if ($kelas->id_user !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Anda hanya bisa mengupdate kelas yang Anda buat.');
        }

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

        if ($request->hasFile('gambar_kelas')) {
            if ($kelas->gambar_kelas && Storage::disk('public')->exists($kelas->gambar_kelas)) {
                Storage::disk('public')->delete($kelas->gambar_kelas);
            }
            $data['gambar_kelas'] = $request->file('gambar_kelas')->store('kelas', 'public');
        }

        $kelas->update($data);

        event(new ClassUpdated($kelas, $oldData, $request->all(), Auth::user()));

        return redirect()->route('kelas.show', $kelas)
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $kelas = Kelas::findOrFail($id);

        if ($kelas->id_user !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Anda hanya bisa menghapus kelas yang Anda buat.');
        }

        $namaKelas = $kelas->nama_kelas;
        $idKelas = $kelas->id_kelas;
        $memberUserIds = $kelas->anggota->pluck('id_user')->toArray();

        event(new ClassDeleted($idKelas, $namaKelas, Auth::user(), $memberUserIds));

        if ($kelas->gambar_kelas && Storage::disk('public')->exists($kelas->gambar_kelas)) {
            Storage::disk('public')->delete($kelas->gambar_kelas);
        }

        $kelas->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }

    public function join(Request $request): JsonResponse
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

        $alreadyJoined = $kelas->anggota()
            ->where('bergabungs.id_user', Auth::id())
            ->exists();

        if ($alreadyJoined) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah bergabung dengan kelas ini.'
            ], 400);
        }

        $kelas->anggota()->attach(Auth::id());

        event(new UserJoinedClass($kelas, Auth::user()));

        return response()->json([
            'success' => true,
            'message' => 'Berhasil bergabung dengan kelas.',
            'kelas' => [
                'id_kelas' => $kelas->id_kelas,
                'nama_kelas' => $kelas->nama_kelas
            ]
        ]);
    }

    public function leave(int $id): RedirectResponse
    {
        $kelas = Kelas::findOrFail($id);

        $isMember = $kelas->anggota()
            ->where('bergabungs.id_user', Auth::id())
            ->exists();

        if (!$isMember) {
            return redirect()->back()->with('error', 'Anda bukan anggota kelas ini.');
        }

        if ($kelas->id_user === Auth::id()) {
            return redirect()->back()->with('error', 'Pengajar tidak bisa meninggalkan kelas sendiri.');
        }

        $kelas->anggota()->detach(Auth::id());

        event(new UserLeftClass($kelas, Auth::user()));

        return redirect()->route('kelas.index')->with('success', 'Berhasil keluar dari kelas.');
    }

    public function removeAnggota(Request $request, int $id): RedirectResponse
    {
        $kelas = Kelas::findOrFail($id);

        if (!Auth::user()->isAdmin() || $kelas->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id_user'
        ]);

        $user = User::findOrFail($request->user_id);

        if ($user->id_user === $kelas->id_user) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus pengajar dari kelas.');
        }

        $isMember = $kelas->anggota()
            ->where('bergabungs.id_user', $user->id_user)
            ->exists();

        if (!$isMember) {
            return redirect()->back()->with('error', 'User bukan anggota kelas ini.');
        }

        $kelas->anggota()->detach($user->id_user);

        event(new UserRemovedFromClass($kelas, $user, Auth::user()));

        return redirect()->back()->with('success', 'Anggota berhasil dihapus dari kelas.');
    }

    public function getPresensiDetail(Kelas $kelas, string $date): JsonResponse
    {
        $presensi = Presensi::with('user')
            ->where('id_kelas', $kelas->id_kelas)
            ->whereDate('created_at', $date)
            ->get();

        return response()->json([
            'presensi' => $presensi
        ]);
    }

    public function generateNewKode(Kelas $kelas): RedirectResponse
    {
        if (!Auth::user()->isAdmin() || $kelas->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $oldKode = $kelas->kode_kelas;
        $newKode = Str::upper(Str::random(6));

        $kelas->update(['kode_kelas' => $newKode]);

        event(new ClassCodeRegenerated($kelas, $oldKode, $newKode, Auth::user()));

        return redirect()->back()->with('success', 'Kode kelas berhasil diperbarui.');
    }

    public function getAnggota(Kelas $kelas, Request $request): KelasAnggotaResponse
    {
        $anggota = $kelas->anggota()->paginate(10);
        return new KelasAnggotaResponse($kelas, $anggota);
    }
}
