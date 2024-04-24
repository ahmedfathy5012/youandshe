<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Features\Barber\Data\Models\Barber;
use Src\Features\BaseApp\Data\Models\Package;

class BarberPackagesSeeder extends Seeder
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

           for($i=0;$i<$babersCount-1;$i++){
            for($j=0;$j<3;$j++){
                DB::table('barber_services')->insert([
                    'barber_id' => $barbers[$i]->id,
                    'service_id' => $packages[fake()->numberBetween(0,$packagesCount-1)]->id,
                ]);
            }
           
        }
    }
}
