<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Features\Auth\Data\Models\User;
use Src\Features\Barber\Data\Models\Barber;
use Src\Features\BaseApp\Data\Models\Address;
use Src\Features\BaseApp\Data\Models\Package;

class BookingSeeder extends Seeder
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

        $packages = Package::all();
        $packagesCount = count($packages);

           for($i=0;$i<1000;$i++){

            $users = User::all();
            $usersCount = count($users);
            $user = $users[fake()->numberBetween(0,$usersCount-1)];

            $addresse = null; 
            $addresses = Address::where('user_id',$user->id)->get();
            if($addresses){
                if(count($addresses)>0){
                    $addresse = $addresses[fake()->numberBetween(0,count($addresses)-1)];
                }
            }
            

            DB::table('bookings')->insert([
                "user_id" => $user->id,
                "barber_id" => $barbers[fake()->numberBetween(0,$babersCount-1)]->id,
                "date" => fake()->date(),
                "time" =>fake()->time(),
                "price" => fake()->randomFloat(),
                "discount" => fake()->randomFloat(),
                "total" => fake()->randomFloat(),
                "address_id" => $addresse?$addresse->id:null,
            ]);
            
        } 
    }
}
