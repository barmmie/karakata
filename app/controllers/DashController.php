<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/25/15
 * Time: 6:46 PM
 */



class DashController extends \BaseController {
    public function myitems() {
        $items = Auth::user()->items;

        return View::make('dash.myitems', compact('items'));
    }
}