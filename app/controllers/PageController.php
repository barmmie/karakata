<?php

class PageController extends \BaseController {

    public function homepage()
    {


        $categories = Category::fetchTree($fetchItemCount = true);

        $categories = divide_array($categories->toArray(), 3);

        return View::make('pages.homepage', compact('categories'));
    }

}