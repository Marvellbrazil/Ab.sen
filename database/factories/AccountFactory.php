<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $password = fake()->password(5, 12);
        return [
            'name' => fake()->name(),
            'username' => fake()->unique()->username(),
            'raw_password' => $password,
            'password' => Hash::make($password),
        ];
    }
}
