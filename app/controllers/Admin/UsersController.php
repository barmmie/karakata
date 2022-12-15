<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/3/15
 * Time: 12:27 AM
 */

namespace Admin;

use Input;
use Redirect;
use User;
use View;

class UsersController extends \BaseController
{

    public function index($status = null)
    {
        $users = User::with('items');

        switch ($status) {
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

            case 'admin':
                $users->adminsOnly();
                break;
        }

        if (Input::has('query')) {
            $users->search(Input::get('query'));
        }

        $users = $users->paginate(15);

        return View::make('admin.users.index', compact('users', 'status'));

    }

    public function verify($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->confirmEmail();
            flashSuccess("Verification successful", "{$user->full_name} is now verified");
        } catch (\Exception $e) {
            flashError("{$user->full_name} could not be verified", $e->getMessage());
        }

        return Redirect::back();
    }

    public function ban($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->ban();
            flashInfo("Ban successful", "{$user->full_name} is now banned from the app");
        } catch (\Exception $e) {
            flashError("{$user->full_name} could not be banned", $e->getMessage());
        }

        return Redirect::back();
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->activate();
            flashSuccess("Activation successful", "{$user->full_name} is now a active member of the community");
        } catch (\Exception $e) {
            flashError("{$user->full_name} could not be banned", $e->getMessage());
        }

        return Redirect::back();

    }

    public function items($id)
    {
        $user = User::findOrFail($id);

        $items = $user->items();

        $items = $items->with('location', 'picture', 'category');

        $item_count = $items->count();

        $items = $items->paginate(10);

        return View::make('admin.users.show', compact('user', 'items', 'item_count'));
    }

    public function storeAdmin()
    {
        try {
            $user = $this->execute('Karakata\User\Command\CreateAdminCommand');
            flashSuccess('Admin created successfully');

        } catch (\Exception $e) {
            flashError('An error occured', $e->getMessage());
        }

        return Redirect::back();
    }

}