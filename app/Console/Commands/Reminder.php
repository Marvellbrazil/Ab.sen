<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kelas;

class Reminder extends Command
{
    /**
     * Nama command untuk dipanggil di terminal.
     *
     * @var string
     */
    protected $signature = 'presensi:remind';

    /**
     * Deskripsi command.
     *
     * @var string
     */
    protected $description = 'Mengirim notifikasi pengingat presensi ke semua anggota kelas.';

    /**
     * Jalankan command.
     */
    public function handle(): void
    {
        $kelasList = Kelas::all();

        foreach ($kelasList as $kelas) {
            notifyKelas($kelas->id_kelas, "Jangan lupa untuk absen pada {$kelas->nama_kelas}!");
        }

        $this->info('Notifikasi pengingat presensi berhasil dikirim.');
    }
}
