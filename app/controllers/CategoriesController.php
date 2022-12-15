<?php

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/28/15
 * Time: 3:21 AM
 */
class CategoriesController extends BaseController
{


    public function show($category, $sub_category = null)
    {


        $parent_category = Category::where('slug', $category)->firstOrFail();

        if ($sub_category) {
            $sub_category = Category::where('slug', $sub_category)->firstOrFail();
            $ids = [$sub_category->id];

        } else {
            $ids = $parent_category->nestedKeys();
        }

        $items = Item::approved()->whereIn('category_id', $ids);

        $items->filtered(Input::all());

        $items = $items->with('location', 'pictures', 'category');

        $item_count = $items->count();

        $items = $items->paginate(10);

        return View::make('categories.show',
            compact('items', 'parent_category', 'sub_category', 'locations', 'item_count'));


    }
}