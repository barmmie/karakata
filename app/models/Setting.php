<?php

use Cache;

class Setting extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'value', 'description'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */

    /**
     * Retrieve all settings in an array format from the cache, or fetch
     * from the database.
     */
    public static function getSettingsArray()
    {
        return Cache::rememberForever('settings_array', function () {
            return self::all()->lists('value', 'name');
        });
    }

    public static function createOrUpdate($data, $keys)
    {
        $record = self::where($keys)->first();
        if (is_null($record)) {
            return self::create($data);
        } else {
            return self::where($keys)->update($data);
        }
    }

    /**
     * Retrieve the specified setting value from settings array.
     *
     * @var string
     */
    public static function fetch($key)
    {
        $settings = self::getSettingsArray();

        return $settings[$key];
    }

    /**
     * Clear the settings array from the cache.
     */
    public static function clearCache()
    {
        return Cache::forget('settings_array');
    }
}