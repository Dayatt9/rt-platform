<?php

namespace App\Http\Middleware;

use App\Services\TenantContext;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenantContext
{
    public function handle(Request $request, Closure $next): Response
    {
        $context = app(TenantContext::class);
        $context->clear();

        $user = $request->user();

        if ($user !== null && ! $user->isSuperAdmin()) {
            $tenant = $user->tenant;

            abort_if($tenant === null || ! $tenant->isActive(), 403);

            $context->set($tenant);
        }

        return $next($request);
    }
}
