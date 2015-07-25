<?php

class Item extends \Eloquent {

    protected $softDeletes = true;
    const PENDING_STATUS = 1, REJECTED_STATUS = 2, VERIFIED_STATUS = 3, SOLD_STATUS = 4;
	protected $fillable = ['title', 'description', 'category_id', 'email', 'phone', 'seller_name', 'location_id', 'negotiable', 'type', 'amount', 'status', 'slug'];



    public static function boot() {
        parent::boot();

        static::creating(function($item){
            $item->slug = Str::slug($item->title, '-');
            $item->user_id = Auth::id();
        });
    }

    public function location() {
        return $this->belongsTo('Location');
    }


    public function likers() {
        return $this->belongsToMany('User');
    }

    public static function post($category_id, $type, $title, $description, $amount, $negotiable, $location_id, $email, $phone, $sellerName) {
        return static::create(
                ['title' => $title ,
                'description' => $description,
                'category_id' => $category_id,
                'location_id' => $location_id,
                'type' => $type,
                'amount' => $amount,
                'negotiable' => $negotiable,
                'email' => $email,
                'phone' => $phone,
                'seller_name' => $sellerName,
                'status' => static::PENDING_STATUS]
                );
    }
}