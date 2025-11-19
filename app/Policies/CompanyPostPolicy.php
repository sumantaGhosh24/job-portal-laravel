<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\CompanyPost;
use App\Models\User;

class CompanyPostPolicy
{
    public function create(User $user, Company $company): bool
    {
        return $user->id === $company->owner_id;
    }

    public function update(User $user, CompanyPost $companyPost): bool
    {
        return $user->id === $companyPost->company->owner_id;
    }

    public function delete(User $user, CompanyPost $companyPost): bool
    {
        return $user->id === $companyPost->company->owner_id;
    }
}
