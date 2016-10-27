<?php

namespace Tests\Functional\Traits;


use Illuminate\Support\Facades\Artisan;

trait DatabaseMigration
{
    /**
     * Migrate the database before each scenario.
     *
     * @beforeScenario
     */
    public function migrate()
    {
        Artisan::call('migrate');
        Artisan::call('migrate', ['--path' => '/database/migrations/users']);
    }
}