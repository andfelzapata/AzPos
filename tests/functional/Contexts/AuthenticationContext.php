<?php

namespace Contexts;

use PHPUnit_Framework_Assert as PHPUnit;

use LaravelApplication;
use App\AzPos\Domain\UserModel\EloquentUser;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Gherkin\Node\PyStringNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Tester\Exception\PendingException;

use Laracasts\Behat\Context\Migrator;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class AuthenticationContext extends MinkContext implements Context
{
    /**
     * Laravel testing framework traits
     */
    use LaravelApplication, DatabaseTransactions, Migrator, WithoutMiddleware;

    /**
     *
     * @var \App\AzPos\Domain\UserModel\EloquentUser
     */
    protected $user;

    /**
     * Request headers
     *
     * @var array
     */
    protected $headers = ['Accept' => 'application/json'];

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->app = app();
    }

    /**
     * @param $user
     * @param $password
     *
     * @Given there is an user :user with password :password
     */
    public function thereIsAnUserWithPassword($user, $password)
    {
        $password = bcrypt($password);
        $this->user = factory(EloquentUser::class)->create(['username' => 'jonsnow', 'password' => $password]);

        PHPUnit::assertEquals($user, $this->user->username);
        PHPUnit::assertEquals($password, $this->user->password);
    }

    /**
     * @Given I am on the login page
     */
    public function iAmOnTheLoginPage()
    {
        $response = $this->call('GET', '/');
        PHPUnit::assertEquals(200, $response->getStatusCode());
    }

    /**
     * @param $username
     * @param $password
     *
     * @When I try to login with username :username and password :password
     */
    public function iTryToLoginWithUsernameAndPassword($username, $password)
    {
        $this->response = $this->call('POST', '/login', ['username' => 'jonsnow', 'password' => $password]);
        PHPUnit::assertNotContains($this->response->getStatusCode(), [500, 404]);
    }

    /**
     * @Then I should be redirected to the dash
     */
    public function iShouldBeRedirectedToTheDash()
    {
        $this->assertRedirectedTo('dashboard');
    }

    /**
     * @Then I should be authenticated
     */
    public function iShouldBeAuthenticated()
    {
        $this->seeIsAuthenticated();
    }

    /**
     * @Then I should not be authenticated
     */
    public function iShouldNotBeAuthenticated()
    {
        $this->dontSeeIsAuthenticated();
    }

    /**
     * @When I try to login with empty username and password
     */
    public function iTryToLoginWithEmptyUsernameAndPassword()
    {
        $this->post( '/login', ['username' => '', 'password' => ''], $this->headers);
    }

    /**
     * @Then I should see a validation error
     */
    public function iShouldSeeAValidationError()
    {
        $this->seeText('required');
    }

    /**
     * @Then the status code should be :arg1
     */
    public function theStatusCodeShouldBe($arg1)
    {
        $this->seeStatusCode(422);
    }

}
