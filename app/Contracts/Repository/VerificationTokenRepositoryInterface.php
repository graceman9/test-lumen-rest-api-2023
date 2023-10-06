<?php

namespace App\Contracts\Repository;

use App\Models\User;
use App\Models\VerificationToken;

interface VerificationTokenRepositoryInterface
{
    public function findByToken(string $token): ?VerificationToken;

    public function updateOrCreate(User $user, string $token): VerificationToken;
}
