<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/28/15
 * Time: 10:37 PM
 */

namespace Enclassified\Composers;


class CategoryComposer {
    public function compose($view){

        $categories = \Category::fetchTree();

        $view->with('categories', $categories);
    }
}