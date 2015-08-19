<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ReportsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 300) as $index)
		{
			Report::create([
                'message' => $faker->sentence,
                'item_id' => rand(1,200)
			]);
		}
	}

}