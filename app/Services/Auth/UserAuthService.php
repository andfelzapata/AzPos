<?php

namespace App\Services\Auth;

use App\Domain\User\EloquentUser;
use App\Services\Contracts\UserAuthServiceInterface;

class UserAuthService implements UserAuthServiceInterface
{
    /**
     * @var EloquentUser
     */
    private $user;

    /**
     * UserAuthService constructor.
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
     * @param string $username
     * @return bool
     */
    public function accountActive(string $username): bool
    {
        return $this->user->accountActive($username);
    }

    /**
     * Check if username exists.
     *
     * @param string $username
     * @return bool
     */
    public function usernameExists(string $username): bool
    {
        return $this->user->usernameExists($username);
    }

}