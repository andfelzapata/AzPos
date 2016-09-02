<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

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
     * @param Request $request
     *
     * @return mixed
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required', 'password' => 'required'
        ]); // Returns response with validation errors if any with 422 status code.

        $credentials = $request->only('username', 'password');

        if($this->authenticate($credentials))
        {
            return response(['redirect' => $this->redirect, 'msg' => $this->message],
                $this->statusCode)->header('Content-Type', 'application/json');
        }

        return response(['redirect' => '', 'msg' => $this->getFailedLoginMessage()], 401)
            ->header('Content-Type', 'application/json');

    }

    public function authenticate($credentials)
    {
        // Check if account is active and if username exists.
        if(! $this->userAuthService->accountActive($credentials['username']) && $this->userAuthService->usernameExists($credentials['username']))
        {
            $this->message = "Username doesn't exist or account inactive";
            $this->statusCode = 422;
            $this->redirect = "login";
            return true;
        }

        $this->statusCode = 200;

        if(Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']] ))
        {
            return true;
        }

        elseif(Auth::attempt(['email' => $credentials['username'], 'password' => $credentials['password']] ))
        {
            return true;
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
