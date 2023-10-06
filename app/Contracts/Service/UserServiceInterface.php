<?php

namespace App\Contracts\Service;

use App\Models\User;
use App\Models\VerificationToken;

interface UserServiceInterface
{
    public function findByEmail(string $email): ?User;

    public function create(array $userData): User;

    public function updatePasswordByToken(VerificationToken $verificationToken, string $password): void;
}
