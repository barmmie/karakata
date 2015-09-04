<?php
namespace Karakata\Listeners;

use Artisan;


class SystemListener {

    public function subscribe($events)
    {
        $events->listen('system.install', "Karakata/Listeners/SystemListener@install");
        $events->listen('system.update', "Karakata/Listeners/SystemListener@update");
    }

    public function install()
    {
        Artisan::call('key:generate');

        Artisan::call('migrate');

        Artisan::call('db:seed');
    }

    public function update()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

}