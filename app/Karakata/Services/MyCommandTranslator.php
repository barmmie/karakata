<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/19/15
 * Time: 10:33 PM
 */

namespace Karakata\Services;


use Laracasts\Commander\BasicCommandTranslator;

class MyCommandTranslator extends BasicCommandTranslator
{


    public function toValidator($command)
    {
        return 'Karakata\Services\MyCommandValidator';
    }
}