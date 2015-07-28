<?php

class Picture extends \Eloquent {
	protected $fillable = ['image_src', 'thumbnail_src'];


    public static function upload($file){
        $type = $file->getClientOriginalExtension();

        $imagedata = Image::make( $file->getRealPath());

        $uploadPath = "/uploads/";

        $file_name = Str::random().".{$type}";

        $image_src = $uploadPath. $file_name;
        $thumbnail_src = "{$uploadPath}thumb_{$file_name}";

        $imagedata->fit(400,400)->save(public_path().$image_src);
        $imagedata->fit(200,200)->save(public_path().$thumbnail_src);

        $picture = static::create([
            'image_src' => $image_src,
            'thumbnail_src' => $thumbnail_src
        ]);

        return $picture;
    }
}