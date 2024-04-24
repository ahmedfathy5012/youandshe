<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<1;$i++){
            DB::table('app_info')->insert([
                'face' =>"https://www.facebook.com",
                'twitter' =>"https://twitter.com",
                'YouTube'=>"https://youtube.com",
                'insta'=>"https://insta.com",
                'email'=>"crazyideaco@gmail.com",
                'phone'=>"01212648022",
                'app_status'=>0,
            ]);
        }
    }
}
