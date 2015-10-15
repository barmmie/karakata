<?php

$factory('User', [
    'full_name' => $faker->name,
    'email' => $faker->email,
    'password' => Hash::make('password'),
    'phone' => $faker->phoneNumber
]);


$factory('Location', [
    'name' => $faker->city,
    'parentName' => $faker->country,
    'latitude' => $faker->latitude,
    'longitude' => $faker->longitude,
    'geonameid' => $faker->numberBetween(123456, 234567)
]);


$factory('Item', [
    'title' => $faker->sentence,
    'description' => $faker->text,
    'location_id' => 2,
    'category_id' => 4,
    'amount' => $faker->numberBetween(1000, 2000),
    'negotiable' => $faker->randomElement([0, 1]),
    'type' => $faker->randomElement(['business', 'personal']),
    'email' => $faker->email,
    'seller_name' => $faker->name,
    'phone' => $faker->phoneNumber,
]);

$factory('Category', function ($faker) {
    Category::createRoot();
    $cat = Category::addNode($faker->word);
    $cat = Category::addNode($faker->word);
    $cat = Category::addNode($faker->word);

    [
        'parent_id' => 'factory:Category',
        'name' => $faker->sentence
    ];
});