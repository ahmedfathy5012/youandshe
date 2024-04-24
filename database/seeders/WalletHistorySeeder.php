<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Features\Barber\Data\Models\Barber;
use Src\Features\Booking\Data\Models\Booking;

class WalletHistorySeeder extends Seeder
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

        $bookings = Booking::all();
        $bookingsCount = count($bookings);




        for($i=0;$i<100;$i++){
            DB::table('wallet_histories')->insert([
                'barber_id'=>$barbers[fake()->numberBetween(0,$babersCount-1)]->id,
                'booking_id'=>$bookings[fake()->numberBetween(0,$bookingsCount-1)]->id,
                'transaction_type' => fake()->numberBetween(0,count(config('walletstatus.walletStatus')??[])-1),
                'percentage'=> fake()->numberBetween(0,.3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    

    }
    }
}
