<?php

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 6/26/15
 * Time: 2:29 AM
 */
class HomepageTest extends TestCase
{


    /**
     * @test
     */
    public function it_sees_title_on_hompage()
    {
        $this->visit('/');
//            ->withSession(['user' => 'test'])
//            ->see(Setting::get('site_name'));
    }
}