<?php

namespace App\AzPos\Domain\Services;

use App\AzPos\Domain\UserModel\EloquentUser;

class UserAuthService
{

    /**
    * UsersServices constructor.
    *
    * @param EloquentUser $user
    */
    public function __construct(EloquentUser $user)
    {
        $this->user = $user;
    }

    /**
    * Check if account is active.
    *
    * @param $username
    *
    * @return bool
    */
    public function accountActive($username)
    {
        return $this->user->accountActive($username);
    }

    /**
    * Check if username exists.
    *
    * @param $username
    *
    * @return bool
    */
    public function usernameExists($username)
    {
        return $this->user->usernameExists($username);
    }

}