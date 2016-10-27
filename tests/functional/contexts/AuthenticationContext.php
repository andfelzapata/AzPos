<?php

namespace Contexts;

use App\Domain\User\EloquentUser;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Gherkin\Node\PyStringNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Tester\Exception\PendingException;

use Laracasts\Behat\Context\Migrator;
use PHPUnit_Framework_Assert as PHPUnit;
use Tests\Functional\Traits\LaravelApplication;
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
     * @var \App\Domain\User\EloquentUser
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
        $this->user = factory(EloquentUser::class)->create([
            'username' => $user,
            'email' => 'jonsnow@winterfell.north',
            'password' => $password,
        ]);

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
        $this->response = $this->call('POST', '/login', ['username' => $username, 'password' => $password]);
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
        $this->seeJson([
            "password" => ["The password field is required."],
            "username" => ["The username field is required."]
        ]);
    }

    /**
     * @Then the status code should be :statusCode
     */
    public function theStatusCodeShouldBe($statusCode)
    {
        $this->seeStatusCode(422);
    }

    /**
     * @Then I should see username does not exist message
     */
    public function iShouldSeeUsernameDoesNotExistMessage()
    {
        $this->seeJson(['Username does not exist']);
    }

    /**
     * @Then I should see credentials don't match message
     */
    public function iShouldSeeCredentialsDonTMatchMessage()
    {
        $this->seeJson(['Credentials do not match our records']);
    }

}
