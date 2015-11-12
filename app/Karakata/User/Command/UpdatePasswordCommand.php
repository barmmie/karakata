<?php namespace Karakata\User\Command;

class UpdatePasswordCommand
{

    /**
     * @var string
     */
    public $current_password;

    /**
     * @var string
     */
    public $new_password;

    /**
     * @var string
     */
    public $confirm_new_password;

    /**
     * @param string current_password
     * @param string new_password
     * @param string confirm_new_password
     */
    public function __construct($current_password, $new_password, $confirm_new_password)
    {
        $this->current_password = $current_password;
        $this->new_password = $new_password;
        $this->confirm_new_password = $confirm_new_password;
    }

    public function rules()
    {
        return [
//            'current_password' => '',
            'new_password' => 'required',
            'confirm_new_password' => 'required'
        ];
    }

}