<?php

use Carbon\Carbon;


class Item extends \Eloquent
{

    use \Laracasts\Commander\Events\EventGenerator;

    const PENDING_STATUS = 1, REJECTED_STATUS = 2, APPROVED_STATUS = 3, SOLD_STATUS = 4;
    protected $softDeletes = true;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'email',
        'phone',
        'seller_name',
        'location_id',
        'negotiable',
        'type',
        'amount',
        'status',
        'slug',
        'user_id'
    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->description = Purifier::clean($item->description);
            $item->ip_address = \Karakata\Services\IpRetriever::get_ip();

        });

        static::updating(function ($item) {
            $item->slug = $item->id . '-' . Str::slug($item->title, '-');
//            $item->status = self::PENDING_STATUS;
//            $item->ip_address = \Karakata\Services\IpRetriever::get_ip();
        });

        static::created(function ($item) {

            $item->slug = $item->id . '-' . Str::slug($item->title, '-');
            $item->save();

        });

        static::deleting(function ($item) {
          $item->pictures()->delete();
        });

    }



    public function getDescriptionAttribute($value)
    {

        if($value) {
            $doc = new DOMDocument();
            $doc->recover = true;
            $doc->loadHTML(mb_convert_encoding($value, 'HTML-ENTITIES', 'UTF-8'));
            $doc->normalizeDocument();
            $clean = $doc->saveHTML();

            return $clean;
        } else {
            return $value;
        }
    }


    public static function post(
        $category_id,
        $type,
        $title,
        $description,
        $amount,
        $negotiable,
        $location_id,
        $email,
        $phone,
        $sellerName,
        $keywords
    ) {
        $instance = static::create(
            [
                'title' => $title,
                'description' => $description,
                'category_id' => $category_id,
                'location_id' => $location_id,
                'type' => $type,
                'amount' => $amount,
                'negotiable' => $negotiable,
                'email' => $email,
                'phone' => $phone,
                'seller_name' => $sellerName,
                'keywords' => $keywords,
                'status' => self::PENDING_STATUS,
                'user_id' => Auth::user()->id
            ]
        );

        $instance->raise(new \Karakata\Item\Event\ItemWasPosted($instance));

        return $instance;
    }

    public static function findByUserOrFail($id, $user_id = null)
    {
        $user_id = $user_id ?: Auth::id();
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

    public function owner()
    {

        return $this->belongsTo('User', 'user_id');
    }

    public function reports()
    {
        return $this->hasMany('Report');
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

    public function scopeSearch($query, $searchKey)
    {
        $searchKey = removeCommonWords(strtolower($searchKey));
        $searchKeys = explode(' ', $searchKey);

        $query = $query->where('title', 'LIKE', "%{$searchKey}%")
                        ->orWhere('keywords', 'LIKE', "%{$searchKey}%");

        return $query->orderBy('created_at', 'desc');
    }

    public function scopeLatest($query, $limit = 3)
    {
        return $query->approved()
            ->with('picture')
            ->with('location')
            ->limit($limit)
            ->orderBy('created_at', 'desc');
    }

    public function scopeFeatured($query, $limit = 3, $exclude = [])
    {
        $query = $query->premiumOnly()
            //whereRaw('RAND()<(SELECT ((?/COUNT(*))*10) FROM `items`)', [$limit])
            ->orderByRaw('RAND()')
            ->with('pictures')
            ->with('picture')
            ->with('location')
            ->approved()
            ->limit($limit);
        if (!empty($exclude)) {
            $query = $query->whereNotIn('id', $exclude);
        }

        return $query;
    }

    public function scopeApprovedOnly($query)
    {
        return $query->where('status', self::APPROVED_STATUS);
    }

    public function scopePremiumOnly($query)
    {
        return $query->where('premium_until', '>', Carbon::now());
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::APPROVED_STATUS);
    }

    public function scopePendingOnly($query)
    {
        return $query->where('status', self::PENDING_STATUS);
    }

    public function scopeRejectedOnly($query)
    {
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

    public function approve()
    {
        $this->status = self::APPROVED_STATUS;
        $this->save();
    }

    public function reject()
    {
        $this->status = self::REJECTED_STATUS;
        $this->save();
    }

    public function attachPictures($picture_ids)
    {
        return DB::table('pictures')
            ->whereIn('id', $picture_ids)
            ->update(['item_id' => $this->id]);
    }

    public function isPremium()
    {
        return (bool)(!is_null($this->premium_until)) && (Carbon::parse($this->premium_until)->diffInDays() < Setting::get('premium_days',
                40));
    }

    public function markAsPremium()
    {
        $this->status = self::APPROVED_STATUS;
        $this->premium_until = Carbon::now()->addDays(Setting::get('premium_days', 40));
        $this->save();
    }
}