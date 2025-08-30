<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Miglahovic',
            'username' => 'm.hovic',
            'password' => Hash::make('user1234'),
        ]);
    }
}
    // --- IGNORE ---
    // --- IGNORE ---
    // use WithoutModelEvents; --- IGNORE ---
    // public function setPasswordAttribute($value) --- IGNORE ---
    // { --- IGNORE ---
    //     $this->attributes['password'] = Hash::make($value); --- IGNORE ---
    // } --- IGNORE ---
// --- IGNORE ---
// --- IGNORE ---
// ---
