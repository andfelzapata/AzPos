<?php

use App\AzPos\Domain\UserModel\EloquentUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Test successful login using username.
     */
    public function testSuccessfulLoginWithUsername()
    {
        factory(EloquentUser::class)->create(['username' => 'jonsnow']);

        $credentials = ['username' => 'jonsnow', 'password' => '1q2w3e4r'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertEquals(200, $response->status());

    }

    /**
     * Test successful login using email.
     */
    public function testSuccessfulLoginWithEmail()
    {
        factory(EloquentUser::class)->create( ['email' => 'jonsnow@winterfell.north'] );

        $credentials = ['username' => 'jonsnow@winterfell.north', 'password' => '1q2w3e4r'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertEquals(200, $response->status());

    }

    /**
     * Test login with username that does not exist returns 401 status code.
     */
    public function testUsernameDoesNotExistReturnsStatusCode401()
    {
        factory(EloquentUser::class)->create(['username' => 'kinginthenorth']);

        $credentials = ['username' => 'robbstark', 'password' => '1q2w3e4r'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertEquals(401, $response->status());
    }

    /**
     * Test login with username that does not exist returns proper response error text.
     */
    public function testUsernameDoestNotExistReturnsProperText()
    {
        factory(EloquentUser::class)->create(['username' => 'nedstark']);

        $credentials = ['username' => 'dead', 'password' => '1q2w3e4r'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertContains("Username does not exist", $response->content());
    }

    /**
     * Test correct response text is returned when accoutn is inactive.
     */
    public function testAccountIsInactiveReturnsProperText()
    {
        factory(EloquentUser::class)->create(['username' => 'varys', 'active' => 0]);

        $credentials = ['username' => 'varys', 'password' => '1q2w3e4r'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertContains("Account is inactive", $response->content());
    }

    /**
     * Test correct response when account is inactive
     */
    public function testAccountIsInactiveReturnsStatusCode401()
    {
        factory(EloquentUser::class)->create(['username' => 'varys', 'active' => 0]);

        $credentials = ['username' => 'varys', 'password' => '1q2w3e4r'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertEquals('401', $response->status());
    }

    /**
     * Test user login fails with wrong password, correct username
     */
    public function testLoginFailsWithCorrectUsernameWrongPasswordReturns401Status()
    {
        factory(EloquentUser::class)->create(['username' => 'viserys', 'password' => bcrypt('notadragon') ]);

        $credentials = ['username' => 'viserys', 'password' => 'dragon'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertEquals('401', $response->status());
    }

    /**
     *  Test user login fail with wrong password, correct username returns correct text.*
     */
    public function testLoginFailsWithCorrectUsernameWrongPasswordReturnsProperText()
    {
        factory(EloquentUser::class)->create(['username' => 'joffrey', 'password' => bcrypt('baratheon') ]);

        $credentials = ['username' => 'joffrey', 'password' => 'lannister'];

        $response = $this->call('POST', 'login', $credentials);

        $this->assertContains("Credentials do not match our records", $response->content());
    }

}
