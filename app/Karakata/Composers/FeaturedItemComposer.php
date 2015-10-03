<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/1/15
 * Time: 8:32 PM
 */

namespace Karakata\Composers;


class FeaturedItemComposer
{
    public function compose($view)
    {

        $featured_items = \Item::featured(8)->get();

        $view->with('featured_items', $featured_items);
    }

}