<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/18/15
 * Time: 12:57 PM
 */

namespace Admin;

use Input;
use Item;
use Redirect;
use Report;
use URL;
use View;

class ItemsController extends \BaseController
{

    public function show($id)
    {
        $item = Item::with('category', 'location', 'pictures', 'owner', 'favoriters')
            ->findOrFail($id);

        $reports = Report::where('item_id', $id)->paginate(5);

        return View::make('admin.items.show', compact('item', 'reports'));

    }

    public function edit($id){
        $item = Item::where('id', $id)
            ->with('pictures')
            ->firstOrFail();

        return View::make('admin.items.edit', compact('item'));
    }

    public function update($id){
        $result = $this->execute('Karakata\Item\Command\UpdateItemCommand', Input::all() + ['id' => $id]);

        if ($result['success']) {
            $item = $result['payload'];

            flashSuccess($result['message'], '');

            return Redirect::route('admin.items.show', $id);
        } else {
            flashError($result['message']);

            return Redirect::back()->withInput();

        }
    }

    public function index($status = null)
    {
        $items = Item::orderBy('created_at', 'desc');

        switch ($status) {
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

        if (Input::has('query')) {
            $items->search(Input::get('query'));
        }

        $items = $items->paginate(15);

        return View::make('admin.items.index', compact('items', 'status'));
    }

    public function approve($id)
    {
        $item = Item::findOrFail($id);
        try {
            $item->approve();
            flashSuccess('Item has been approved', '');

        } catch (\Exception $e) {
            flashError('Item could not be approved', '');
        }

        return Redirect::back();

    }

    public function delete($id)
    {
        $item = Item::findOrFail($id);
        $redirect_back = (URL::previous() == route('admin.items.show', $id)) ? false : true;
        try {
            $item->delete();
            flashInfo('Item has been deleted', '');

        } catch (\Exception $e) {
            flashError('Item could not be deleted', '');
        }

        if ($redirect_back) {
            return Redirect::back();
        } else {
            return Redirect::route('admin.items.index');
        }
    }

    public function reject($id)
    {
        $item = Item::findOrFail($id);
        try {
            $item->reject();
            flashSuccess('Item has been rejected', '');

        } catch (\Exception $e) {
            flashError('Item could not be rejected', '');
        }

        return Redirect::back();
    }

    public function markPremium($id)
    {
        $item = Item::findOrFail($id);
        try {
            $item->markAsPremium();
            flashSuccess('Item has been marked as premium', '');

        } catch (\Exception $e) {
            flashError('Item could not be marked as premium', '');
        }

        return Redirect::back();
    }
}