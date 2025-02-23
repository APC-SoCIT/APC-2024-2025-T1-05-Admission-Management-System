<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ApplicantInfo;

class ApplicantInfoPolicy
{
    /**
     * Determine if the given user can update the status of the applicant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ApplicantInfo  $applicant
     * @return bool
     */
    public function updateStatus(User $user, ApplicantInfo $applicant)
    {
        return $user->hasRole('staff') || $user->hasRole('admin');
    }
}
