<?php

namespace App\Policies;

use App\Models\Household;
use App\Models\User;

class HouseholdPolicy
{
    public function manage(User $user, Household $household): bool
    {
        return ($user->isSuperAdmin() || $user->isAdminRt())
            && ($user->isSuperAdmin() || $user->tenant_id === $household->tenant_id);
    }
}
