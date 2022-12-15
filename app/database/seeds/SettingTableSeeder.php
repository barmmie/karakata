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
                'name' => 'premium_amount',
                'value' => '20',


            ],
            [
                'name' => 'premium_days',
                'value' => '40',
            ],
            [
                'name' => 'allow_premium_payment',
                'value' => '0',
            ]
        ];

    }
}