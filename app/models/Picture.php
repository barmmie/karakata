<?php

class Picture extends \Eloquent
{
    protected $fillable = ['image_src', 'thumbnail_src', 'item_id'];

	public static function boot() {
		parent::boot();
		static::deleting(function ($picture) {
			try {
				Flysystem::connection(Setting::get('storage_connection', 'local'))->delete($picture->image_src);
				Flysystem::connection(Setting::get('storage_connection', 'local'))->delete($picture->thumbnail_src);
			} catch (Exception $e){}

		});
	}


    public static function upload($file, $item_id = 0, $extension = null)
    {
        $type = $extension ?: $file->getClientOriginalExtension();

        $imagedata = Image::make($file);

        $uploadPath = "/uploads/";

        $file_name = Str::random() . ".{$type}";

        $image_src = $uploadPath . $file_name;
        $thumbnail_src = "{$uploadPath}thumb_{$file_name}";

	    $text = ''.Setting::get('site_name', 'Karakata');
	    $textX = (800/ 2) - ((strlen($text)/2) * 28);
	    $textY = 350;

	    $textLayer = Image::canvas( 800,400, array(0, 0, 0, 0) );

	    for( $x = -1; $x <= 1; $x++ ) {
		    $textLayer->text($text, $textX + $x, $textY, function($font) {
			    $font->file(public_path().'/assets/css/Roboto.ttf');
			    $font->size(28);
			    $font->color('#ffffff'); // Glow color
		    });

	    }

	    $textLayer->text($text, $textX, $textY, function($font) {
		    $font->file(public_path().'/assets/css/Roboto.ttf');
		    $font->size(28);
		    $font->color('#444444'); // Text color
	    });
	    $imagedata->fit(800, 400)
		    ->insert($textLayer)
	        ->encode($type);

	    Flysystem::connection(Setting::get('storage_connection', 'local'))->put($image_src, (string)$imagedata);

        $imagedata->fit(320, 240)
	        ->encode($type);

	    Flysystem::connection(Setting::get('storage_connection', 'local'))->put($thumbnail_src, (string)$imagedata);

	    $imagedata->destroy();

	    $picture = static::create([
            'image_src' => static::getPublicUrl($image_src),
            'thumbnail_src' => static::getPublicUrl($thumbnail_src),
            'item_id' => $item_id
        ]);

	    return $picture;
    }

	public static function getPublicUrl($source) {
		$connection = Setting::get('storage_connection', 'local');

		switch ($connection) {
			case 'local':
				$url = $source;
				break;
			case 'awss3':
				$url = Flysystem::connection($connection)->getAdapter()->getClient()->getObjectUrl(Setting::get('storage_awss3_bucket'), $source);
				break;
			case 'dropbox':
				$url = Flysystem::connection($connection)->getAdapter()->getClient()->createShareableLink($source);
				$url = str_replace('https://www.', 'https://dl.', $url);
				break;
			default:
				$url = $source;
				break;
		}

		return $url;
	}
}