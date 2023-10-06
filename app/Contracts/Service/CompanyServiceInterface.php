<?php

namespace App\Contracts\Service;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface CompanyServiceInterface
{
    public function findByUser(User $user): Collection;

    public function create(User $user, array $companyData): void;
}
