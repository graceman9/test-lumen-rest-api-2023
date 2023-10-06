<?php

namespace App\Contracts\Service;

use App\Models\User;

interface MailServiceInterface
{
    public function sendRecovePasswordMail(User $user, string $verificationToken);
}
