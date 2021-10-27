<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        foreach (range(1, 10) as $i) {
            DB::table('websites')->insert([
                'name' => $faker->word . '.com',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
        }
    }
}
