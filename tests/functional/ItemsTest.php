<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/21/15
 * Time: 7:08 PM
 */

use Laracasts\TestDummy\Factory as TestDummy;

class ItemsTest extends TestCase
{
    use DatabaseTransactionTrait;


    /**
     * @test
     */

    public function it_creates_a_new_item()
    {
        $locs = TestDummy::times(3)->create('Location');
        Category::createTestNodes();

        $item = TestDummy::attributesFor('Item');
        $this->verifiedLogin()
            ->visit('items/new')
            ->submitForm('Create my item', $item)
            ->seeInDatabase('items', $item);

        $this->visit('/myitems')
            ->see($item['title']);
    }

    /**
     * @test
     */

    public function it_redirects_guests_who_tries_to_creates_a_new_item()
    {
        $this->visit('items/new')
            ->see('Authentication required');

        return $this->verifiedLogin()
            ->visit('items/new')
            ->see('Post a Free classified');
    }

    /**
     *
     * @test
     */

    public function it_favorites_an_item()
    {

        $locs = TestDummy::times(3)->create('Location');
        Category::createTestNodes();
        $user1 = TestDummy::create('User');
        $user = TestDummy::create('User');
        $item_att = TestDummy::attributesFor('Item');

        $item = Item::create($item_att + ['user_id' => $user1->id]);
        $item->approve();

        $this->verifiedLogin($user)
            ->visit("items/{$item->slug}")
            ->see('Add to favorites')
            ->click('Add to favorites')
//            ->onPage("items/{$item->slug}")
            ->see('Remove from favorites')
//            ->click('Remove form favorites')
//            ->onPage("items/{$item->slug}")
//            ->see('Add to favorites')
        ;
    }


}