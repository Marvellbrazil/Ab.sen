<?php

use App\Models\Bergabung;
use App\Models\Notifikasi;

if (!function_exists('notifyKelas'))
{
    function notifyKelas($idKelas, $pesan)
    {
        $anggota = Bergabung::where('id_kelas', $idKelas)
            ->whereHas('user', function ($query) {
                $query->where('role', '!=', 'admin');
            })
            ->get();

            foreach ($anggota as $a) {
                Notifikasi::create([
                    'id_user' => $a->id_user,
                    'id_kelas' => $idKelas,
                    'pesan' => $pesan,
                    'dibaca' => false,
                ]);
            }
    }
}
