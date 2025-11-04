<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Services\PresensiService;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->withSchedule(function (\Illuminate\Console\Scheduling\Schedule $schedule): void {
        $presensiService = new PresensiService();

        // Auto alpha setiap hari jam 23:59
        $schedule->call(function () use ($presensiService) {
            $presensiService->autoAlphaForMissedClasses();
        })->dailyAt('23:59')->timezone('Asia/Jakarta');

        // Notifikasi 15 menit sebelum waktu mulai (setiap menit)
        $schedule->call(function () use ($presensiService) {
            $presensiService->notifyUpcomingPresensi();
        })->everyMinute();

        // Notifikasi waktu presensi dimulai (setiap menit)
        $schedule->call(function () use ($presensiService) {
            $presensiService->notifyPresensiStarted();
        })->everyMinute();

        // Cek presensi terlambat setiap 5 menit
        $schedule->call(function () use ($presensiService) {
            $presensiService->checkLatePresensi();
        })->everyFiveMinutes();

        // Laporan mingguan setiap Senin jam 08:00
        $schedule->call(function () use ($presensiService) {
            $presensiService->generateWeeklyReport();
        })->weekly()->mondays()->at('08:00')->timezone('Asia/Jakarta');
    })
    ->create();