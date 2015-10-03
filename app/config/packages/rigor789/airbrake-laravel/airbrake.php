<?php

return [

    /**
     * Should we send errors to Airbrake
     */
    'enabled' => false,
    /**
     * Airbrake API key
     */
    'api_key' => '79f128d5637494dadaef2bc7857c7b79',
    /**
     * Should we send errors async
     */
    'async' => true,
    /**
     * Which enviroments should be ingored? (ex. local)
     */
    'ignore_environments' => [],
    /**
     * Ignore these exceptions
     */
    'ignore_exceptions' => [],
    /**
     * Connection to the airbrake server
     */
    'connection' => [

        'host' => 'powerful-lowlands-1202.herokuapp.com',
        'port' => '443',
        'secure' => true,
        'verifySSL' => true
    ]

];