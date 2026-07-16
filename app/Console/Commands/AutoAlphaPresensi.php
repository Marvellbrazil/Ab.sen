<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PresensiService;

class AutoAlphaPresensi extends Command
{
    protected $signature = 'presensi:auto-alpha';
    protected $description = 'Automatically create alpha for missed presensi';

    public function handle(PresensiService $presensiService): void
    {
        $this->info('Starting auto alpha presensi...');
        $presensiService->autoAlphaForMissedClasses();
        $this->info('Auto alpha presensi completed successfully.');
    }
}