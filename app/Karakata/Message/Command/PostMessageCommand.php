<?php namespace Karakata\Message\Command;

class PostMessageCommand
{

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $item_id;

    /**
     * @param string email
     * @param string name
     * @param string content
     * @param string item_id
     */
    public function __construct($email, $name, $content, $item_id)
    {
        $this->email = $email;
        $this->name = $name;
        $this->content = $content;
        $this->item_id = $item_id;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'content' => 'required'
        ];
    }

}