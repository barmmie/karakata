<?php namespace Karakata\Mailer;

use Setting;
use Config;
use View;
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
    protected $subject;
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

        return $this->deliver();
    }

    protected function deliver()
    {

        try {
            if(Config::get('mail.driver') == 'mail') {
                $from_email = Setting::get('admin_email', 'admin@karakata.com');
                $from_name = Setting::get('admin_email_from', 'Karakata admin');

                $headers   = array();
                $headers[] = "MIME-Version: 1.0";
                $headers[] = "Content-type: text/html; charset=iso-8859-1";
                $headers[] = "From:  $from_name <$from_email>";
                $headers[] = "Reply-To: $from_name <$from_email>";
                $headers[] = "Subject: {$this->subject}";
                $headers[] = "X-Mailer: PHP/".phpversion();

                $email = View::make($this->view, $this->data)->render();

                return mail($this->to, $this->subject, $email, implode("\r\n", $headers));
            } else {
                return $this->mailer->send($this->view, $this->data, function ($message) {
                    $message->from(Setting::get('admin_email', 'admin@karakata'), Setting::get('admin_email_from', 'Administrator'))
                        ->to($this->to)
                        ->subject($this->subject);
                });
            }
        } catch(Exception $ex) {
            return false;
        }





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