<?php

namespace App\Policies;

use App\Models\LetterRequest;
use App\Models\User;

class LetterRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminRt();
    }

    public function view(User $user, LetterRequest $letterRequest): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->isAdminRt()) {
            return $user->tenant_id === $letterRequest->tenant_id;
        }

        return $user->isResident() && $user->resident_id === $letterRequest->resident_id;
    }

    public function update(User $user, LetterRequest $letterRequest): bool
    {
        return ($user->isSuperAdmin() || $user->isAdminRt())
            && ($user->isSuperAdmin() || $user->tenant_id === $letterRequest->tenant_id);
    }
}
