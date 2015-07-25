<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/19/15
 * Time: 11:08 PM
 */

class SettingTableSeeder extends Seeder {
    public function run()
    {
        foreach ($this->settings() as $setting) {
            Setting::createOrUpdate($setting, ['name']);
        }
    }

    private function settings()
    {
        $faker = \Faker\Factory::create();
        return [
            [
                'name' => 'Enclassife',
                'value' => 'Your Site Name',
                'description' => $faker->sentence(3),
            
            ],
            [
                'name' => 'site_slogan',
                'value' => $faker->sentence(15),
                'description' => $faker->sentence(3),
            ],
        ];

    }
}