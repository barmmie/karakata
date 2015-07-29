<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/21/15
 * Time: 7:07 PM
 */

class ItemsController extends BaseController {

    public function create()
    {
        return View::make('items.create');
    }

    public function edit($id) {

        $item = Item::find($id);


        return View::make('items.edit', compact('item'));
    }

    public function store() {
       $result =  $this->execute('Enclassified\Item\Command\PostItemCommand');

        if($result['success']) {
            $item = $result['payload'];

            flashSuccess($result['message'], 'Item is still subject to verification from us before being approved');

            return Redirect::route('dash.myitems');
        } else {
            flashError($result['message']);
            return Redirect::back()->withInput();

        }
    }

    public function show($slug) {
        $item = Item::approved()->whereSlug($slug)
                                ->with('category', 'location', 'pictures', 'owner', 'favoriters')
                                ->firstOrFail();

        return View::make('items.show', compact('item'));

    }


    public function search() {

        $items = Item::approved()->search(Input::get('query'))->filtered(Input::all());

        $items = $items->with('location', 'pictures', 'category');

        $item_count = $items->count();

        $items = $items->paginate(10);

        return View::make('items.search_result', compact('items', 'item_count'));
    }

    public function favorite($id) {

        Auth::user()->favorites()->attach($id);

        flashSuccess('Added to favorites');
        return Redirect::back();
    }

    public function unfavorite($id) {
        Auth::user()->favorites()->detach($id);

        flashinfo('Removed from favorites');
        return Redirect::back();
    }


}