<?php namespace Enclassified\Mailer;
use Illuminate\Mail\Mailer;

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/20/15
 * Time: 11:35 AM
 */

class AppMailer {

    private $mailer;

    protected $from = 'admin@enclassified.com';

    protected $to;

    protected $view;

    protected $data = [];

    public function __construct(Mailer $mailer){
        $this->mailer = $mailer;
    }

    public function sendConfirmationMail(\User $user) {
        $this->to = $user->email;

        $this->view = 'emails.confirm';

        $this->data = compact('user');

        $this->deliver();
    }

    protected function deliver() {
        $this->mailer->send($this->view, $this->data, function($message){
            $message->from($this->from, 'Administrator')
                    ->to($this->to);
        });
    }
}