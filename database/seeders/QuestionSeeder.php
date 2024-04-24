<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++){
            
                DB::table('questions')->insert([
                    'question' => fake()->date(),
                    'answer' => Str::random(100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        
   
        }
    }
}
