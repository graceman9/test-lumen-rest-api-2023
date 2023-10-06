<?php

namespace App\Services;

use App\Contracts\Service\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;

// FIXME: move logic from controller to this service, throw exceptions, maybe get rid of User, Mail and VerificatinoToken services
class AuthService implements AuthServiceInterface
{
    public function __construct()
    {
    }

    public function attemptSignIn(array $credentials)
    {
        return Auth::attempt($credentials);
    }
}
