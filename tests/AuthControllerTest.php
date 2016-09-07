<?php

use App\AzPos\Domain\UserModel\EloquentUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Test successful login using username.
     *
     * @return void
     */
    public function testSuccessfulLoginWithUsername()
    {
        $credentials = ['username' => 'lauraazapataa', 'password' => '1q2w3e4r'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertEquals(200, $response->status());

        Auth::logout();

    }

    public function testSuccessfulLoginWithEmail()
    {
        $credentials = ['username' => 'lauraazapataa@gmail.com', 'password' => '1q2w3e4r'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertEquals(200, $response->status());

        Auth::logout();
    }

    /**
     * Test login with username that does not exist returns 401 status code.
     */
    public function testUsernameDoesNotExistReturnsStatusCode401()
    {
        $credentials = ['username' => 'doesnotexist', 'password' => '1q2w3e4r'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertEquals(401, $response->status());
    }

    /**
     * Test login with username that does not exist returns proper response error text.
     */
    public function testUsernameDoestNotExistReturnsProperText()
    {
        $credentials = ['username' => 'doesnotexist', 'password' => '1q2w3e4r'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertContains("Username does not exist", $response->content());
    }

    /**
     * Test correct response when account is inactive.
     */
    public function testAccountIsInactiveReturnsStatusCode401()
    {
        $this->makeUserInactive();

        $credentials = ['username' => 'lauraazapataa', 'password' => '1q2w3e4r'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertContains("Account is inactive", $response->content());

        $this->makeUserActive();
    }

    public function testAccountIsInactiveReturnsProperText()
    {
        $this->makeUserInactive();

        $credentials = ['username' => 'lauraazapataa', 'password' => '1q2w3e4r'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertEquals('401', $response->status());

        $this->makeUserActive();
    }

    /**
     * Take first user and make inactive.
     */
    private function makeUserInactive()
    {
        $user = EloquentUser::first();
        $user->active = 0;
        $user->save();
    }

    /**
     * Take first user and make active.
     */
    private function makeUserActive()
    {
        $user = EloquentUser::first();
        $user->active = 1;
        $user->save();
    }
}
