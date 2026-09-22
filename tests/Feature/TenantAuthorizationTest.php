<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use App\Services\TenantContext;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class TenantAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_prototype_is_not_available_to_guests(): void
    {
        $this->get(route('home'))->assertRedirect('/login');
        $this->get(route('design-system'))->assertRedirect(route('login'));
    }

    public function test_admin_rt_cannot_access_another_tenant_through_a_changed_parameter(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $adminA = User::factory()->adminRt($tenantA)->create();

        $this->actingAs($adminA)
            ->get(route('admin.residents.index', ['tenant_id' => $tenantB->id]))
            ->assertOk();

        $this->assertSame($tenantA->id, app(TenantContext::class)->tenant()->id);
        $this->assertTrue(Gate::forUser($adminA)->allows('view', $tenantA));
        $this->assertFalse(Gate::forUser($adminA)->allows('view', $tenantB));
    }

    public function test_resident_cannot_access_admin_routes(): void
    {
        $resident = User::factory()->create([
            'tenant_id' => Tenant::factory(),
        ]);

        $this->actingAs($resident)
            ->get(route('dashboard'))
            ->assertForbidden();
    }

    public function test_super_admin_can_view_each_tenant_when_explicitly_authorized(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $superAdmin = User::factory()->superAdmin()->create();

        $this->assertTrue(Gate::forUser($superAdmin)->allows('view', $tenantA));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('view', $tenantB));
    }

    public function test_inactive_tenant_blocks_tenant_member_access(): void
    {
        $tenant = Tenant::factory()->create(['status' => 'inactive']);
        $admin = User::factory()->adminRt($tenant)->create();

        $this->actingAs($admin)
            ->get(route('dashboard'))
            ->assertForbidden();
    }
}
