<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\AzPos\Domain\Services\UserAuthService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirect = '/home';

    /**
     * @var Error response message.
     */
    protected $errorMessage;

    /**
     * @var Response estatus code.
     */
    protected $statusCode;

    /**
     * @var UserAuthService
     */
    protected $userAuthService;

    /**
     * AuthController constructor.
     *
     * @param UserAuthService $userAuthService
     */
    public function __construct(UserAuthService $userAuthService)
    {
        $this->middleware('guest', ['except' => 'logout']);

        $this->userAuthService = $userAuthService;
    }

    /**
     * Start processing login request.
     *
     * @param LoginRequest $request
     *
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if($this->authenticate($credentials))
        {
            return response(['login' => 'success'], $this->statusCode)->header('Content-Type', 'application/json');
        }

        return response([ $this->getErrorMessage() ], $this->statusCode)
            ->header('Content-Type', 'application/json');

    }

    /**
     * Attempt authentication.
     *
     * @param $credentials
     *
     * @return bool
     */
    private function authenticate($credentials)
    {
        $this->statusCode = 401;

        if( !$this->userAuthService->usernameExists($credentials['username']) )
        {
            $this->errorMessage = "Username does not exist";
            return false;
        }

        if( $this->userAuthService->usernameExists($credentials['username']) && ! $this->userAuthService->accountActive($credentials['username'])) {
            $this->errorMessage = "Account is inactive";
            return false;
        }

        $this->statusCode = 200;

        if($this->attemptWithUsername($credentials)) {
            return true;
        }

        if($this->attemptWithEmail($credentials)) {
            return true;
        }

        return response([ $this->getErrorMessage() ], 401)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Attempt login with username.
     *
     * @param $credentials
     *
     * @return mixed
     */
    private function attemptWithUsername($credentials)
    {
        return Auth::attempt(
            ['username' => $credentials['username'], 'password' => $credentials['password']]
        );
    }

    /**
     * Attempt login with email.
     *
     * @param $credentials
     *
     * @return mixed
     */
    private function attemptWithEmail($credentials)
    {
        return Auth::attempt(
            ['email' => $credentials['username'], 'password' => $credentials['password']]
        );
    }

    /**
     * Return error message.
     *
     * @return String
     */
    private function getErrorMessage()
    {
        return ! empty($this->errorMessage) ? $this->errorMessage : "Credentials do not match our records";
    }

    /**
     * Logout of application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
