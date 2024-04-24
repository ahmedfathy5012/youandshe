<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Src\Features\Auth\Data\Models\User;
use Src\Features\Barber\Data\Models\Barber;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $barbers = Barber::all();
        $babersCount = count($barbers);


        $users = User::all();
        $usersCount = count($users);

    
    

        for($i=0;$i<100;$i++){
            DB::table('reviews')->insert([
                'comment' => Str::random(100),
                'rate' => fake()->numberBetween(0,5),
                'user_id'=>$users[fake()->numberBetween(0,$usersCount-1)]->id,
                'barber_id'=>$barbers[fake()->numberBetween(0,$babersCount-1)]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    

    }
    }
}
