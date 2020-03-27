<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getUser(string $email): ?User
    {
        return User::all()->first(function (User $user) use ($email) {
            return $user->email === $email;
        });
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = $this->getUser($data['email']);

        if (!is_null($user) && Auth::attempt(['email' => $user->encryptedValues['email'], 'password' => $data['password']], $request->filled('remember'))) {
            return $this->sendLoginResponse($request);
        } else {
            return $this->sendFailedLoginResponse($request);
        }
    }
}
