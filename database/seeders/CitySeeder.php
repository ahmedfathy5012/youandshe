<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Features\Location\Data\Models\State;

class CitySeeder extends Seeder
{


    

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $states = State::all();
        $stateCount = count($states);
        for($i=0;$i<300;$i++){
            DB::table('cities')->insert([
                'title' => fake()->city(),
                // 'state_id'=>fake()->numberBetween(1,100),
                'state_id'=>$states[fake()->numberBetween(0,$stateCount-1)]->id,
            ]);
        }
    }
}
