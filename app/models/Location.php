<?php

class Location extends \Eloquent
{
    protected $fillable = ['name', 'latitude', 'longitude', 'geonameid'];

	public static function boot()
	{
		static::deleting(function ($loc) {

				$loc->items()->delete();
		});
	}

    public static function bulkInsert($locations)
    {
        $now = Carbon\Carbon::now();
        foreach ($locations as $index => $location) {
            $locations[$index]['created_at'] = $now->toDateTimeString();
            $locations[$index]['updated_at'] = $now->toDateTimeString();
        }

        return DB::table('locations')->
        insert($locations);
    }

    public static function fetchAll()
    {
        return static::all(['id', 'name']);
    }

    public function items()
    {
        return $this->hasMany('Item');
    }
}