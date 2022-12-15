<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 9/19/15
 * Time: 9:06 PM
 */

namespace Karakata\Composers;


class PremiumItemComposer
{

    public function compose($view)
    {
        $featured_items = \Item::featured(1)->get();

        $view->with('premium_items', $featured_items);
    }
}