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

    public function destroy()
    {
        try {
            $picture = Picture::findOrFail(Input::get('picture_id'));

            //Crude user validation should refactor!
            $item = Item::where('id', $picture->item_id)
                        ->where('user_id', Auth::user()->id)
                        ->firstOrFail();

            $picture->delete();

            return Response::json(['message' => 'Picture removed successfully'], 200);


        } catch(Exception $e)
        {
            return Response::json(['message' => $e->getMessage()], 400);
        }
    }

}