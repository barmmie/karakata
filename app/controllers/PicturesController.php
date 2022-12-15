<?php

class PicturesController extends \BaseController
{


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


        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage()], 400);
        }
    }

	public function uploadLogo()
	{
		$image = Image::make(Input::get('data'));
		$logo_src = "/uploads/logo.jpg";
		$image->save(public_path($logo_src), 100);
		Setting::set('logo_src', $logo_src);

		return [
			'filename' =>  $logo_src,
			'status' => "success",
			'url' =>  asset($logo_src)
		];
	}

}