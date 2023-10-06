<?php

namespace App\Repositories;

use App\Contracts\Repository\CompanyRepositoryInterface;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function findByUser(User $user): Collection
    {
        return Company::where(['user_id' => $user->id])->get();
    }

    public function create(User $user, array $companyData): void
    {
        $companyData['user_id'] = $user->id;
        Company::create($companyData);
    }
}
