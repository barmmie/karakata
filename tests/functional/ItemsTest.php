<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/21/15
 * Time: 7:08 PM
 */

use Laracasts\TestDummy\Factory as TestDummy;

class ItemsTest extends TestCase {
    use DatabaseTransactionTrait;


    /**
     * @test
     */

    public function it_creates_a_new_item() {
        $locs = TestDummy::times(3)->create('Location');
        Category::createTestNodes();

        $item = TestDummy::attributesFor('Item');
            $this->verifiedLogin()
                ->visit('items/new')
                ->submitForm('Create my ad', $item)
                ->seeInDatabase('items', $item)
            ;
    }

    /**
     * @test
     */

    public function it_redirects_guests_who_tries_to_creates_a_new_item() {
        $this->visit('items/new')
            ->see('Authentication required');

        return $this->verifiedLogin()
            ->visit('items/new')
            ->see('Post free classified');



    }



}