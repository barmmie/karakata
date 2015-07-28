<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/28/15
 * Time: 3:21 AM
 */

class CategoriesController extends BaseController {


    public function show($category, $sub_category = null) {

        $parent_category = Category::where('slug', $category)->firstOrFail();

        if($sub_category) {
            $sub_category = Category::where('slug', $sub_category)->firstOrFail();
            $ids = [$sub_category->id];

        } else {
            $ids = $parent_category->nestedKeys();
        }


        $items = Item::whereIn('category_id', $ids);

        if(Input::has('location_id')) {
            $items = $items->where('location_id', Input::get('location_id'));
        }

        if(Input::has('price_sort')) {
            $items = $items->orderBy('amount', Input::get('price_sort', 'asc'));
        }

        $items = $items->with('location', 'pictures', 'category')->paginate(15);

        return View::make('categories.show', compact('items', 'parent_category', 'sub_category'));
        

    }
}