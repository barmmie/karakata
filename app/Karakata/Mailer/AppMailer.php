<?php namespace Karakata\Mailer;

use Setting;
use Illuminate\Mail\Mailer;

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/20/15
 * Time: 11:35 AM
 */
class AppMailer
{

    protected $to;
    protected $view;
    protected $data = [];
    protected  $subject;
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail($to, $view, $data, $subject)
    {
        $this->to = $to;

        $this->view = $view;

        $this->data = $data;
        $this->subject = $subject;

        $this->deliver();
    }

    protected function deliver()
    {
        $this->mailer->send($this->view, $this->data, function ($message) {
            $message->from(Setting::get('admin_email', 'admin@karakata'), Setting::get('admin_email_from', 'Administrator'))
                ->to($this->to)
                ->subject($this->subject);
        });
    }

    public function sendConfirmationMail(\User $user)
    {
        $this->to = $user->email;

        $this->view = 'emails.confirm';
        $this->subject = trans('phrases.confirmation_email');
        $this->data = compact('user');

        $this->deliver();
    }
}