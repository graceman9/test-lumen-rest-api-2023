<?php

namespace App\Services;

use App\Contracts\Repository\UserRepositoryInterface;
use App\Contracts\Service\UserServiceInterface;
use App\Models\User;
use App\Models\VerificationToken;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {
    }

    public function findByEmail(string $email): ?User
    {
        return $this->repository->findByEmail($email);
    }

    public function create(array $userData): User
    {
        return $this->repository->create($userData);
    }

    public function updatePasswordByToken(VerificationToken $verificationToken, string $password): void
    {
        $user = $this->repository->findById($verificationToken->user_id);
        $this->repository->updatePassword($user, $password);
    }
}
