<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/23/15
 * Time: 3:03 PM
 */
use Kalnoy\Nestedset\NestedSet;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('categories')->delete();

        NestedSet::createRoot('categories', array(
            'title' => 'Root',
        ));


        $cat_array = [
            'Automobiles' => [
                'Car parts & accessories',
                'Campervans $ caravans',
                'Motorbikes & scooters',
                'Vans trucks & Plants',
            ],
            'Services' => [
                'Building, Home & Removals',
                'Entertainment',
                'Health & beauty',
                'Miscellaneaous',
                'Property & Shipping',
                'Tax money & Visas',
                'Telecoms and computers',
                'Travel services and tours',
                'Tuition and home lessons'

            ],
            'For Sale' => [
                'Audio & Stereo',
                'Baby kids & stuff',
                'CDs DVDs, Games & Books',
                'Clothes, Footwear & accessories',
                'Computers & software',
                'Home & garden',
                'Music & instrument',
                'Office furniture & equipments',
                'Phones, Mobile phones & laptops',
                'Sports leisure travel',
                'Tickets',
                'Tv Dvd & Cameras',
                'Video games & cameras',
                'Video games & consoles',
            ],
            'Property' => [
                'House for rent',
                'House for sale',
                'Apartments for rent',
                'Apartments for sale',
                'Farm ranches',
                'Land',
                'Vacation rentals',
                'Commercial builidng'


            ],
            'Pets' => [
                'Pets for sale',
                'Petsitters & dogwalkers',
                'Pet equipments & accessories',
                'Missing lost and found'
            ],
            'Jobs' => [
                'Full-time jobs',
                'Internet jobs',
                'Learn and earn jobs',
                'Manual labor jobs'
            ],
            'Learning' => [
                'Sports classes',
                'Language classes',
                'Personal fitness',
                'Music lessons'
            ],
            'Community' => [
                'Pets for sale',
                'Petsitters & dogwalkers',
                'Pet equipments & accessories',
                'Missing lost and found'
            ],
        ];

        foreach ($cat_array as $key => $categories) {

            $this->addChildren($categories, $key);
        }

    }

    protected function addChildren($categories, $parentTitle)
    {

        $parent = Category::addNode($parentTitle);

        foreach ($categories as $category) {
            $cat = Category::addNode($category);
            Category::moveNode($cat['id'], $parent['id'], 'inside', $cat['parent_id']);
        }
    }

}