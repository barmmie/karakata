<?php

class PicturesController extends \BaseController {



	/**
	 * Store a newly created resource in storage.
	 * POST /pictures
	 *
	 * @return Response
	 */
	public function store()
	{
        $file =Input::file('file');

        $picture = Picture::upload($file);

        return Response::json(['picture' => $picture]);


	}

}