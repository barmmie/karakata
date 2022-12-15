<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/21/15
 * Time: 12:41 AM
 */

namespace Karakata\Listeners;

use Setting;
use Karakata\Mailer\AppMailer;
use Laracasts\Commander\Events\EventListener;

class EmailNotifier extends EventListener
{
    protected $appMailer;

    public function __construct(AppMailer $appMailer)
    {
        $this->appMailer = $appMailer;
    }


    public function whenUserHasRegistered($userHasRegistered)
    {
        if(Setting::get('require_email_confirmation', '1') == '1') {
            $this->appMailer->sendConfirmationMail($userHasRegistered->user);
        }
    }

    public function whenMessageHasBeenPosted($messagePosted)
    {

        $this->appMailer->sendMail($messagePosted->message->item->email, 'emails.item_message',
            ['posted_message' => $messagePosted->message], trans('phrases.item_received_message'));
    }

    public function whenItemWasPosted($itemWasPosted)
    {
        if(Setting::get('require_item_verification', '1') == '1') {
            $this->appMailer->sendMail($itemWasPosted->item->email, 'emails.new_item', ['item' => $itemWasPosted->item],
                trans('phrases.item_was_posted'));
        }
    }

	public function whenItemWasReviewed($itemWasReviewed)
    {
            $this->appMailer->sendMail($itemWasReviewed->review->user->email, 'emails.new_review', ['review' => $itemWasReviewed->review],
                trans('phrases.item_was_reviewed'));
    }


}