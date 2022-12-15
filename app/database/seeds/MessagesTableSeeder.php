<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class MessagesTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        $messages = [];

        foreach (range(1, 300) as $index) {

            $messages[] = [
                'name' => $faker->name,
                'email' => $faker->freeEmail,
                'content' => $faker->sentence,
                'item_id' => rand(1, 200),
                'created_at' => $faker->dateTimeBetween("-5 months", "now")
            ];
        }

        Message::insert($messages);
    }

}