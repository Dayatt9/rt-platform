<?php

namespace App\Policies;

use App\Models\Complaint;
use App\Models\User;

class ComplaintPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminRt();
    }

    public function create(User $user): bool
    {
        return $user->isResident() && $user->tenant_id !== null && $user->resident_id !== null;
    }

    public function view(User $user, Complaint $complaint): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->isAdminRt()) {
            return $user->tenant_id === $complaint->tenant_id;
        }

        return $user->isResident()
            && $user->tenant_id === $complaint->tenant_id
            && $user->resident_id === $complaint->resident_id;
    }

    public function update(User $user, Complaint $complaint): bool
    {
        return ($user->isSuperAdmin() || $user->isAdminRt())
            && ($user->isSuperAdmin() || $user->tenant_id === $complaint->tenant_id);
    }
}
