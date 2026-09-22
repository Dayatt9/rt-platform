<?php

namespace App\Policies;

use App\Models\GuestLocationLink;
use App\Models\User;

class GuestLocationLinkPolicy
{
    public function manage(User $user, GuestLocationLink $link): bool
    {
        return ($user->isSuperAdmin() || $user->isAdminRt())
            && ($user->isSuperAdmin() || $user->tenant_id === $link->tenant_id);
    }
}
