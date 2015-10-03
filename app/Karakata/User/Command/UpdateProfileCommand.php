<?php namespace Karakata\User\Command;

class UpdateProfileCommand
{

    /**
     * @var string
     */
    public $full_name;

    /**
     * @var string
     */
    public $phone;

    /**
     * @param string full_name
     * @param string phone
     */
    public function __construct($full_name, $phone)
    {
        $this->full_name = $full_name;
        $this->phone = $phone;
    }

    public function rules()
    {
        return [
            'full_name' => 'required',
            'phone' => 'required'
        ];
    }

}