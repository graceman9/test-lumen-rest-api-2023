<?php

namespace App\Contracts\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface CompanyRepositoryInterface
{
    public function findByUser(User $user): Collection;

    public function create(User $user, array $companyData): void;
}
