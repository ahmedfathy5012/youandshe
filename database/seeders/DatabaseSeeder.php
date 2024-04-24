<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Src\Features\Auth\Data\Models\User;
use Src\Features\Barber\Data\Models\Review;
use Src\Features\Barber\Models\BarberService;
use Src\Features\BaseApp\Data\Models\PackageService;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            StateSeeder::class,
            CitySeeder::class,
            ServiceSeeder::class,
            PackageSeeder::class,
            UserSeeder::class,
            PackageServiceSeeder::class,
            AddressTypeSeeder::class,
            AddressSeeder::class,
            AppInfoSeeder::class,
            BarberSeeder::class,
            BarberServicesSeeder::class,
            BarberPackagesSeeder::class,
            BlogSeeder::class,
            BookingSeeder::class,
            PrivacySeeder::class,
            UsageSeeder::class,
            QuestionSeeder::class,
            ReviewSeeder::class,
            WalletHistorySeeder::class,
        ]);

    //    User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
