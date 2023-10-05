<?php

namespace App\Services;

use App\Contracts\CompanyRepositoryInterface;
use App\Contracts\CompanyServiceInterface;

class CompanyService implements CompanyServiceInterface
{
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository
    ) {
    }

    public function getAll(int $userId): array
    {
        return $this->companyRepository->getAll($userId);
    }

    public function create(array $companyData, int $userId): void
    {
        $this->companyRepository->create($companyData, $userId);
    }
}
