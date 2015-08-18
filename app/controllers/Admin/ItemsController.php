<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/18/15
 * Time: 12:57 PM
 */

namespace Admin;
use View, Input, Redirect, Item;

class ItemsController extends \BaseController {

    public function show($id) {
        $item = Item::findOrFail($id);

    }

    public function index()
    {
        $items = Item::paginate(15);

        return View::make('admin.items.index', compact('items'));
    }

    public function approve($id) {
        $item = Item::findOrFail($id);
        try {
            $item->approve();
            flashSuccess('Item has been approved', '');

        } catch(\Exception $e) {
            flashError('Item could not be approved', '');
        }

        return Redirect::back();

    }

    public function delete($id) {
        $item = Item::findOrFail($id);
        try {
            $item->delete();
            flashWarning('Item has been deleted', '');

        } catch(\Exception $e) {
            flashError('Item could not be deleted', '');
        }

        return Redirect::back();
    }

    public function reject($id) {
        $item = Item::findOrFail($id);
        try {
            $item->reject();
            flashSuccess('Item has been rejected', '');

        } catch(\Exception $e) {
            flashError('Item could not be rejected', '');
        }

        return Redirect::back();
    }
}