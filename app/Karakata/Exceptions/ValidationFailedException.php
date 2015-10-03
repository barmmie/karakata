<?php namespace Karakata\Exceptions;

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/19/15
 * Time: 7:47 PM
 */

class ValidationFailedException extends \Exception
{
    protected $errors;

    function  __construct($message, \Illuminate\Support\MessageBag $errors)
    {
        $this->errors = $errors;
        parent::__construct($message);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}