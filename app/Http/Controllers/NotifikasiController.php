<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        // Ambil notifikasi user yang login dengan data kelas
        $notifikasis = Auth::user()->notifikasis()
            ->with('kelas') // Eager load kelas
            ->latest()
            ->get();

        return view('notifikasi.index', compact('notifikasis'));
    }

    public function destroy($id)
    {
        $notifikasi = Notifikasi::where('id_notifikasi', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $notifikasi->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus');
    }

    /**
     * Update status checked/unchecked
     */
    public function updateChecked(Request $request, $id)
    {
        $request->validate([
            'is_checked' => 'required|boolean'
        ]);

        $notifikasi = Notifikasi::where('id_notifikasi', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $notifikasi->update([
            'is_checked' => $request->is_checked
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status notifikasi berhasil diupdate'
        ]);
    }

    /**
     * Mark as read
     */
    public function markAsRead($id)
    {
        $notifikasi = Notifikasi::where('id_notifikasi', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $notifikasi->update(['status' => 'read']);

        return back()->with('success', 'Notifikasi telah ditandai sebagai dibaca');
    }

    /**
     * Mark all as read
     */
    public function markAllAsRead()
    {
        Auth::user()->notifikasis()
            ->where('status', 'unread')
            ->update(['status' => 'read']);

        return back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca');
    }

    /**
     * Method untuk membuat notifikasi dari kelas
     */
    public static function createNotifikasiFromKelas($userId, $kelasId, $pesan, $tipe = 'info')
    {
        return Notifikasi::create([
            'id_user' => $userId,
            'id_kelas' => $kelasId,
            'pesan_notifikasi' => $pesan,
            'tipe_notifikasi' => $tipe,
            'status' => 'unread',
            'is_checked' => false
        ]);
    }

    /**
     * Method untuk membuat notifikasi system (tanpa kelas)
     */
    public static function createSystemNotifikasi($userId, $pesan, $tipe = 'info')
    {
        return Notifikasi::create([
            'id_user' => $userId,
            'id_kelas' => null,
            'pesan_notifikasi' => $pesan,
            'tipe_notifikasi' => $tipe,
            'status' => 'unread',
            'is_checked' => false
        ]);
    }
}