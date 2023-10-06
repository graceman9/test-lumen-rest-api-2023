<?php

namespace App\Repositories;

use App\Contracts\Repository\VerificationTokenRepositoryInterface;
use App\Models\User;
use App\Models\VerificationToken;
use Carbon\Carbon;

class VerificationTokenRepository implements VerificationTokenRepositoryInterface
{
    public function __construct()
    {
    }

    public function findByToken(string $token): ?VerificationToken
    {
        return VerificationToken::where([
            ['token', md5($token)],
            ['expires_at', '>', Carbon::now()->toDateTimeString()]
        ])->first();
    }

    public function updateOrCreate(User $user, string $token): VerificationToken
    {
        return VerificationToken::updateOrCreate(['user_id' => $user->id], [
            'token' => $token,
            'expires_at' => Carbon::now()->addHour()->toDateTimeString(),
        ]);
    }
}
