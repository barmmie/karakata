<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/19/15
 * Time: 8:13 PM
 */

namespace Karakata\User\Event;


class UserHasRegistered
{
    public $user;

    public function __construct(\User $user)
    {
        $this->user = $user;
    }
}