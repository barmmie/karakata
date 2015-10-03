<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/31/15
 * Time: 9:37 PM
 */

namespace Karakata\Composers;

use Auth;


class MessageComposer
{

    public function compose($view)
    {
        if (Auth::check()) {
            $unread_message_count = Auth::user()->unreadMessages()->count();
        } else {
            $unread_message_count = 0;
        }

        $view->with('unread_message_count', $unread_message_count);
    }
}