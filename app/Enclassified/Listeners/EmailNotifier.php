<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/21/15
 * Time: 12:41 AM
 */

namespace Enclassified\Listeners;


use Enclassified\Mailer\AppMailer;
use Laracasts\Commander\Events\EventListener;

class EmailNotifier extends EventListener {
    protected $appMailer;

    public function __construct(AppMailer $appMailer){
        $this->appMailer = $appMailer;
    }


    public function whenUserHasRegistered($userHasRegistered){
        $this->appMailer->sendConfirmationMail($userHasRegistered->user);
    }

    public function whenMessageHasBeenPosted($messagePosted){

        $this->appMailer->sendMail($messagePosted->message->item->email, 'emails.item_message',['posted_message' => $messagePosted->message]);
    }

    public function whenItemWasPosted($itemWasPosted) {
        $this->appMailer->sendMail($itemWasPosted->item->email, 'emails.new_item', ['item' => $itemWasPosted->item]);
    }


}