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
        return View::make('pages.terms_conditions');

    }

    public function page404()
    {
        return View::make('errors.404');
    }

    public function page500()
    {
        return View::make('errors.500');

    }

    public function switch_language($lang = 'en') {
        Session::put('language_locale', $lang);

        return Request::header('referer') ? Redirect::back() : Redirect::route('pages.homepage');
    }

    public function feed($type = 'rss') {

        if(in_array($type, ['rss', 'atom'])) {
            $items = Item::approved()->get();
            $channel  = [
                'title' => Setting::get('site_name'),
                'description' => "Latest items from ".Setting::get('site_name'),
                'link' => route('pages.homepage'),
                'logo' => asset(Setting::get('logo_src')),
                'icon' => asset(Setting::get('logo_src')),
                'pubdate' => Carbon::now()->toDayDateTimeString(),
                'lang' => Setting::get('default_locale', 'en')

            ];
            $content = View::make("feeds.{$type}", compact('items', 'channel'))->render();

            return Response::make($content, '200', ['Content-type' => "application/{$type}+xml;charset=utf-8"]);

        } else {
            flashError('phrases.error_occured');
            return Redirect::route('pages.homepage');
        }

    }

}