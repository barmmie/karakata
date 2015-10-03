<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => array(
        'domain' => '',
        'secret' => '',
    ),
    'mandrill' => array(
        'secret' => '',
    ),
    'stripe' => array(
        'model' => 'User',
        'secret' => '',
    ),
    'airbrake' => [
        'api_key' => '79f128d5637494dadaef2bc7857c7b79',
        'host' => 'powerful-lowlands-1202.herokuapp.com',
        'port' => 443,
        'secure' => true
    ]

);
