<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ReportsTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        $reports = [];

        foreach (range(1, 300) as $index) {

            $reports[] = [
                'message' => $faker->sentence,
                'item_id' => rand(1, 200),
                'created_at' => $faker->dateTimeBetween("-5 months", "now")
            ];
        }

        Report::insert($reports);

    }

}