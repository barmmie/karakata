<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;
use Karakata\Services\IpRetriever;
use Karakata\User\Event\UserHasRegistered;
use Laracasts\Commander\Events\EventGenerator;

class User extends Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait, EventGenerator;

    const ADMIN_ROLE = 1, USER_ROLE = 2, SUPER_ADMIN_ROLE = 3;
    const BANNED_STATUS = 1, ACTIVE_STATUS = 2;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'phone',
        'last_ip_address',
        'confirmation_token',
        'role',
        'verified'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->status = static::ACTIVE_STATUS;
            $user->confirmation_token = str_random(30);
        });
    }

    public function items()
    {
        return $this->hasMany('Item')->orderBy('items.updated_at', 'desc');
    }

    public function favorites()
    {
        return $this->belongsToMany('Item');
    }

    public function messages()
    {
        return $this->hasManyThrough('Message', 'Item')->orderBy('messages.created_at', 'desc');
    }

    public function unreadMessages()
    {
        return $this->messages()->where('read_status', false);
    }

    public function scopeSearch($query, $searchKey)
    {
        $query = $query->where('full_name', 'LIKE', "%{$searchKey}%")
            ->orWhere('email', 'LIKE', "%{$searchKey}%")
            ->orWhere('phone', 'LIKE', "%{$searchKey}%");

        return $query;

    }

    public function scopeActiveOnly($query)
    {
        $query = $query->where('status', static::ACTIVE_STATUS);

        return $query;
    }

    public function scopeBannedOnly($query)
    {
        $query = $query->where('status', static::BANNED_STATUS);

        return $query;
    }

    public function scopeVerifiedOnly($query)
    {
        $query = $query->where('verified', true);

        return $query;
    }

    public function scopeAdminsOnly($query)
    {
        $query = $query->where('role', self::ADMIN_ROLE)
            ->orWhere('role', self::SUPER_ADMIN_ROLE);

        return $query;
    }

    public function scopeUnverifiedOnly($query)
    {
        $query = $query->where('verified', false);

        return $query;
    }

    public static function register($full_name, $email, $password, $phone)
    {
        $new_user = compact('full_name', 'email', 'phone');

        $instance = static::create($new_user + [
                'password' => Hash::make($password),
                'role' => static::USER_ROLE,
                'last_ip_address' => IpRetriever::get_ip()
            ]);

        $instance->raise(new UserHasRegistered($instance));

        return $instance;
    }

    public static function createAdmin($full_name, $email, $password, $superAdmin = false)
    {
        $new_user = compact('full_name', 'email', 'phone');

        $instance = static::create($new_user + [
                'password' => Hash::make($password),
                'verified' => true,
                'role' => $superAdmin ? static::SUPER_ADMIN_ROLE : static::ADMIN_ROLE,
                'last_ip_address' => IpRetriever::get_ip()
            ]);

        return $instance;
    }

    public function confirmEmail()
    {

        $this->verified = true;
        $this->confirmation_token = null;

        $this->save();
    }

    public function ban()
    {
        $this->status = static::BANNED_STATUS;
        $this->save();
    }

    public function activate()
    {
        $this->status = static::ACTIVE_STATUS;
        $this->save();
    }

    public function isVerified()
    {
        return (bool)$this->verified;
    }

    public function isBanned()
    {
        return $this->status == static::BANNED_STATUS;
    }

    public function isActive()
    {
        return $this->status == static::ACTIVE_STATUS;
    }

    public function  isAdmin()
    {
        return in_array($this->role, [static::ADMIN_ROLE, static::SUPER_ADMIN_ROLE]);

    }

    public function isSocial()
    {
        $is_social = false;

        if(!is_null($this->facebook_oauth_id) || !is_null($this->google_oauth_id))
        {
            $is_social = true;
        }

        return $is_social;
    }

    public function updateStripeCustomer($customer)
    {
        $this->is_stripe_customer = true;
        $this->expiry_month = $customer->sources->data[0]->exp_month;
        $this->expiry_year = $customer->sources->data[0]->exp_year;
        $this->last_four = $customer->sources->data[0]->last4;
        $this->card_type = $customer->sources->data[0]->brand;
        $this->stripe_customer_id = $customer->id;

        $this->save();
    }

	public function cardImage(){
		switch ($this->card_type) {
			case 'Mastercard':
				$image_url = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/MC.png';
				break;
			case 'Visa':
				$image_url = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/Visa.png';
				break;
			case 'Discovery':
				$image_url = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/Discover.png';
				break;
			case 'Amex':
				$image_url = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/Amex.png';
				break;
			default:
				$image_url = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/MC.png';
				break;
		}

		return $image_url;


	}

	public function rating()
	{
		$reviews = $this->reviews();
		$total_stars = $reviews->sum('rating');
		$total_review_count = $reviews->count();
		try {
			$average_rating = $total_stars/ $total_review_count;

		} catch(Exception $e) {
			$average_rating = 0;
		}

		return $average_rating;

	}

	public function reviews()
	{
		return $this->hasMany('Review', 'user_id');
	}

	public function authored_reviews()
	{
		return $this->hasMany('Review', 'author_id');
	}

	public function reviewed($userid) {
		return in_array($userid, $this->authored_reviews()->lists('user_id'));
	}
}
