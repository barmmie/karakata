<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/23/15
 * Time: 3:03 PM
 */
use Kalnoy\Nestedset\NestedSet;

class CategoryTableSeeder extends Seeder {

    public function run() {
        DB::table('categories')->truncate();

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
            ],
            'For Sale' => [
                'Audio & Stereo'
            ]
        ];

        foreach($cat_array as $key => $categories){

            $this->addChildren($categories, $key);
        }

    }

    protected function addChildren($categories, $parentTitle) {

        $parent = Category::addNode($parentTitle);

        foreach($categories as $category){
            $cat = Category::addNode($category);
            Category::moveNode($cat['id'], $parent['id'], 'inside', $cat['parent_id']);
        }
    }

}