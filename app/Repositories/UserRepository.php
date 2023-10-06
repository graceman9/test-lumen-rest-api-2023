<?php

namespace App\Repositories;

use App\Contracts\Repository\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function findById(int $user_id): ?User
    {
        return User::find($user_id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function create(array $userData): User
    {
        return User::create($userData);
    }

    public function updatePassword(User $user, string $password): void
    {
        $user->update(['password' => $password]);
    }
}
