<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<100;$i++){
            DB::table('users')->insert([
                'name' => fake()->name(),
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('password'),
                'phone' =>strval(fake()->unique()->phoneNumber()),
                'api_token' =>bin2hex(openssl_random_pseudo_bytes(30)),
                'phone_verify'=>0,
                'gender'=>fake()->numberBetween(0,1),
                'status'=>fake()->numberBetween(0,3),
                'service_gender'=>fake()->numberBetween(0,1),
                'ready_to_notify'=>fake()->numberBetween(0,1),
            ]);
        }
    }
}
