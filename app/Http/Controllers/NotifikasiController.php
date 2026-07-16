<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class NotifikasiController extends Controller
{
    public function index(): View
    {
        $notifications = Notifikasi::with('kelas')
            ->where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('notifikasi.index', compact('notifications'));
    }

    public function markAsRead($id): JsonResponse
    {
        $notification = Notifikasi::where('id_notifikasi', $id)
                                ->where('id_user', Auth::id())
                                ->firstOrFail();

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function markAllAsRead(): RedirectResponse
    {
        markAllNotificationsAsRead(Auth::id());

        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }

    public function markAsChecked($id): JsonResponse
    {
        $notification = Notifikasi::where('id_notifikasi', $id)
                                ->where('id_user', Auth::id())
                                ->firstOrFail();

        $notification->markAsChecked();

        return response()->json(['success' => true]);
    }

    public function destroy($id): RedirectResponse
    {
        $notification = Notifikasi::where('id_notifikasi', $id)
                                ->where('id_user', Auth::id())
                                ->firstOrFail();

        $notification->delete();

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    public function clearAll(): RedirectResponse
    {
        Notifikasi::where('id_user', Auth::id())->delete();

        return redirect()->route('notifikasi.index')->with('success', 'Semua notifikasi berhasil dihapus.');
    }

    public function getNotifications(): JsonResponse
    {
        $notifications = getUserNotifications(Auth::id(), 5);
        $unreadCount = getUnreadNotificationsCount(Auth::id());

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }
}