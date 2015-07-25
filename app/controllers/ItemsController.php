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
        $categories = Category::fetchTree();
        $locations = Location::fetchAll();
        return View::make('items.create', compact('categories','locations'));
    }

    public function store() {
       $result =  $this->execute('Enclassified\Item\Command\PostItemCommand');

        if($result['success']) {
            $item = $result['payload'];

            flashSuccess($result['message'], 'Item is still subject to verification from us before being approved');

            return Redirect::route('dash.my_items', $item->slug);
        } else {
            flashError($result['message']);
            return Redirect::back()->withInput();

        }
    }


}