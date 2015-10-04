<?php

use Carbon\Carbon;

class PageController extends \BaseController
{

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

        $items = Item::approved()->get();

        foreach ($items as $item) {
            $sitemap->add(route('items.show', $item->slug), $item->created_at, '0.9', 'weekly');
        }

        $categories = Category::fetchTree($fetchItemCount = false);

        foreach ($categories as $category) {
            $sitemap->add(route('categories.show', $category['slug']), $category->created_at, '0.9', 'weekly');

            foreach ($category['children'] as $child) {
                $sitemap->add(route('categories.show', [$category['slug'], $child['slug']]), $child->created_at, '0.9',
                    'weekly');

            }
        }

        return $sitemap->render('xml');
    }

    public function about()
    {
        return View::make('pages.about');
    }

    public function faq()
    {
        return View::make('pages.faq');
    }

    public function privacyPolicy()
    {
        return View::make('pages.privacy_policy');

    }

    public function termsConditions()
    {
        return View::make('pages.terms-conditions');

    }

    public function page404()
    {
        return View::make('errors.404');
    }

    public function page500()
    {
        return View::make('errors.500');

    }

}