<?php

class Report extends \Eloquent
{

    use \Laracasts\Commander\Events\EventGenerator;
    protected $fillable = ['message', 'item_id', 'ip_address', 'read_status'];


    public static function post($content, $item_id)
    {
        $instance = static::create(
            [
                'message' => e($content),
                'item_id' => $item_id,
//                'ip_address' => \Karakata\Services\IpRetriever::get_ip(),
                'read_status' => false
            ]
        );

        $instance->raise(new \Karakata\Report\Event\ReportHasBeenRaised($instance));

        return $instance;
    }

    public function item()
    {
        return $this->belongsTo('Item');
    }

    public function scopeReadOnly($query)
    {
        return $query->where('read_status', true);
    }

    public function scopeUnreadOnly($query)
    {
        return $query->where('read_status', false);
    }

    public function markAsRead()
    {
        $this->read_status = true;
        $this->save();
    }

    public function markAsUnread()
    {
        $this->read_status = false;
        $this->save();
    }

    public function isReviewed()
    {
        return $this->read_status == true;

    }

    public function isUnreviewed()
    {
        return $this->read_status == false;
    }
}