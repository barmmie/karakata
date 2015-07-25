<?php

class PageController extends \BaseController {

    public function homepage()
    {
        return View::make('pages.homepage');
    }

}