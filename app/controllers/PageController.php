<?php

use Carbon\Carbon;

class PageController extends \BaseController {

    public function homepage()
    {


        $categories = Category::fetchTree($fetchItemCount = true);

        $categories = divide_array($categories->toArray(), 3);

        return View::make('pages.homepage', compact('categories'));
    }

    public function sitemap()
    {
        $sitemap = App::make("sitemap");

        $yesterday = new Carbon('yesterday');
        $lastWeek = new Carbon('last week');
        $lastMonth = new Carbon('last month');

        $routeCollection = Route::getRoutes();

        $dynamicReg = "/{\\S*}/"; //used for omitting dynamic urls that have {} in uri

        foreach ($routeCollection as $route) {

            if(!preg_match($dynamicReg,$route->getUri())
//                && !blacklisted($route->getUri())
                && in_array('GET',$route->getMethods())
                && (isset($route->getAction()['index']) && $route->getAction()['index']!==false)
            ){

                $sitemap->add(URL::to($route->getUri()), $lastWeek , '1.0', 'daily');

            }

        }

        $items = Item::approved()->get();

        foreach($items as $item) {
            $sitemap->add(route('items.show',$item->slug), $item->created_at, '0.9', 'weekly');
        }

        $categories = Category::fetchTree($fetchItemCount = false);

        foreach($categories as $category) {
            $sitemap->add(route('categories.show', $category['slug'] ), $category->created_at, '0.9', 'weekly');

            foreach($category['children'] as $child) {
                $sitemap->add( route('categories.show', [$category['slug'], $child['slug']]), $child->created_at, '0.9', 'weekly');

            }
        }

        return $sitemap->render('xml');
    }

}