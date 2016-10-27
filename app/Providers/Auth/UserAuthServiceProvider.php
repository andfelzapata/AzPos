<?php

namespace App\Providers\Auth;

use Illuminate\Support\ServiceProvider;

use App\Services\Auth\UserAuthService;
use App\Services\Contracts\UserAuthServiceInterface;

class UserAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserAuthServiceInterface::class, UserAuthService::class);
    }
}
