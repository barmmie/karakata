<?php

class Picture extends \Eloquent
{
    protected $fillable = ['image_src', 'thumbnail_src', 'item_id'];


    public static function upload($file, $item_id = 0, $extension = null)
    {
        $type = $extension?:$file->getClientOriginalExtension();

        $imagedata = Image::make($file);

        $uploadPath = "/uploads/";

        $file_name = Str::random() . ".{$type}";

        $image_src = $uploadPath . $file_name;
        $thumbnail_src = "{$uploadPath}thumb_{$file_name}";

        $imagedata->fit(800, 400)->save(public_path() . $image_src);
        $imagedata->fit(320, 240)->save(public_path() . $thumbnail_src);

        $imagedata->destroy();

        $picture = static::create([
            'image_src' => $image_src,
            'thumbnail_src' => $thumbnail_src,
            'item_id' => $item_id
        ]);

        return $picture;
    }
}