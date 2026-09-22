<?php

namespace App\Policies;

use App\Models\House;
use App\Models\User;

class HousePolicy
{
    public function manage(User $user, House $house): bool
    {
        return ($user->isSuperAdmin() || $user->isAdminRt())
            && ($user->isSuperAdmin() || $user->tenant_id === $house->tenant_id);
    }
}
