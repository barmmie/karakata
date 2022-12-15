<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/1/15
 * Time: 8:25 PM
 */

namespace Karakata\Composers;


class PopularCategoryComposer
{
    public function compose($view)
    {
        $categories =  \Cache::remember('categories.popular', 30,  function() {
            return \Category::popular(10)->get();
        });

        $view->with('popular_categories', $categories);
    }
}