<?php

namespace App\Contracts\Service;

interface AuthServiceInterface
{
    public function attemptSignIn(array $credentials);
}
