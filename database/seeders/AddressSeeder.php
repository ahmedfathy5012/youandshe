<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Features\Auth\Data\Models\User;
use Src\Features\BaseApp\Data\Models\AddressType;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $userCount = count($users);

        $addressTypes = AddressType::all();
        $addressTypeCount = count($addressTypes);


        for($i=0;$i<300;$i++){
            DB::table('adresses')->insert([
                'address' => fake()->address(),
                'lat' => fake()->latitude(),
                'lon' => fake()->longitude(),
                'name' => fake()->streetAddress(),
                'status' => 1,
                'address_type_id'=>$addressTypes[fake()->numberBetween(0,$addressTypeCount-1)]->id,
                'user_id'=>$users[fake()->numberBetween(0,$userCount-1)]->id,
            ]);
        }
    }
}
