<?php

use Carbon\Carbon;

if (!function_exists('selamat')) {
    function selamat(): string
    {
        $jam = Carbon::now()->hour;

        if ($jam >= 4 && $jam < 10) {
            return 'Selamat pagi, ';
        } elseif ($jam >= 10 && $jam < 15) {
            return 'Selamat siang, ';
        } elseif ($jam >= 15 && $jam < 18) {
            return 'Selamat sore, ';
        } else {
            return 'Selamat malam, ';
        }
    }
}

if (!function_exists('jamber')) {
    function jamber(): string
    {
        return Carbon::now()->hour;
    }
}
