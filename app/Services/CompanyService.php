<?php

namespace App\Services;

use App\Contracts\Repository\CompanyRepositoryInterface;
use App\Contracts\Service\CompanyServiceInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CompanyService implements CompanyServiceInterface
{
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository
    ) {
    }

    public function findByUser(User $user): Collection
    {
        return $this->companyRepository->findByUser($user);
    }

    public function create(User $user, array $companyData): void
    {
        $this->companyRepository->create($user, $companyData);
    }
}
