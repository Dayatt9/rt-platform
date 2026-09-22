<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case AdminRt = 'admin_rt';
    case Resident = 'resident';
}
