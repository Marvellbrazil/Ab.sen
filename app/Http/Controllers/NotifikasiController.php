<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notifikasi::with('kelas')
            ->where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('notifikasi.index', compact('notifications'));
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($id)
    {
        $notification = Notifikasi::where('id_notifikasi', $id)
                                ->where('id_user', Auth::id())
                                ->firstOrFail();

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        markAllNotificationsAsRead(Auth::id());

        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }

    /**
     * Mark notification as checked
     */
    public function markAsChecked($id)
    {
        $notification = Notifikasi::where('id_notifikasi', $id)
                                ->where('id_user', Auth::id())
                                ->firstOrFail();

        $notification->markAsChecked();

        return response()->json(['success' => true]);
    }

    /**
     * Delete notification
     */
    public function destroy($id)
    {
        $notification = Notifikasi::where('id_notifikasi', $id)
                                ->where('id_user', Auth::id())
                                ->firstOrFail();

        $notification->delete();

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    /**
     * Clear all notifications
     */
    public function clearAll()
    {
        Notifikasi::where('id_user', Auth::id())->delete();

        return redirect()->route('notifikasi.index')->with('success', 'Semua notifikasi berhasil dihapus.');
    }

    /**
     * Get notifications for AJAX (for navbar)
     */
    public function getNotifications()
    {
        $notifications = getUserNotifications(Auth::id(), 5);
        $unreadCount = getUnreadNotificationsCount(Auth::id());

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }
}