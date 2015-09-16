<?php
namespace Karakata\Listeners;

use Artisan;
use Illuminate\Filesystem\Filesystem;
use \anlutro\LaravelSettings\JsonSettingStore;


class SystemListener {

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
        $events->listen('system.update', "Karakata/Listeners/SystemListener@update");
        $events->listen('system.install', "Karakata/Listeners/SystemListener@install");
    }

    public function install($seeds)
    {
        Artisan::call('key:generate');

        Artisan::call('migrate');

        foreach($seeds as $seed)
        {
            Artisan::call('db:seed', ['class' => $seed]);

        }

        $this->installStore->set('is_installed', true);
        $this->installStore->set('current_version', true);

    }

    public function update()
    {
        Artisan::call('migrate');
    }

}