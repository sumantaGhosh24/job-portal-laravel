<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\CompanyJob;
use App\Models\User;

class CompanyJobPolicy
{
    public function update(User $user, CompanyJob $companyJob): bool
    {
        return $user->id === $companyJob->company->owner_id;
    }

    public function delete(User $user, CompanyJob $companyJob): bool
    {
        return $user->id === $companyJob->company->owner_id;
    }
}
