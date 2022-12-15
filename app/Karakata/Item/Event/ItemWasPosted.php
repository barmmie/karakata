<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/29/15
 * Time: 5:28 PM
 */

namespace Karakata\Item\Event;


class ItemWasPosted
{

    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }
}