<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RequestMessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $limit = 10;
        for ($i = 0; $i < $limit; $i++) {
            if($i % 2 == 0){
                DB::table('form_request_message')->insert([ //,
                    'request_id' => 1,
                    'user_id' => null,
                    'service_center_id' => 6,
                    'message' => $faker->paragraph,
                    'created_at' => Carbon::now(),
                ]);
            } else {
                DB::table('form_request_message')->insert([ //,
                    'request_id' => 1,
                    'user_id' => 3,
                    'service_center_id' => null,
                    'message' => $faker->paragraph,
                    'created_at' => Carbon::now(),
                ]);
            }

        }
    }
}
