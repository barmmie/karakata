<?php

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/19/15
 * Time: 11:08 PM
 */
class SettingTableSeeder extends Seeder
{
    public function run()
    {
        foreach ($this->settings() as $setting) {
            Setting::set($setting['name'], $setting['value']);
        }
    }

    private function settings()
    {
        return [
            [
                'name' => 'allow_premium_payment',
                'value' => '0',

            ],
            [
                'name' => 'premium_amount',
                'value' => 40,
            ],
            [
                'name' => 'site_slogan',
                'value' => "Buy what you want. Sell what you don't need. it's free"
            ],
            [
                'name' => 'currency',
                'value' => '£',
            ]
        ];

    }
}