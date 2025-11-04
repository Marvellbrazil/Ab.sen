<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PresensiService;

class NotifyPresensiTime extends Command
{
    protected $signature = 'presensi:notify-time';
    protected $description = 'Send notifications for upcoming and started presensi';

    public function handle(PresensiService $presensiService)
    {
        $this->info('Checking presensi time notifications...');
        
        // Notifikasi 15 menit sebelum
        $presensiService->notifyUpcomingPresensi();
        
        // Notifikasi waktu mulai
        $presensiService->notifyPresensiStarted();
        
        $this->info('Presensi time notifications completed.');
    }
}