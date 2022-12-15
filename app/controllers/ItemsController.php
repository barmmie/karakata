<?php

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/21/15
 * Time: 7:07 PM
 */
class ItemsController extends BaseController
{

    public function create()
    {
        return View::make('items.create');
    }

    public function edit($id)
    {
        $item = Item::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->with('pictures')
            ->firstOrFail();

        return View::make('items.edit', compact('item'));
    }

    public function update($id)
    {
        $result = $this->execute('Karakata\Item\Command\UpdateItemCommand', Input::all() + ['id' => $id]);

        if ($result['success']) {
            $item = $result['payload'];

            flashSuccess($result['message'], '');

            return Redirect::route('dash.myitems');
        } else {
            flashError($result['message']);

            return Redirect::back()->withInput();

        }
    }

    public function store()
    {

        $result = $this->execute('Karakata\Item\Command\PostItemCommand');

        if ($result['success']) {
            $item = $result['payload'];

            $message = '';

            if(Setting::get('require_item_verification', '1') == '1') {
                $message = trans('phrases.item_subject_to_verification');
                flashSuccess($result['message'], $message);

                return Redirect::route('dash.myitems');

            } else {
                flashSuccess($result['message'], $message);
                return Redirect::route('items.show', $item->slug);
            }


        } else {
            flashError($result['message']);

            return Redirect::back()->withInput();

        }
    }

    public function show($slug)
    {
        $item = Item::approved()->whereSlug($slug)
            ->with('category', 'location', 'pictures', 'owner.reviews', 'favoriters')
            ->firstOrFail();

        return View::make('items.show', compact('item'));

    }


    public function search()
    {

        $items = Item::approved()->filtered(Input::all())->search(Input::get('query'));

        $items = $items->with('location', 'pictures', 'category');

        $item_count = $items->count();

        $items = $items->paginate(10);

        return View::make('items.search_result', compact('items', 'item_count'));
    }

    public function favorite($id)
    {

        Auth::user()->favorites()->attach($id);

        flashSuccess('Added to favorites');

        return Redirect::back();
    }

    public function unfavorite($id)
    {
        Auth::user()->favorites()->detach($id);

        flashinfo('Removed from favorites');

        return Redirect::back();
    }

    public function delete($id)
    {
        try {
            $item = Item::where('id', $id)
                ->where('user_id', Auth::user()->id);

            $item->delete();

            flashInfo(trans('phrases.item_deleted'), trans('phrases.item_removed'));
        } catch (Exception $e) {
            flashError(trans('phrases.item_not_deleted'), $e->getMessage());

        }

        return Redirect::back();

    }


}