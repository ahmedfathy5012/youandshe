<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Features\BaseApp\Data\Models\Package;
use Src\Features\BaseApp\Data\Models\Service;

class PackageServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $services = Service::all();
        $packages = Package::all();

        for($i=0;$i<10;$i++){
            DB::table('package_services')->insert([
                'package_id' => $packages[fake()->numberBetween(0,count($packages)-1)]->id,
                'service_id'=> $services[fake()->numberBetween(0,count($services)-1)]->id,
                'created_at'=> now(),
                'updated_at'=>now(),
            ]);
        }
    }
}
