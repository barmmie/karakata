<?php

Event::listen('Enclassified.*', 'Enclassified\Listeners\EmailNotifier');