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
            Setting::set($setting['name'], $setting['value' ]);
        }
    }

    private function settings()
    {
        $faker = \Faker\Factory::create();
        return [
            [
                'name' => 'site_name',
                'value' => 'Karakata',
                'label' => 'Site name',
                'description' => $faker->sentence(3),
            
            ],
            [
                'name' => 'site_description',
                'value' => $faker->sentence(15),
                'label' => 'Site description',
                'description' => 'A slogan for your company, useful for seo purposes',
            ],
            [
                'name' => 'site_slogan',
                'value' => "Buy what you wnat. Sell what you don't need. it's free"
            ],
            [
                'name' => 'currency',
                'value' => '£',
                'description' => 'Currency in which amount of things are displayed'
            ]
        ];

    }
}