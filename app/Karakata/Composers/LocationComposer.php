<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/28/15
 * Time: 10:32 PM
 */

namespace Karakata\Composers;


class LocationComposer
{

    public function compose($view)
    {
        $locations =  \Cache::get('locations.composer', function() {
            return \Location::fetchAll();
        });

        $view->with('locations', $locations);

    }

}