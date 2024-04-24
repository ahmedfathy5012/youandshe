<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Features\Auth\Data\Models\User;
use Src\Features\Barber\Data\Models\Barber;
use Src\Features\BaseApp\Data\Models\Package;

class BookingServiceSeeder extends Seeder
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
        
        $packages = Package::all();
        $packagesCount = count($packages);

           for($i=0;$i<1000;$i++){
            DB::table('barber_services')->insert([
                "user_id" => $users[fake()->numberBetween(0,$usersCount-1)]->id,
                "barber_id" => $barbers[fake()->numberBetween(0,$babersCount-1)]->id,
                
            ]);
            
        }
    }
}
