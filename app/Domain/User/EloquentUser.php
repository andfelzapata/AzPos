<?php

namespace App\Domain\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EloquentUser extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'phone', 'password', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Checks to see if user account is active.
     *
     * @param $username
     *
     * @return bool
     */
    public function accountActive($username)
    {
        return  $this->where('username', $username)->orWhere('email', $username)->first()->active ? true : false;
    }

    /**
     * Checks to see if account exists.
     * @param $username
     *
     * @return bool
     */
    public function userNameExists($username)
    {
        return  $this->where('username', $username)->orWhere('email', $username)->first() ? true : false;
    }
}
