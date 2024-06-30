<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$eYVpyu.4rgLUwVnVL6Zzd.yruKMBMOYr6ib3QO9viFifTImRiMYWm',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */

}
