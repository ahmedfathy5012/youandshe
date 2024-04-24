<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++){
            DB::table('packages')->insert([
                'name' => fake()->title(), 
                'price'=> fake()->randomFloat(),   
                'created_at'=> now(),
                'updated_at'=>now(),
            ]);
        }
    }
}
