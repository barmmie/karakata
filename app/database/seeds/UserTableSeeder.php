<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/24/15
 * Time: 9:16 PM
 */


class UserTableSeeder extends Seeder {
    public function run(){
        $user = User::register('Test user', 'test@gmail.com', 'password', '08089098090');
        $user->confirmEmail();
    }
}