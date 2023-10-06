<?php

namespace App\Contracts\Service;

use App\Models\User;
use App\Models\VerificationToken;

interface VerificationTokenServiceInterface
{
    public function findByToken(string $token): ?VerificationToken;

    public function updateOrCreate(User $user, string $token): VerificationToken;
}
