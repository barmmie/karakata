<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/1/15
 * Time: 8:32 PM
 */

namespace Enclassified\Composers;


class FeaturedItemComposer {
    public function compose($view){

        $featured_items = \Item::featured(6)->get();

        $view->with('featured_items', $featured_items);
    }

}