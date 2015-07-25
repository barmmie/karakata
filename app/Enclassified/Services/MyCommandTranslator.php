<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/19/15
 * Time: 10:33 PM
 */

namespace Enclassified\Services;


use Laracasts\Commander\BasicCommandTranslator;

class MyCommandTranslator extends BasicCommandTranslator {


    public function toValidator($command)
    {
        return 'Enclassified\Services\MyCommandValidator';
    }
}