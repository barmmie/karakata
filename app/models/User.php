<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Enclassified\User\Event\UserHasRegistered;
use Laracasts\Commander\Events\EventGenerator;
use Enclassified\Services\IpRetriever;

class User extends Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait, EventGenerator;

    const ADMIN_ROLE = 1, USER_ROLE = 2;
    const BANNED_STATUS = 1, ACTIVE_STATUS = 2;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = ['full_name', 'email', 'password', 'phone', 'last_ip_address', 'confirmation_token', 'role'];

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
        $query =  $query->where('full_name', 'LIKE', "%{$searchKey}%")
                        ->orWhere('email', 'LIKE', "%{$searchKey}%")
                        ->orWhere('phone', 'LIKE', "%{$searchKey}%");

        return $query;

    }

    public function scopeActiveOnly($query)
    {
        $query =  $query->where('status', static::ACTIVE_STATUS);

        return $query;
    }

    public function scopeBannedOnly($query)
    {
        $query =  $query->where('status', static::BANNED_STATUS);

        return $query;
    }

    public function scopeVerifiedOnly($query)
    {
        $query =  $query->where('verified', true);

        return $query;
    }

    public function scopeUnverifiedOnly($query)
    {
        $query =  $query->where('verified', false);

        return $query;
    }

    public static function register($full_name, $email, $password, $phone)
    {
        $new_user = compact('full_name', 'email', 'phone');

        $instance = static::create($new_user + [
                'password' => Hash::make('password'),
                'role' => static::USER_ROLE,
                'last_ip_address' => IpRetriever::get_ip()
            ]);

        $instance->raise(new UserHasRegistered($instance));
        return $instance;
    }

    public function confirmEmail()
    {

        $this->verified = true;
        $this->confirmation_token = null;

        $this->save();
    }

    public function ban() {
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
        return $this->role == static::ADMIN_ROLE;

    }
}
