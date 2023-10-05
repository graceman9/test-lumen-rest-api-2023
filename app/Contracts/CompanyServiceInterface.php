<?php

namespace App\Contracts;

interface CompanyServiceInterface
{
    public function getAll(int $userId): array;

    public function create(array $companyData, int $userId): void;
}
