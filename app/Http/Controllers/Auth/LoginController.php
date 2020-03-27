<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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
