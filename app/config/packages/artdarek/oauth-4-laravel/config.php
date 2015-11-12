<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => 'Session',
    /**
     * Consumers
     */
    'consumers' => array(

        /**
         * Facebook
         */
        'Facebook' => array(
            'client_id' => Setting::get('facebook_client_id'),
            'client_secret' =>  Setting::get('facebook_client_secret'),
            'scope'         => array('email','user_friends', 'user_online_presence'),
        ),
        'Google' => array(
            'client_id'     => Setting::get('google_client_id'),
            'client_secret' => Setting::get('google_client_secret'),
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),

    )

);