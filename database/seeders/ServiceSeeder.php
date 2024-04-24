<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<20;$i++){
            DB::table('services')->insert([
                'name' => fake()->word(),
                'duration' => fake()->numberBetween(5,60),
                'status' => fake()->numberBetween(0,1),
                'price' => fake()->randomFloat(.2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
