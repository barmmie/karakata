<?php

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/24/15
 * Time: 9:16 PM
 */
class UserTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $admin = User::createAdmin('Test admin', 'admin@karakata.com', 'password', true);
        $user = User::register('Test user', 'user@karakata.com', 'password', '08089998908098');
        $user->confirmEmail();

        foreach (range(1, 40) as $index) {
            $user = User::register($faker->name, $faker->email, 'password', $faker->phoneNumber);
            $user->confirmEmail();
        }


    }
}