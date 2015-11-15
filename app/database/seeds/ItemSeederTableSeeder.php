<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class ItemSeederTableSeeder extends Seeder
{

    public function run()
    {

//        DB::table('items')->delete();
        $faker = Faker\Factory::create();


        $cat_array = [
            'Phones - Mobile Phones' => 219,
            'Phone Accessories' => 219,
            'Furniture' => 228,
            'Computers - Laptops|computers' => 240,
            'Decor - Garden - Accessories' => 228,
            'Clothing and Shoes' => 185,
            'Watches - Jewelry - Accessories' => 229,
            'Health and Beauty' => 227,
            'Babies and Kids' => 365,
            'Parking and storage' => 302,
            'Houses - Apartments for Sale' => 367,
            'Houses - Apartments for Rent' => 16,
            'Office and Shops' => 368,
            'Temporary and Vacation Rentals' => 388,
            'Video Games - Consoles' => 209,
            'Cameras and accessories' => 218,
            'Trucks - Commercial - Agricultural' => 416,
            'Cars Accesories' => 377,
            'Electronics - Video' => 366,
            'Cars' => 362,
            'Sporting goods - Bicycles' => 234,
            'Musical Instruments' => 243,
            'Books - CDs - DVDs' => 364,
            'Toys and Games' => 211,
            'Art - Collectibles' => 214,
            'Services' => 191,
            'Offered Jobs' => 190,
            'Classes - Courses' => 186,
            'Dogs - Cats' => 312,
            'Other Vehicles' => 380
        ];

        $proxies = [
            'http://213.85.92.10:80',
            'http://117.136.234.51:80',
            'http://175.156.132.212:80'

        ];

        $categories = Category::whereIn('title', array_keys($cat_array))->get()->toArray();


        $client = new GuzzleHttp\Client();

        foreach (array_chunk($categories, 3) as $category_row) {

            foreach ($category_row as $category) {
                $proxy = $proxies[rand(0, count($proxies) - 1)];
                $this->command->info('Trying category ...'.$category['title'].'with proxy - ' .$proxy);


                $proxy = $proxies[rand(0,count($proxies)-1)];

                $this->command->info("Using proxy: $proxy");

                $this->command->info("Fetching items in category {$category['title']}");


                try {

                    $res = $client->get('http://api-v2.olx.com/items',
                        [
                            'query' =>
                                [
                                    'pageSize' => 50,
                                    'location' => 'www.olx.com',
                                    'seo' => 'true',
                                    'offset' => 0,
                                    'categoryId' => $cat_array[$category['title']],
                                    'abundance' => 'true',
                                    'languageId' => 1,
                                    'platform' => 'desktop'
                                ],
                            'proxy' => $proxy

                        ]


                    );
                    if ($res->getStatusCode() == 200) {
                        $results = $res->json()['data'];
                        $this->command->info('Found '.count($results).' item(s) category ...'.$category['title']);

                        $this->command->info("Retrieved ".count($results)." items in category {$category['title']}");


                        foreach (array_chunk($results, 5) as $result_row) {

                            foreach ($result_row as $result) {
                                $id = $result['id'];

                                $new_res = $client->get("http://api-v2.olx.com/items/$id",
                                    [
                                        'proxy' => $proxy
                                    ]);
                                $this->command->info("Fetching  {$result['title']}");



                                if ($new_res->getStatusCode() == 200) {

                                    $this->command->info('Retrieved ' . $result['title'] );

                                    $data = $new_res->json();

                                    $this->command->info("Found  {$data['title']}");

                                    $item = Item::create([
                                        'title' => $data['title'],
                                        'description' => $data['description'],
                                        'category_id' => $category['id'],
                                        'location_id' => rand(1, 14),
                                        'type' => $faker->randomElement(['personal', 'business']),
                                        'amount' => $data['price']['amount'] ?: $faker->numberBetween(200, 4000),
                                        'negotiable' => $faker->boolean(),
                                        'email' => $faker->freeEmail,
                                        'phone' => $faker->phoneNumber,
                                        'seller_name' => $faker->name,
                                        'user_id' => rand(1, 40),
                                        'premium_until' => $faker->boolean(20) ? $faker->dateTimeBetween("now",
                                            "+2 months") : null,
                                        'status' => rand(1, 4),
                                        'created_at' => $faker->dateTimeBetween("-5 months", "now")

                                    ]);

                                    $this->command->info('Created ' . $result['title'] );


                                    foreach (array_chunk($data['images'], 3) as $image_row) {
                                        $this->command->info("Uploading ".count($data['images'])." images  for  {$result['title']}");


                                        foreach ($image_row as $image) {
                                            try {
                                                Picture::upload($image['url'], $item->id, 'jpg');
                                                $this->command->info("Image uploaded:  {$image['url']}");


                                            } catch (\Exception $e) {
                                                $this->command->info("Image failed  for  {$image['url']}");
                                                $this->command->info($e->getMessage());

                                            }
                                        }

                                    }
                                } else {
                                    $this->command->info("Could not fetch  {$result['title']}");


                                }

                            }


                        }
                    } else {
                        $this->command->info("Could not fetch items in category {$category['title']}");

                    }


                } catch (\Exception $e) {
                    $this->command->info("Failed to fetch items in category {$category['title']}");
                    $this->command->error($e->getMessage());

                }



            }

    }

}

}
