<?php

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/24/15
 * Time: 3:08 PM
 */
class CategoryTest extends TestCase
{

    use DatabaseTransactionTrait;


    /**
     *
     * @test
     */
    public function it_creates_a_category_an_moves_it_around()
    {
        $cat1 = Category::addNode('Test');
        $cat2 = Category::addNode('Test 2');
        $cat3 = Category::addNode('test 3');
        $cat4 = Category::addNode('test 4');


        $this->seeInDatabase('categories', ['title' => 'Test', 'parent_id' => 1]);
        $this->seeInDatabase('categories', ['title' => 'Test 2', 'parent_id' => 1]);
        $this->seeInDatabase('categories', ['title' => 'Test 3', 'parent_id' => 1]);
        $this->seeInDatabase('categories', ['title' => 'Test 4', 'parent_id' => 1]);

        Category::moveNode($cat2['id'], $cat1['id'], 'inside', $cat1['id']);
        Category::moveNode($cat3['id'], $cat1['id'], 'inside', $cat1['id']);
        Category::moveNode($cat4['id'], $cat2['id'], 'inside', $cat2['id']);

        $this->seeInDatabase('categories', ['title' => 'Test 2', 'parent_id' => $cat1['id']]);
        $this->seeInDatabase('categories', ['title' => 'Test 3', 'parent_id' => $cat1['id']]);
        $this->seeInDatabase('categories', ['title' => 'Test 4', 'parent_id' => $cat2['id']]);


    }
}