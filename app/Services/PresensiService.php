<?php

namespace App\Services;

use App\Models\Presensi;
use App\Models\Kelas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PresensiService
{
    public function autoAlphaForMissedClasses()
    {
        try {
            $today = now()->format('Y-m-d');
            
            Log::info('Running auto alpha for date: ' . $today);
            
            $users = User::where('is_active', true)->get();

            foreach ($users as $user) {
                $kelasUser = $user->kelasDiikuti;
                
                foreach ($kelasUser as $kelas) {
                    $this->checkAndCreateAlpha($user, $kelas, $today);
                }
            }
            
            Log::info('Auto alpha completed successfully');
            
        } catch (\Exception $e) {
            Log::error('Error in autoAlphaForMissedClasses: ' . $e->getMessage());
        }
    }

    private function checkAndCreateAlpha($user, $kelas, $date)
    {
        $existingPresensi = Presensi::where('id_user', $user->id)
            ->where('id_kelas', $kelas->id_kelas)
            ->whereDate('created_at', $date)
            ->first();

        if (!$existingPresensi) {
            $waktuBatas = $kelas->waktu_selesai 
                ? Carbon::parse($kelas->waktu_selesai)->addHours(2)
                : Carbon::parse($date)->endOfDay();

            if (now()->gt($waktuBatas)) {
                Presensi::create([
                    'id_user' => $user->id,
                    'id_kelas' => $kelas->id_kelas,
                    'status' => 'alpha',
                    'keterangan' => 'Auto alpha - tidak melakukan presensi',
                    'gambar' => 'default.jpg',
                    'created_at' => $date,
                    'updated_at' => now()
                ]);
                
                notifyUser(
                    $user->id,
                    "Anda mendapatkan alpha untuk kelas '{$kelas->nama_kelas}' karena tidak melakukan presensi",
                    'warning',
                    $kelas->id_kelas
                );
                
                if ($kelas->user->id_user !== $user->id) {
                    notifyUser(
                        $kelas->user->id_user,
                        "{$user->username} mendapatkan alpha untuk kelas '{$kelas->nama_kelas}'",
                        'presensi',
                        $kelas->id_kelas
                    );
                }
                
                Log::info("Created alpha for user: {$user->id}, kelas: {$kelas->id_kelas}, date: {$date}");
            }
        }
    }

    /**
     * Kirim notifikasi waktu mulai presensi (15 menit sebelum waktu mulai)
     */
    public function notifyUpcomingPresensi()
    {
        try {
            $now = now();
            $fifteenMinutesLater = $now->copy()->addMinutes(15)->format('H:i');
            $currentTime = $now->format('H:i');
            
            Log::info('Checking upcoming presensi notifications. Current: ' . $currentTime . ', 15min later: ' . $fifteenMinutesLater);
            
            // Cari kelas yang waktu mulainya dalam 15 menit ke depan
            $kelasAkanMulai = Kelas::where('waktu_mulai', '>=', $currentTime)
                ->where('waktu_mulai', '<=', $fifteenMinutesLater)
                ->whereHas('anggota') // Hanya kelas yang memiliki anggota
                ->get();

            foreach ($kelasAkanMulai as $kelas) {
                $waktuMulai = Carbon::parse($kelas->waktu_mulai);
                $minutesDiff = $waktuMulai->diffInMinutes($now);
                
                if ($minutesDiff <= 15 && $minutesDiff > 0) {
                    $this->sendPresensiReminder($kelas, $minutesDiff);
                }
            }
            
            Log::info('Upcoming presensi notifications completed');
            
        } catch (\Exception $e) {
            Log::error('Error in notifyUpcomingPresensi: ' . $e->getMessage());
        }
    }

    /**
     * Kirim notifikasi waktu presensi dimulai
     */
    public function notifyPresensiStarted()
    {
        try {
            $currentTime = now()->format('H:i');
            
            Log::info('Checking presensi started notifications for: ' . $currentTime);
            
            // Cari kelas yang waktu mulainya sama dengan waktu sekarang
            $kelasMulaiSekarang = Kelas::where('waktu_mulai', $currentTime)
                ->whereHas('anggota')
                ->get();

            foreach ($kelasMulaiSekarang as $kelas) {
                $this->sendPresensiStartedNotification($kelas);
            }
            
            Log::info('Presensi started notifications completed');
            
        } catch (\Exception $e) {
            Log::error('Error in notifyPresensiStarted: ' . $e->getMessage());
        }
    }

    private function sendPresensiReminder($kelas, $minutesLeft)
    {
        $message = "Presensi kelas '{$kelas->nama_kelas}' akan dimulai dalam {$minutesLeft} menit ({$kelas->waktu_mulai} - {$kelas->waktu_selesai})";
        
        // Kirim ke semua anggota kelas
        notifyKelas(
            $kelas->id_kelas,
            $message,
            'info'
        );
        
        // Kirim ke pengajar juga
        notifyUser(
            $kelas->user->id_user,
            $message,
            'info',
            $kelas->id_kelas
        );
        
        Log::info("Sent presensi reminder for kelas: {$kelas->id_kelas}, {$minutesLeft} minutes left");
    }

    private function sendPresensiStartedNotification($kelas)
    {
        $message = "⏰ Waktu presensi kelas '{$kelas->nama_kelas}' telah dimulai! Silakan lakukan presensi sebelum {$kelas->waktu_selesai}";
        
        // Kirim ke semua anggota kelas
        notifyKelas(
            $kelas->id_kelas,
            $message,
            'warning'
        );
        
        // Kirim ke pengajar juga
        notifyUser(
            $kelas->user->id_user,
            "Waktu presensi kelas '{$kelas->nama_kelas}' telah dimulai",
            'info',
            $kelas->id_kelas
        );
        
        Log::info("Sent presensi started notification for kelas: {$kelas->id_kelas}");
    }

    // Method untuk cek ketika user login
    public function checkPreviousDaysPresensi(User $user)
    {
        try {
            for ($i = 1; $i <= 3; $i++) {
                $dateToCheck = now()->subDays($i)->format('Y-m-d');
                $this->checkUserPresensiForDate($user, $dateToCheck);
            }
        } catch (\Exception $e) {
            Log::error('Error in checkPreviousDaysPresensi: ' . $e->getMessage());
        }
    }

    private function checkUserPresensiForDate(User $user, $date)
    {
        $kelasUser = $user->kelasDiikuti;

        foreach ($kelasUser as $kelas) {
            $existingPresensi = Presensi::where('id_user', $user->id)
                ->where('id_kelas', $kelas->id_kelas)
                ->whereDate('created_at', $date)
                ->first();

            if (!$existingPresensi) {
                Presensi::create([
                    'id_user' => $user->id,
                    'id_kelas' => $kelas->id_kelas,
                    'status' => 'alpha',
                    'keterangan' => 'Auto alpha - tidak melakukan presensi',
                    'gambar' => 'default.jpg',
                    'created_at' => $date,
                    'updated_at' => now()
                ]);

                notifyUser(
                    $user->id,
                    "Anda mendapatkan alpha untuk kelas '{$kelas->nama_kelas}' tanggal " . Carbon::parse($date)->format('d/m/Y'),
                    'warning',
                    $kelas->id_kelas
                );
                
                Log::info("Created alpha for user: {$user->id}, kelas: {$kelas->id_kelas}, date: {$date}");
            }
        }
    }

    /**
     * Cek presensi terlambat dan update status
     */
    public function checkLatePresensi()
    {
        try {
            $today = now()->format('Y-m-d');
            
            $presensiHariIni = Presensi::whereDate('created_at', $today)
                ->where('status', 'hadir')
                ->with(['kelas', 'user'])
                ->get();

            foreach ($presensiHariIni as $presensi) {
                $waktuSelesai = $presensi->kelas->waktu_selesai;
                
                if ($waktuSelesai && $presensi->created_at->gt(Carbon::parse($waktuSelesai))) {
                    $presensi->update(['status' => 'terlambat']);
                    
                    notifyUser(
                        $presensi->id_user,
                        "Presensi Anda untuk kelas '{$presensi->kelas->nama_kelas}' diubah menjadi terlambat",
                        'warning',
                        $presensi->id_kelas
                    );
                    
                    Log::info("Updated presensi to terlambat for user: {$presensi->id_user}, kelas: {$presensi->id_kelas}");
                }
            }
            
        } catch (\Exception $e) {
            Log::error('Error in checkLatePresensi: ' . $e->getMessage());
        }
    }
}