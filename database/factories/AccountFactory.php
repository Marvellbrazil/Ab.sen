<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $num = rand(2, 4);
        $name = '';

        if ($num == 2) {
            $name = fake()->firstName() . ' ' . fake()->lastName();
       } elseif ($num == 3) {
            $name = fake()->firstName() . ' ' . fake()->lastName() . ' ' . fake()->lastName();
       } else {
            $name = fake()->firstName() . ' ' . fake()->firstName() . ' ' . fake()->lastName() . ' ' . fake()->lastName();
       }

       $password = fake()->password(6, 12);
        return [
            'name' => $name,
            'username' => fake()->username(),
            'email' => fake()->email(),
            'raw_password' => $password,
            'password' => Hash::make($password),
        ];
    }
}
