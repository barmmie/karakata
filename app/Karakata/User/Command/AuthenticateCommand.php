<?php namespace Karakata\User\Command;

class AuthenticateCommand
{

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @param string email
     * @param string password
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

}