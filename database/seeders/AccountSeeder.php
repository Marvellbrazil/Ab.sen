<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accounts')->insert([
            'name' => 'Budimir Setyowan',
            'username' => 'budi.set',
            'email' => 'setbudimir22@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'user'
        ]);
    }
}
