<?php

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/25/15
 * Time: 6:46 PM
 */
class DashController extends \BaseController
{


    public function myitems()
    {
        $items = Auth::user()->items()->with('pictures', 'location', 'category')->paginate(10);

        return View::make('dash.myitems', compact('items'));
    }

    public function myfavorites()
    {

        $items = Auth::user()->favorites();

        $items = $items->with('location', 'pictures', 'category');

        $item_count = $items->count();

        $items = $items->paginate(10);

        return View::make('dash.myfavorites', compact('items', 'item_count'));
    }

    public function mymessages($message_filter = null)
    {
        $messages = Auth::user()->messages();

        if ($message_filter && in_array($message_filter, ['read', 'unread'])) {
            $messages->where('read_status', $message_filter == 'read' ? true : false);
        }

        $messages = $messages->with('item')->paginate(10);

        if ($message_filter == 'unread') {
            Message::markAsRead($messages);
        }

        return View::make('dash.mymessages', compact('messages', 'message_filter'));
    }
}