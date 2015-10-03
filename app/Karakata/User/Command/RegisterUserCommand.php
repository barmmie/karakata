<?php namespace Karakata\User\Command;

class RegisterUserCommand
{

    /**
     * @var string
     */
    public $full_name;


    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $confirm_password;

    /**
     * @var string
     */
    public $phone;

    /**
     * @param string full_name
     * @param string email
     * @param string password
     * @param string password_confirmation
     * @param string phone_no
     */
    public function __construct($full_name, $email, $password, $confirm_password, $phone)
    {
        $this->full_name = $full_name;
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->phone = $phone;
    }

    public function rules()
    {
        return [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email'
        ];
    }

}