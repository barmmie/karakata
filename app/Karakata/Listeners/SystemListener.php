<?php namespace Karakata\Listeners;

use anlutro\LaravelSettings\JsonSettingStore;
use Artisan;
use Config;
use Illuminate\Filesystem\Filesystem;
use Setting;


class SystemListener
{

    protected $installStore;
    protected $fileSystem;

    public function __construct()
    {
        $filesystem = new Filesystem;
        $this->fileSystem = $filesystem;
        $this->installStore = new JsonSettingStore($filesystem, storage_path() . '/installation.json');

    }

    public function subscribe($events)
    {
        $events->listen('system.update', 'Karakata\Listeners\SystemListener@update');
        $events->listen('system.install', 'Karakata\Listeners\SystemListener@install');
    }

    public function install($seeds)
    {


//        Artisan::call('key:generate');

        Artisan::call('migrate', ['--force' => true]);

        foreach ($seeds as $seed) {
            Artisan::call('db:seed', ['--class' => $seed, '--force' => true]);

        }

        Setting::set('is_installed', '1');
        Setting::set('current_version', Config::get('app.version'));


    }

    public function update()
    {
        Artisan::call('migrate');
        Setting::set('current_version', Config::get('app.version'));

    }

}