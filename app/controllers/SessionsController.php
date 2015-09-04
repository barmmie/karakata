<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/18/15
 * Time: 1:48 AM
 */

class SessionsController extends BaseController{



    public function create() {
        return View::make('auth.login');
    }

    public function store() {
        $result = $this->execute('Karakata\User\Command\AuthenticateCommand');

        if($result['success']) {

            flashSuccess('Authentication successful', $result['message']);

            if(Auth::user()->isAdmin())
            {
                return Redirect::route('admin.dashboard');
            } else {
                return Redirect::intended(route('pages.homepage'));
            }

        } else {

            flashError('Authentication error', $result['message']);

            return Redirect::back()
                    ->withInput();
        }
    }

    public function destroy() {

        Auth::logout();

        flashInfo('Logged out', 'Your have now been signed out. see ya');

        return Redirect::route('pages.homepage');
    }
}