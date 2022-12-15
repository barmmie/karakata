<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/1/15
 * Time: 11:04 PM
 */

namespace Karakata\Composers;


class LatestItemComposer
{

    public function compose($view)
    {
        $latest_items = \Item::latest(4)->get();
        $view->with('latest_items', $latest_items);
    }

}