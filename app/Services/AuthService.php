<?php

namespace App\Services;

use App\Contracts\Repository\VerificationTokenRepositoryInterface;
use App\Contracts\Service\AuthServiceInterface;
use App\Models\User;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        protected VerificationTokenRepositoryInterface $verificationTokenRepository
    ) {
    }

    public function makeVerificationToken(User $user): string
    {
        $token = bin2hex(random_bytes(16));
        $this->verificationTokenRepository->updateOrCreate($user, $token);

        return $token;
    }
}
