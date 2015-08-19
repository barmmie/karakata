<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ItemSeederTableSeeder extends Seeder {

	public function run()
	{

        DB::table('items')->delete();
		$faker = Faker::create();

        $categories = Category::all();

        foreach($categories as $category) {
            foreach(range(1, rand(5,15)) as $index)
            {
                $title = $faker->sentence;
                DB::table('items')->insert(['title' => $title ,
                    'description' => $faker->paragraphs(3, true),
                    'category_id' => $category->id,
                    'location_id' => rand(1,50),
                    'type' => $faker->randomElement(['personal','business']),
                    'amount' => $faker->numberBetween(1200,4000),
                    'negotiable' => $faker->boolean(),
                    'email' => $faker->freeEmail,
                    'phone' => $faker->phoneNumber,
                    'seller_name' => $faker->name,
                    'user_id' => rand(1,10),
                    'slug' => \Str::slug($title, '-'),
                    'status' => rand(1,4),
                    'created_at' => $faker->date('Y-m-d h:i:s')
                    ]);
            }
        }


	}

}