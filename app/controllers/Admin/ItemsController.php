<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/18/15
 * Time: 12:57 PM
 */

namespace Admin;
use View, Input, Redirect, Item, Report, URL;

class ItemsController extends \BaseController {

    public function show($id) {
        $item = Item::with('category', 'location', 'pictures', 'owner', 'favoriters')
                    ->findOrFail($id);

        $reports = Report::where('item_id', $id)->paginate(5);

        return View::make('admin.items.show', compact('item', 'reports'));

    }

    public function index($status = null)
    {
        $items = Item::orderBy('created_at', 'desc');

        switch ($status){
            case 'pending':
                $items->pendingOnly();
                break;
            case 'approved':
                $items->approvedOnly();
                break;
            case 'rejected':
                $items->rejectedOnly();
                break;
        }

        if(Input::has('query')) {
            $items->search(Input::get('query'));
        }

        $items = $items->paginate(15);

        return View::make('admin.items.index', compact('items', 'status'));
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
        $redirect_back = (URL::previous() == route('admin.items.show', $id)) ? false : true;
        try {
            $item->delete();
            flashInfo('Item has been deleted', '');

        } catch(\Exception $e) {
            flashError('Item could not be deleted', '');
        }

        if($redirect_back)
            return Redirect::back();
        else
            return Redirect::route('admin.items.index');
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