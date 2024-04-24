<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Src\Features\Location\Data\Models\City;
use Src\Features\Location\Data\Models\State;

class BarberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        


        for($i=0;$i<50;$i++){
          
            $states = State::all();
            $stateCount = count($states);
            $stateId = $states[fake()->numberBetween(0,$stateCount-1)]->id;

            $city = City::where('state_id',$stateId)->get();
            
           if($city){
            $citiesCount = count($city);
            if($citiesCount>0){
                $cityId = $city[fake()->numberBetween(0,$citiesCount-1)]->id;
            }else{
                $cityId = null;
            }
           }else{
               $cityId = null;
           }


            DB::table('barbers')->insert([
                'name' => fake()->name(),
                'info' => Str::random(100),
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
                'ready_to_work'=>fake()->numberBetween(0,1),
                'state_id'=>$stateId,
                'city_id'=>$cityId??null,
                
            ]);
        }
    }
}
