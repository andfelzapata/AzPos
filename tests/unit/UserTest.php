<?php

use App\AzPos\Domain\UserModel\EloquentUser;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->user = new EloquentUser;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserAccountActive()
    {
        $this->assertTrue(true);
    }
}
