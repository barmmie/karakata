<?php

class Location extends \Eloquent
{
    protected $fillable = ['name', 'latitude', 'longitude', 'geonameid'];

    public static function bulkInsert($locations)
    {
        return DB::table('locations')->
        insert($locations);
    }


    public function items()
    {
        return $this->hasMany('Item');
    }

    public static function fetchAll()
    {
        return static::all(['id', 'name']);
    }
}