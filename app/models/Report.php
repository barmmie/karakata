<?php

class Report extends \Eloquent {

    use \Laracasts\Commander\Events\EventGenerator;
	protected $fillable = ['message', 'item_id', 'ip_address', 'read_status'];


    public static function post($content, $item_id){
        $instance = static::create(
            [
                'message' => e($content),
                'item_id' => $item_id,
//                'ip_address' => \Enclassified\Services\IpRetriever::get_ip(),
                'read_status' => false
            ]
        );

        $instance->raise(new \Enclassified\Report\Event\ReportHasBeenRaised($instance));
        return $instance;
    }
}