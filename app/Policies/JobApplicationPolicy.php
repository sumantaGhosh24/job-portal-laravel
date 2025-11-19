<?php

namespace App\Policies;

use App\Models\JobApplication;
use App\Models\User;

class JobApplicationPolicy
{
    public function update(User $user, JobApplication $jobApplication): bool
    {
        return $user?->id === $jobApplication->job?->company?->owner_id;
    }
}
