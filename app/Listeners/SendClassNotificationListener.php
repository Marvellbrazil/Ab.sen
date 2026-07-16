<?php

namespace App\Listeners;

use App\Events\ClassCreated;
use App\Events\ClassUpdated;
use App\Events\ClassDeleted;
use App\Events\UserJoinedClass;
use App\Events\UserLeftClass;
use App\Events\UserRemovedFromClass;
use App\Events\ClassCodeRegenerated;
use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendClassNotificationListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event instanceof ClassCreated) {
            $this->handleClassCreated($event);
        } elseif ($event instanceof ClassUpdated) {
            $this->handleClassUpdated($event);
        } elseif ($event instanceof ClassDeleted) {
            $this->handleClassDeleted($event);
        } elseif ($event instanceof UserJoinedClass) {
            $this->handleUserJoined($event);
        } elseif ($event instanceof UserLeftClass) {
            $this->handleUserLeft($event);
        } elseif ($event instanceof UserRemovedFromClass) {
            $this->handleUserRemoved($event);
        } elseif ($event instanceof ClassCodeRegenerated) {
            $this->handleClassCodeRegenerated($event);
        }
    }

    private function handleClassCreated(ClassCreated $event): void
    {
        // 1. Notify creator (success alert)
        notifyUser(
            $event->creator->id_user,
            "✅ Kelas '{$event->kelas->nama_kelas}' berhasil dibuat. Kode kelas: {$event->kelas->kode_kelas}",
            'success',
            $event->kelas->id_kelas
        );

        // 2. Notify other admins (info alert)
        $adminUsers = User::where('role', 'admin')
            ->where('id_user', '!=', $event->creator->id_user)
            ->get();

        foreach ($adminUsers as $admin) {
            notifyUser(
                $admin->id_user,
                "📚 Kelas baru '{$event->kelas->nama_kelas}' dibuat oleh {$event->creator->username}",
                'info',
                $event->kelas->id_kelas
            );
        }
    }

    private function handleClassUpdated(ClassUpdated $event): void
    {
        $changes = $this->getChangesDescription($event->oldData, $event->newData);

        if (empty($changes)) {
            return;
        }

        $changeMessage = "📝 Kelas '{$event->kelas->nama_kelas}' telah diperbarui:\n" . implode("\n", $changes);

        // 1. Notify updater (info alert)
        notifyUser(
            $event->updater->id_user,
            $changeMessage,
            'info',
            $event->kelas->id_kelas
        );

        // 2. Notify other admins (info alert)
        $otherAdmins = User::where('role', 'admin')
            ->where('id_user', '!=', $event->updater->id_user)
            ->get();

        foreach ($otherAdmins as $admin) {
            notifyUser(
                $admin->id_user,
                "📝 {$event->updater->username} memperbarui kelas '{$event->kelas->nama_kelas}'\n" . implode("\n", $changes),
                'info',
                $event->kelas->id_kelas
            );
        }

        // 3. Notify all class members (pengumuman type)
        notifyKelas(
            $event->kelas->id_kelas,
            $changeMessage,
            'pengumuman'
        );
    }

    private function handleClassDeleted(ClassDeleted $event): void
    {
        // 1. Write notifications for all members (warning type)
        $notifications = [];
        foreach ($event->memberUserIds as $userId) {
            $user = User::find($userId);
            if ($user && $user->role !== 'admin') {
                $notifications[] = [
                    'id_user' => $userId,
                    'id_kelas' => $event->idKelas,
                    'pesan_notifikasi' => "❌ Kelas '{$event->namaKelas}' telah dihapus oleh pengajar",
                    'tipe_notifikasi' => 'warning',
                    'status' => 'unread',
                    'is_checked' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!empty($notifications)) {
            Notifikasi::insert($notifications);
        }

        // 2. Notify other admins (warning type)
        $otherAdmins = User::where('role', 'admin')
            ->where('id_user', '!=', $event->deleter->id_user)
            ->get();

        foreach ($otherAdmins as $admin) {
            notifyUser(
                $admin->id_user,
                "❌ {$event->deleter->username} menghapus kelas '{$event->namaKelas}'",
                'warning'
            );
        }

        // 3. Notify deleter (info alert)
        notifyUser(
            $event->deleter->id_user,
            "✅ Kelas '{$event->namaKelas}' berhasil dihapus",
            'info'
        );
    }

    private function handleUserJoined(UserJoinedClass $event): void
    {
        // 1. Notify the joined student (success alert)
        notifyUser(
            $event->user->id_user,
            "🎉 Anda berhasil bergabung dengan kelas '{$event->kelas->nama_kelas}'",
            'success',
            $event->kelas->id_kelas
        );

        // 2. Notify class teacher/creator (info alert)
        if ($event->kelas->id_user !== $event->user->id_user) {
            $pengajar = User::find($event->kelas->id_user);
            if ($pengajar) {
                notifyUser(
                    $pengajar->id_user,
                    "👥 {$event->user->username} bergabung dengan kelas '{$event->kelas->nama_kelas}'",
                    'info',
                    $event->kelas->id_kelas
                );
            }
        }
    }

    private function handleUserLeft(UserLeftClass $event): void
    {
        // 1. Notify student who left (info alert)
        notifyUser(
            $event->user->id_user,
            "Anda telah keluar dari kelas '{$event->kelas->nama_kelas}'",
            'info'
        );

        // 2. Notify class teacher (info alert)
        if ($event->kelas->id_user !== $event->user->id_user) {
            $pengajar = User::find($event->kelas->id_user);
            if ($pengajar) {
                notifyUser(
                    $pengajar->id_user,
                    "👋 {$event->user->username} keluar dari kelas '{$event->kelas->nama_kelas}'",
                    'info',
                    $event->kelas->id_kelas
                );
            }
        }
    }

    private function handleUserRemoved(UserRemovedFromClass $event): void
    {
        // 1. Notify removed student (warning alert)
        notifyUser(
            $event->user->id_user,
            "❌ Anda telah dikeluarkan dari kelas '{$event->kelas->nama_kelas}' oleh pengajar",
            'warning'
        );

        // 2. Notify remover teacher/admin (info alert)
        notifyUser(
            $event->remover->id_user,
            "✅ {$event->user->username} telah dikeluarkan dari kelas '{$event->kelas->nama_kelas}'",
            'info',
            $event->kelas->id_kelas
        );
    }

    private function handleClassCodeRegenerated(ClassCodeRegenerated $event): void
    {
        // 1. Notify updater teacher (info alert)
        notifyUser(
            $event->updater->id_user,
            "🔑 Kode kelas '{$event->kelas->nama_kelas}' diperbarui: {$event->oldKode} → {$event->newKode}",
            'info',
            $event->kelas->id_kelas
        );

        // 2. Notify all class members (pengumuman type)
        notifyKelas(
            $event->kelas->id_kelas,
            "🔑 Kode kelas '{$event->kelas->nama_kelas}' diperbarui: {$event->newKode}",
            'pengumuman'
        );
    }

    /**
     * Dapatkan deskripsi perubahan
     */
    private function getChangesDescription(array $oldData, array $newData): array
    {
        $changes = [];

        if (isset($oldData['nama_kelas'], $newData['nama_kelas']) && $oldData['nama_kelas'] !== $newData['nama_kelas']) {
            $changes[] = "• Nama: '{$oldData['nama_kelas']}' → '{$newData['nama_kelas']}'";
        }

        if (isset($oldData['deskripsi_kelas'], $newData['deskripsi_kelas']) && $oldData['deskripsi_kelas'] !== $newData['deskripsi_kelas']) {
            $changes[] = "• Deskripsi diperbarui";
        }

        if (isset($oldData['waktu_mulai'], $newData['waktu_mulai']) && $oldData['waktu_mulai'] !== $newData['waktu_mulai']) {
            $changes[] = "• Waktu mulai: {$oldData['waktu_mulai']} → {$newData['waktu_mulai']}";
        }

        if (isset($oldData['waktu_selesai'], $newData['waktu_selesai']) && $oldData['waktu_selesai'] !== $newData['waktu_selesai']) {
            $changes[] = "• Waktu selesai: {$oldData['waktu_selesai']} → {$newData['waktu_selesai']}";
        }

        return $changes;
    }
}
