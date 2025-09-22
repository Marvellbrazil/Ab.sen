<?php

namespace Database\Seeders;

use App\Models\Account;
use DateTime;
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
            'raw_password' => '1234',
            'password' => Hash::make('1234'),
            'role' => 'user',
            'created_at' => DateTime::now(),
        ]);

        DB::table('accounts')->insert([
            'name' => 'Adminans',
            'username' => 'adminans',
            'email' => 'adminans@support.it',
            'raw_password' => 'admin1234',
            'password' => Hash::make('admin1234'),
            'role' => 'admin'
        ]);

    }
}
