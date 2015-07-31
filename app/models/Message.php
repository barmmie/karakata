<?php

class Message extends \Eloquent {

    use \Laracasts\Commander\Events\EventGenerator;


	protected $fillable = ['item_id', 'name', 'email', 'content', 'ip_address', 'read_status'];

    public function item() {

        return $this->belongsTo('Item');
    }

    public static function post($sender_name, $sender_email, $content, $item_id) {
        $instance = static::create(
            [
                'name' => $sender_name,
                'email' => $sender_email,
                'content' => e($content),
                'item_id' => $item_id,
                'ip_address' => \Enclassified\Services\IpRetriever::get_ip(),
                'read_status' => false

            ]
        );

        $instance->raise(new \Enclassified\Message\Event\MessageHasBeenPosted($instance));
        return $instance;
    }

}