<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class ItemSeederTableSeeder extends Seeder
{

    public function run()
    {

        DB::table('items')->delete();
        $faker = Faker\Factory::create();

        $categories = Category::all();

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

        $client = new GuzzleHttp\Client();

        foreach ($categories as $category) {

            if (array_key_exists($category->title, $cat_array)) {

                try {
                    $res = $client->get('http://api-v2.olx.com/items',
                        ['query' =>
                            ['pageSize' => 50,
                                'location' => 'www.olx.com',
                                'seo' => 'true',
                                'offset' => 0,
                                'categoryId' => $cat_array[$category->title],
                                'abundance' => 'true',
                                'languageId' => 1,
                                'platform' => 'desktop']]

                    );
                    if ($res->getStatusCode() == 200) {
                        $results = $res->json()['data'];

                        foreach (array_chunk($results, 10) as $result) {

                            $id = $result['id'];

                            $new_res = $client->get("http://api-v2.olx.com/items/$id");

                            if ($new_res->getStatusCode() == 200) {
                                $data = $new_res->json();


                                $item = Item::create([
                                    'title' => $data['title'],
                                    'description' => $data['description'],
                                    'category_id' => $category->id,
                                    'location_id' => rand(1, 14),
                                    'type' => $faker->randomElement(['personal', 'business']),
                                    'amount' => $data['price']['amount']? : $faker->numberBetween(200,4000),
                                    'negotiable' => $faker->boolean(),
                                    'email' => $faker->freeEmail,
                                    'phone' => $faker->phoneNumber,
                                    'seller_name' => $faker->name,
                                    'user_id' => rand(1, 40),
                                    'premium_until' => $faker->boolean(20) ? $faker->dateTimeBetween("now", "+2 months") : null,
                                    'status' => rand(1, 4),
                                    'created_at' => $faker->dateTimeBetween("-5 months", "now")

                                ]);

                                foreach (array_chunk($data['images'], 3) as  $image) {

                                    try {
                                        Picture::upload($image['url'], $item->id, 'jpg');

                                    } catch(\Exception $e)
                                    {

                                    }
                                }
                            }


                        }
                    }

                } catch(\Exception $e)
                {

                }


            }


        }

    }

}