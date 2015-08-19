<?php

use Carbon\Carbon;


class Item extends \Eloquent
{

use \Laracasts\Commander\Events\EventGenerator;

    protected $softDeletes = true;
    const PENDING_STATUS = 1, REJECTED_STATUS = 2, APPROVED_STATUS = 3, SOLD_STATUS = 4;
    protected $fillable = ['title', 'description', 'category_id', 'email', 'phone', 'seller_name', 'location_id', 'negotiable', 'type', 'amount', 'status', 'slug', 'user_id'];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($item) {

            $item->status = self::PENDING_STATUS;
            $item->ip_address = \Enclassified\Services\IpRetriever::get_ip();

        });

        static::updating(function($item){
            $item->slug = $item->id . '-' . Str::slug($item->title, '-');
//            $item->status = self::PENDING_STATUS;
            $item->ip_address = \Enclassified\Services\IpRetriever::get_ip();
        });

        static::created(function($item){

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

    public function picture()
    {
        return $this->hasOne('Picture');
    }

    public function favoriters()
    {
        return $this->belongsToMany('User');
    }

    public function owner() {

        return $this->belongsTo('User', 'user_id');
    }

    public function reports() {
        return $this->hasMany(Report::class);
    }

    public function mainThumbnail()
    {

        return $this->picture ? $this->picture->thumbnail_src : 'images/no-image-default-thumb.jpg';
    }

    public function isApproved()
    {
        return (bool)($this->status == self::APPROVED_STATUS);
    }

    public function isPending()
    {
        return (bool)($this->status == self::PENDING_STATUS);
    }

    public function isRejected()
    {
        return (bool)($this->status == self::REJECTED_STATUS);
    }

    public function isSold()
    {
        return (bool)($this->status == self::SOLD_STATUS);
    }


    public function scopeSearch($query, $searchKey) {
        $searchKey = removeCommonWords(strtolower($searchKey));
        $searchKeys = explode(' ', $searchKey);

        $query =  $query->where('title', 'LIKE', "%{$searchKey}%");

//        foreach($searchKeys as $index => $key) {
//            if($index == 0) {
//                $query =  $query->where('title', 'LIKE', "%{$key}%");
//
//            }else {
//                $query =  $query->orWhere('title', 'LIKE', "%{$key}%");
//
//            }
//
//            $query = $query->orWhere('description', 'LIKE', "%{$key}%");
//
//        }

        return $query;
    }

    public function scopeLatest($query, $limit = 3) {
        return $query->approved()
                    ->with('picture')
                    ->with('location')
                    ->limit($limit)
                    ->orderBy('created_at', 'desc');
    }

    public function scopeFeatured($query, $limit = 3, $exclude = [])
    {
        $query = $query->whereRaw('RAND()<(SELECT ((?/COUNT(*))*10) FROM `items`)', [$limit])
                        ->orderByRaw('RAND()')
                        ->with('pictures')
                        ->with('picture')
                        ->with('location')
                        ->approved()
                        ->where('created_at', '>=', Carbon::now()->subMonths(6) )
                        ->limit($limit);
        if (!empty($exclude)) {
            $query = $query->whereNotIn('id', $exclude);
        }
        return $query;
    }

    public function scopeApprovedOnly($query){
        return $query->where('status', self::APPROVED_STATUS);
    }

    public function scopePendingOnly($query){
        return $query->where('status', self::PENDING_STATUS);
    }

    public function scopeRejectedOnly($query){
        return $query->where('status', self::REJECTED_STATUS);
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




    public static function post($category_id, $type, $title, $description, $amount, $negotiable, $location_id, $email, $phone, $sellerName)
    {
        $instance =  static::create(
            ['title' => $title,
                'description' => e($description),
                'category_id' => $category_id,
                'location_id' => $location_id,
                'type' => $type,
                'amount' =>  $amount,
                'negotiable' => $negotiable,
                'email' => $email,
                'phone' => $phone,
                'seller_name' => $sellerName,
                'user_id' => Auth::user()->id
            ]
        );

        $instance->raise(new \Enclassified\Item\Event\ItemWasPosted($instance));

        return $instance;
    }

    public function approve() {
        $this->status = self::APPROVED_STATUS;
        $this->save();
    }

    public function reject() {
        $this->status = self::REJECTED_STATUS;
        $this->save();
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