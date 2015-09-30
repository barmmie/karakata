<?php

Event::listen('Karakata.*', 'Karakata\Listeners\EmailNotifier');

Event::subscribe('Karakata\Listeners\SystemListener');

Event::subscribe(Karakata\Listeners\SystemListener::class);