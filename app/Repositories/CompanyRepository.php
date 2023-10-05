<?php

namespace App\Repositories;

use App\Contracts\CompanyRepositoryInterface;
use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getAll(int $user_id): array
    {
        return Company::where(['user_id' => $user_id])->get()->all();
    }

    public function create(array $companyData, int $user_id): void
    {
        $companyData['user_id'] = $user_id;
        Company::create($companyData);
    }
}
