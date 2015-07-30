<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/30/15
 * Time: 1:27 PM
 */

namespace Enclassified\Message\Event;


class MessageHasBeenPosted {

    public $message;
    public function __construct($message) {
        $this->message;
    }

}