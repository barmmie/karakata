<?php namespace Karakata\Report\Command;

class ReportItemCommand
{

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $item_id;

    /**
     * @param string content
     * @param string item_id
     */
    public function __construct($content, $item_id)
    {
        $this->content = $content;
        $this->item_id = $item_id;
    }

    public function rules()
    {
        return [
            'content' => 'required',
            'item_id' => 'required',
            'test' => 'true'
        ];
    }

}