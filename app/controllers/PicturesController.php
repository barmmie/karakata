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
        $picture = Picture::upload(Input::file('file'));

        return Response::json(['picture' => $picture]);

	}

}