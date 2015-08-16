<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/3/15
 * Time: 12:27 AM
 */

namespace Admin;

use User, View, Input;
class UsersController extends \BaseController {

    public function index($status = null)
    {
        $users = User::with('items');


        switch ($status){
            case 'active':
                $users->activeOnly();
                break;
            case 'verified':
                $users->verifiedOnly();
                break;
            case 'unverified':
                $users->unverifiedOnly();
                break;
            case 'banned':
                $users->bannedOnly();
                break;
        }

        if(Input::has('query')) {

            $users->search(Input::get('query'));

        }

        $users = $users->paginate(15);

        return View::make('admin.users.index', compact('users', 'status'));

    }

}