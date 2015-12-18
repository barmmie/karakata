<?php namespace Karakata\Item\Command;


class UpdateItemCommand
{

    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $category_id;

    /**
     * @var string
     */
    public $location_id;

    /**
     * @var string
     */
    public $amount;

    /**
     * @var string
     */
    public $negotiable;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $seller_name;
    /**
     * @var string
     */
    public $pictures_id;
    /**
     * @var string
     */
    public $fallback;
    /**
     * @var string
     */
    public $uploaded_files;
    /**
     * @var string
     */
    public $keywords;

    /**
     * @param string title
     * @param string description
     * @param string type
     * @param string category_id
     * @param string location_id
     * @param string amount
     * @param string negotiable
     * @param string email
     * @param string phone
     * @param string seller_name
     * @param string pictures_id
     * @param boolean multipart_upload
     * @param boolean file
     */
    public function __construct(
        $id,
        $title,
        $description,
        $type,
        $category_id,
        $location_id,
        $amount,
        $negotiable,
        $email,
        $phone,
        $seller_name,
        $pictures_id = [],
        $multipart_upload = false,
        $files = null,
        $keywords
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
        $this->category_id = $category_id;
        $this->location_id = $location_id;
        $this->amount = $amount;
        $this->negotiable = (bool)$negotiable;
        $this->multipart_upload = (bool)$multipart_upload;
        $this->email = $email;
        $this->phone = $phone;
        $this->seller_name = $seller_name;
        $this->pictures_id = $pictures_id;
        $this->uploaded_files = $files;
        $this->keywords = $keywords;

    }

    public function rules()
    {
        return [
            'category_id' => 'required',
            'title' => 'required|min:10',
            'description' => 'required|min:10',
            'type' => 'required|in:personal,business',
            'location_id' => 'required',
            'amount' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'seller_name' => 'required',
        ];
    }

}