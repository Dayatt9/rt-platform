<?php

namespace App\Policies;

use App\Models\LetterType;
use App\Models\User;

class LetterTypePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminRt();
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminRt();
    }

    public function update(User $user, LetterType $letterType): bool
    {
        return ($user->isSuperAdmin() || $user->isAdminRt())
            && ($user->isSuperAdmin() || $user->tenant_id === $letterType->tenant_id);
    }

    public function delete(User $user, LetterType $letterType): bool
    {
        return ($user->isSuperAdmin() || $user->isAdminRt())
            && ($user->isSuperAdmin() || $user->tenant_id === $letterType->tenant_id);
    }
}
