<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
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
    public function definition()
    {
        return [
            'name' => fake()->name(),
            // 'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' =>fake()->phoneNumber(),
            'api_token' =>bin2hex(openssl_random_pseudo_bytes(30)),
            'phone_verify'=>0,
            'gender'=>fake()->numberBetween(0,1),
            'status'=>fake()->numberBetween(0,3),
            'service_gender'=>fake()->numberBetween(0,1),
            'ready_to_notify'=>fake()->numberBetween(0,1),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
