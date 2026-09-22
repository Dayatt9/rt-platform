<?php

namespace App\Policies;

use App\Models\ActivationCode;
use App\Models\Resident;
use App\Models\User;

class ResidentPolicy
{
    public function manage(User $user, Resident $resident): bool
    {
        return ($user->isSuperAdmin() || $user->isAdminRt())
            && ($user->isSuperAdmin() || $user->tenant_id === $resident->tenant_id);
    }

    public function view(User $user, Resident $resident): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->isAdminRt()) {
            return $user->tenant_id === $resident->tenant_id;
        }

        return $user->isResident() && $user->resident_id === $resident->id;
    }

    public function generateActivation(User $user, Resident $resident): bool
    {
        return ($user->isSuperAdmin() || $user->isAdminRt())
            && ($user->isSuperAdmin() || $user->tenant_id === $resident->tenant_id);
    }

    public function revokeActivation(User $user, Resident $resident, ActivationCode $activationCode): bool
    {
        return $activationCode->resident_id === $resident->id
            && $this->generateActivation($user, $resident);
    }
}
