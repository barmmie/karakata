<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/2/15
 * Time: 4:19 PM
 */

namespace Admin;

use Input;
use Redirect;
use Setting;
use View;
use WebDriver\Exception;


class SettingsController extends \BaseController
{

    public function edit()
    {
        return View::make('admin.settings.edit');
    }

    public function update()
    {


        try {
            foreach (Input::all() as $key => $value) {
                Setting::set($key, $value);
            }

            flashSuccess('Settings have been updated successfully');

            return Redirect::back();
        } catch (Exception $e) {
            flashError('An error occured while saving', $e->getMessage());

            return Redirect::back()
                ->withInput();

        }

    }


}