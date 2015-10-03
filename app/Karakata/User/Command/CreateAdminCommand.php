<?php namespace Karakata\User\Command;

class CreateAdminCommand
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
     * @param string full_name
     * @param string email
     * @param string password
     * @param string password_confirmation
     * @param string phone_no
     */
    public function __construct($full_name, $email, $password)
    {
        $this->full_name = $full_name;
        $this->email = $email;
        $this->password = $password;

    }

    public function rules()
    {
        return [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email'
        ];
    }

}