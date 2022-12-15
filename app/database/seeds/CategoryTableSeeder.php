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

        $cat_array = [
            'mobile | Mobile Phones - Tablets' => [
                'mobile | Phones - Mobile Phones |moa',
                'tablet | Tablets |moa',
                'attach | Phone Accessories |moa',
            ],
            'building | Home Furniture Garden' => [
                'keyboard | Office and Commercial|bfa',
                'plug | Home Appliances|ppa',
                'tree | Furniture|fua',
                'rain | Decor - Garden - Accessories|hfa',
                'leaf | Agriculture and Foodstuff|gra',
            ],
            'diamond | Fashion and Beauty' => [
                'shop | Clothing and Shoes|cla',
                'diamond | Watches - Jewelry - Accessories|jwa',
                'heartbeat | Health and Beauty|haa',
                'child | Babies and Kids|baa',
            ],
            'home | Real estate' => [
                'cubes|Houses - Apartments for Rent|apa',
                'map|  Parking and storage | prk',
                'cubes|Houses - Apartments for Sale|rea',
                'building outline|Office and Shops|off',
                'travel|Temporary and Vacation Rentals|vac',
            ],
            'desktop|Electronics - Video|ela' => [
                'desktop | Computers - Laptops|computers',
                'game|Video Games - Consoles|vga',
                'camera retro|Cameras and accessories|pha',
                'film| TV - Audio - Video|ema',
            ],
            'car|Vehicles|' => [
                'car|Cars|autos',
                'shipping|Trucks - Commercial - Agricultural|hva',
                'settings|Cars Accesories|pta',
                'road|Other Vehicles',
            ],
            'music|Hobbies - Art - sports' => [
                'Sporting goods - Bicycles|sga',
                'unmute|Musical Instruments|msa',
                'book|Books - CDs - DVDs|bka',
                'game|Toys and Games|taa',
                'write|Art - Collectibles|cba',
            ],
            'suitcase|Jobs and Services' => [
                'wizard|Services|crs',
                'folder open outline| Offered Jobs|bus',
                'student|Classes - Courses|lss',
                'file text outline|Seeking Work - CVs|res',
            ],
            'paw|Pet' => [
                'paw|Dogs - Cats|pet',
                'linkify|Pet\'s Accessories|pas',
                'bug|Other Animals',
            ]
        ];

        foreach ($cat_array as $key => $categories) {

            $this->addChildren($categories, $key);
        }

    }

    protected function addChildren($categories, $parentTitle)
    {
        $catgry = explode('|', $parentTitle);
        $parent = Category::addNode(trim($catgry[1]), trim($catgry[0]));

        foreach ($categories as $category) {
            $_catgry = explode('|', $category);
            $cat = Category::addNode(trim($_catgry[1]), trim($_catgry[0]));
            Category::moveNode($cat['id'], $parent['id'], 'inside', $cat['parent_id']);
        }
    }

}