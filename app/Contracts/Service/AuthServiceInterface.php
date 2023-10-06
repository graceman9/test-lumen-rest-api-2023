<?php

namespace App\Contracts\Service;

use App\Models\User;

interface AuthServiceInterface
{
    public function makeVerificationToken(User $user): string;
}
