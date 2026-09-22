<?php

namespace App\Services;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CurrentTenant
{
    public function forUser(User $user, Request $request): Tenant
    {
        if (! $user->isSuperAdmin()) {
            return app(TenantContext::class)->tenant();
        }

        $tenantId = $request->integer('tenant_id');
        $tenant = Tenant::query()->find($tenantId);

        if ($tenant === null || ! $tenant->isActive()) {
            throw ValidationException::withMessages(['tenant_id' => 'Tenant harus dipilih.']);
        }

        return $tenant;
    }
}
