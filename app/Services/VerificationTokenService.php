<?php

namespace App\Services;

use App\Contracts\Repository\VerificationTokenRepositoryInterface;
use App\Contracts\Service\VerificationTokenServiceInterface;
use App\Models\User;
use App\Models\VerificationToken;

class VerificationTokenService implements VerificationTokenServiceInterface
{
    public function __construct(
        protected VerificationTokenRepositoryInterface $repository
    ) {
    }

    public function findByToken(string $token): ?VerificationToken
    {
        return $this->repository->findByToken($token);
    }

    public function makeVerificationToken(User $user): string
    {
        $token = bin2hex(random_bytes(16));
        $this->repository->updateOrCreate($user, $token);

        return $token;
    }
}
