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

    const ADMIN_ROLE = 1;
    const USER_ROLE = 2;

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
            $user->confirmation_token = str_random(30);
        });
    }


    public function items()
    {
        return $this->hasMany('Item');
    }

    public function likedItems()
    {
        return $this->belongsToMany('Item');
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

    public function isVerified()
    {

        return $this->verified === '1';
    }
}
