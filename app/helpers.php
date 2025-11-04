<?php

use App\Models\Notifikasi;
use App\Models\Bergabung;

if (!function_exists('notifyKelas')) {
    function notifyKelas($idKelas, $pesan, $tipeNotifikasi = 'info', $excludeAdmin = true)
    {
        try {
            $query = Bergabung::where('id_kelas', $idKelas);

            if ($excludeAdmin) {
                $query->whereHas('user', function ($query) {
                    $query->where('role', '!=', 'admin');
                });
            }

            $anggota = $query->get();

            $notifications = [];
            foreach ($anggota as $a) {
                $notifications[] = [
                    'id_user' => $a->id_user,
                    'id_kelas' => $idKelas,
                    'pesan_notifikasi' => $pesan,
                    'tipe_notifikasi' => $tipeNotifikasi,
                    'status' => 'unread',
                    'is_checked' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($notifications)) {
                Notifikasi::insert($notifications);
            }

            return count($notifications);
            
        } catch (\Exception $e) {
            \Log::error('Error in notifyKelas: ' . $e->getMessage());
            return 0;
        }
    }
}

if (!function_exists('notifyUser')) {
    function notifyUser($userId, $pesan, $tipeNotifikasi = 'info', $kelasId = null)
    {
        try {
            Notifikasi::create([
                'id_user' => $userId,
                'id_kelas' => $kelasId,
                'pesan_notifikasi' => $pesan,
                'tipe_notifikasi' => $tipeNotifikasi,
                'status' => 'unread',
                'is_checked' => false,
            ]);

            return true;
            
        } catch (\Exception $e) {
            \Log::error('Error in notifyUser: ' . $e->getMessage());
            return false;
        }
    }
}


if (!function_exists('getUnreadNotificationsCount')) {
    function getUnreadNotificationsCount($userId)
    {
        return Notifikasi::where('id_user', $userId)
                        ->where('status', 'unread')
                        ->count();
    }
}

if (!function_exists('getUserNotifications')) {
    function getUserNotifications($userId, $limit = 10)
    {
        return Notifikasi::with('kelas')
                        ->where('id_user', $userId)
                        ->orderBy('created_at', 'desc')
                        ->limit($limit)
                        ->get();
    }
}

if (!function_exists('markNotificationsAsRead')) {
    function markNotificationsAsRead($userId, $notificationIds = [])
    {
        $query = Notifikasi::where('id_user', $userId)
                          ->where('status', 'unread');

        if (!empty($notificationIds)) {
            $query->whereIn('id_notifikasi', $notificationIds);
        }

        return $query->update(['status' => 'read']);
    }
}

if (!function_exists('markAllNotificationsAsRead')) {
    function markAllNotificationsAsRead($userId)
    {
        return Notifikasi::where('id_user', $userId)
                        ->where('status', 'unread')
                        ->update(['status' => 'read']);
    }
}

if (!function_exists('deleteNotification')) {
    function deleteNotification($notificationId, $userId)
    {
        return Notifikasi::where('id_notifikasi', $notificationId)
                        ->where('id_user', $userId)
                        ->delete();
    }
}

if (!function_exists('clearAllNotifications')) {
    function clearAllNotifications($userId)
    {
        return Notifikasi::where('id_user', $userId)->delete();
    }
}