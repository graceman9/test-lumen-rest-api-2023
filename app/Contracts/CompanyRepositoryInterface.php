<?php

namespace App\Contracts;

interface CompanyRepositoryInterface
{
    public function getAll(int $user_id): array;

    public function create(array $companyData, int $user_id): void;
}
