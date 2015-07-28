<?php

class Item extends \Eloquent
{

    protected $softDeletes = true;
    const PENDING_STATUS = 1, REJECTED_STATUS = 2, APPROVED_STATUS = 3, SOLD_STATUS = 4;
    protected $fillable = ['title', 'description', 'category_id', 'email', 'phone', 'seller_name', 'location_id', 'negotiable', 'type', 'amount', 'status', 'slug'];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->status = static::PENDING_STATUS;
            $item->user_id = Auth::id();
        });

        static::saved(function ($item) {
            $item->slug = $item->id . '-' . Str::slug($item->title, '-');
            $item->save();
        });
    }

    public function location()
    {
        return $this->belongsTo('Location');
    }

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function pictures()
    {
        return $this->hasMany('Picture');
    }

    public function mainThumbnail()
    {

        return count($this->pictures) ? $this->pictures->first()->thumbnail_src : 'images/item/tp/Image00002.jpg';
    }

    public function isApproved()
    {
        return (int)$this->status === self::APPROVED_STATUS;
    }

    public function isPending()
    {
        return (int)$this->status === self::PENDING_STATUS;
    }

    public function isRejected()
    {
        return (int)$this->status === self::REJECTED_STATUS;
    }

    public function isSold()
    {
        return (int)$this->status === self::SOLD_STATUS;
    }


    public function scopeSearch($query, $searchKey) {
        return $query->where('title', 'LIKE', "%{$searchKey}%")
                    ->orWhere('description', 'LIKE', "%{$searchKey}%");
    }


    public function scopeFiltered($query, $input)
    {
        if (array_key_exists('location_id', $input) && !in_array($input['location_id'], ['', 'any', 'all', '00'])) {
            $query = $query->where('location_id', $input['location_id']);
        }

        if (array_key_exists('price_sort', $input) && in_array($input['price_sort'], ['asc', 'desc'])) {
            $query = $query->orderBy('amount', $input['price_sort']);
        }

        return $query;
    }


    public function likers()
    {
        return $this->belongsToMany('User');
    }

    public static function post($category_id, $type, $title, $description, $amount, $negotiable, $location_id, $email, $phone, $sellerName)
    {
        return static::create(
            ['title' => $title,
                'description' => $description,
                'category_id' => $category_id,
                'location_id' => $location_id,
                'type' => $type,
                'amount' => $amount,
                'negotiable' => $negotiable,
                'email' => $email,
                'phone' => $phone,
                'seller_name' => $sellerName]
        );
    }

    public function attachPictures($picture_ids)
    {
        return DB::table('pictures')
            ->whereIn('id', $picture_ids)
            ->update(['item_id' => $this->id]);
    }

    public static function findByUserOrFail($id, $user_id = null)
    {
        $user_id = $user_id ?: Auth::id();
    }
}