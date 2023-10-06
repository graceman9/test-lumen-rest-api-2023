<?php

namespace App\Contracts\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * NOTE: probably this interface should not use Eloquent collections, for example if we want to change implementation to InMemory storage. In this case we need to add our custom collection (not Eloquent).
 */
interface CompanyRepositoryInterface
{
    public function findByUser(User $user): Collection;

    public function create(User $user, array $companyData): void;
}
