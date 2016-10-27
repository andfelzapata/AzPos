<?php

namespace App\Services\Contracts;

use App\Domain\User\EloquentUser;


interface UserAuthServiceInterface
{
    /**
     * UserAuthServiceInterface constructor.
     *
     * @param EloquentUser $user
     */
    public function __construct(EloquentUser $user);

    /**
     * Check if account is active.
     *
     * @param string $username
     * @return bool
     */
    public function accountActive(string $username): bool;

    /**
     * Check if username exists.
     *
     * @param string $username
     * @return bool
     */
    public function usernameExists(string $username): bool;
}