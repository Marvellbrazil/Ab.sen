<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\table;

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

        DB::table('accounts')->insert([
            'name' => 'Adminans',
            'username' => 'adminans',
            'email' => 'adminans@gmail.com',
            'password' => Hash::make('admin1234'),
            'role' => 'admin'
        ]);

    }
}
