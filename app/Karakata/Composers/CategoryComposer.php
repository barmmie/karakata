<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/28/15
 * Time: 10:37 PM
 */

namespace Karakata\Composers;


class CategoryComposer
{
    public function compose($view)
    {
        $categories =  \Cache::get('categories.composer', function() {
            return \Category::fetchTree();
        });

        $view->with('categories', $categories);
    }
}