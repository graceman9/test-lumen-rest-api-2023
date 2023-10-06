<?php

namespace App\Contracts\Repository;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findById(int $user_id): ?User;

    public function findByEmail(string $email): ?User;

    public function create(array $userData): User;

    public function updatePassword(User $user, string $password): void;
}
