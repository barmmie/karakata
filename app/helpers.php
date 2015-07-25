<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/20/15
 * Time: 3:20 PM
 */


function flashError($messageContent, $additionalInfo='') {
    flash('negative', $messageContent, $additionalInfo);
}

function flashInfo($messageContent, $additionalInfo='') {
    flash('info', $messageContent, $additionalInfo);
}

function flashSuccess($messageContent, $additionalInfo='') {
    flash('success', $messageContent, $additionalInfo);
}

function flash($type, $messageContent, $additionalInfo='') {

    $messages = Session::get('feedback', []);
    array_push($messages, ['type' => $type,
        'content' => $messageContent,
        'additionalInfo'=> $additionalInfo
    ]);
    Session::flash('feedback', $messages);
}

