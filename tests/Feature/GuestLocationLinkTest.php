<?php

namespace Tests\Feature;

use App\Models\GuestLocationLink;
use App\Models\House;
use App\Models\Resident;
use App\Models\Tenant;
use App\Models\User;
use App\Services\GuestLocationLinkService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GuestLocationLinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_map_only_contains_houses_from_the_current_tenant(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $admin = User::factory()->adminRt($tenantA)->create();
        House::factory()->create(['tenant_id' => $tenantA->id, 'house_number' => 'A-MAP', 'latitude' => -6.2, 'longitude' => 106.8]);
        House::factory()->create(['tenant_id' => $tenantB->id, 'house_number' => 'B-SECRET', 'latitude' => -6.3, 'longitude' => 106.9]);

        $this->actingAs($admin)->get(route('admin.houses.map'))->assertOk()->assertSee('A-MAP')->assertDontSee('B-SECRET');
    }

    public function test_cross_tenant_house_and_guest_link_management_is_denied(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $adminA = User::factory()->adminRt($tenantA)->create();
        $houseB = House::factory()->create(['tenant_id' => $tenantB->id, 'latitude' => -6.2, 'longitude' => 106.8]);

        $this->actingAs($adminA)->get(route('admin.houses.show', $houseB))->assertForbidden();
        $this->actingAs($adminA)->post(route('admin.houses.guest-links.store', $houseB))->assertForbidden();
        $this->actingAs($adminA)->put(route('admin.houses.update', $houseB), ['house_number' => 'Changed', 'address' => 'Nope', 'latitude' => -6, 'longitude' => 106, 'status' => 'active', 'tenant_id' => $tenantA->id])->assertForbidden();
        $linkB = app(GuestLocationLinkService::class)->generate($houseB, User::factory()->adminRt($tenantB)->create());
        $this->actingAs($adminA)->delete(route('admin.houses.guest-links.destroy', [$houseB, $linkB->link]))->assertForbidden();

        $houseA = House::factory()->create(['tenant_id' => $tenantA->id, 'latitude' => -6.2, 'longitude' => 106.8]);
        $anotherHouseA = House::factory()->create(['tenant_id' => $tenantA->id, 'latitude' => -6.3, 'longitude' => 106.9]);
        $anotherLinkA = app(GuestLocationLinkService::class)->generate($anotherHouseA, $adminA);
        $this->actingAs($adminA)->delete(route('admin.houses.guest-links.destroy', [$houseA, $anotherLinkA->link]))->assertNotFound();
    }

    public function test_coordinate_validation_rejects_out_of_range_and_non_numeric_values(): void
    {
        $tenant = Tenant::factory()->create();
        $admin = User::factory()->adminRt($tenant)->create();
        $house = House::factory()->create(['tenant_id' => $tenant->id]);
        foreach ([['latitude' => '90.0000000', 'longitude' => '180.0000000', 'valid' => true], ['latitude' => '90.1', 'longitude' => '106', 'field' => 'latitude'], ['latitude' => '-90.1', 'longitude' => '106', 'field' => 'latitude'], ['latitude' => '-6', 'longitude' => '180.1', 'field' => 'longitude'], ['latitude' => '-6', 'longitude' => '-180.1', 'field' => 'longitude'], ['latitude' => 'north', 'longitude' => 'east', 'field' => 'latitude']] as $coordinates) {
            $response = $this->actingAs($admin)->put(route('admin.houses.update', $house), ['house_number' => $house->house_number, 'address' => $house->address, 'latitude' => $coordinates['latitude'], 'longitude' => $coordinates['longitude'], 'status' => 'active']);
            if ($coordinates['valid'] ?? false) {
                $response->assertRedirect();
            } else {
                $response->assertSessionHasErrors($coordinates['field']);
            }
        }
    }

    public function test_guest_token_is_hashed_and_public_page_is_limited_to_safe_location_data(): void
    {
        $tenant = Tenant::factory()->create();
        $admin = User::factory()->adminRt($tenant)->create();
        $house = House::factory()->create(['tenant_id' => $tenant->id, 'address' => 'Alamat Aman 42', 'latitude' => -6.2, 'longitude' => 106.8]);
        $otherTenant = Tenant::factory()->create();
        $otherHouse = House::factory()->create(['tenant_id' => $otherTenant->id, 'address' => 'Alamat Tenant Lain', 'latitude' => -6.3, 'longitude' => 106.9]);
        $resident = Resident::factory()->create(['tenant_id' => $tenant->id, 'nik' => '9876543210123456', 'phone' => '081299998888']);
        $residentUser = User::factory()->create(['tenant_id' => $tenant->id, 'resident_id' => $resident->id, 'email' => 'private@example.test']);

        $response = $this->actingAs($admin)->post(route('admin.houses.guest-links.store', $house), ['tenant_id' => 999999, 'house_id' => 999999, 'created_by' => 999999, 'revoked_at' => null, 'expires_at' => now()->addYears(10)->toIso8601String()])->assertRedirect();
        $url = $response->getSession()->get('guest_location_url');
        $token = basename($url);
        $link = GuestLocationLink::firstOrFail();
        $this->assertNotSame($token, $link->token_hash);
        $this->assertNotSame($token, $link->lookup_hash);
        $this->assertNotSame((string) $house->id, $token);
        $this->assertNotSame((string) $tenant->id, $token);
        $this->assertSame($tenant->id, $link->tenant_id);
        $this->assertSame($house->id, $link->house_id);
        $this->assertSame($admin->id, $link->created_by);
        $this->assertNull($link->revoked_at);
        $this->assertTrue($link->expires_at->lessThan(now()->addHours(25)));

        $this->get($url)->assertOk()->assertSee('Alamat Aman 42')->assertDontSee($resident->nik)->assertDontSee($resident->phone)->assertDontSee($residentUser->email)->assertDontSee('tenant_id')->assertDontSee('house_id')->assertDontSee('created_by');
        $this->get(route('guest.location.show', ['token' => $token, 'house_id' => $otherHouse->id, 'tenant_id' => $otherTenant->id, 'guest_link_id' => 999999]))->assertOk()->assertSee('Alamat Aman 42')->assertDontSee('Alamat Tenant Lain');
        $this->get(route('guest.location.show', 'not-a-valid-token'))->assertNotFound();
    }

    public function test_expired_or_revoked_guest_links_are_not_available(): void
    {
        $tenant = Tenant::factory()->create();
        $admin = User::factory()->adminRt($tenant)->create();
        $house = House::factory()->create(['tenant_id' => $tenant->id, 'latitude' => -6.2, 'longitude' => 106.8]);
        $service = app(GuestLocationLinkService::class);
        $expired = $service->generate($house, $admin);
        $expired->link->forceFill(['expires_at' => now()->subMinute()])->save();
        $this->get(route('guest.location.show', $expired->token))->assertNotFound();
        $revoked = $service->generate($house, $admin);
        $service->revoke($revoked->link);
        $this->get(route('guest.location.show', $revoked->token))->assertNotFound();
    }

    public function test_resident_cannot_open_the_admin_map_or_manage_links(): void
    {
        $tenant = Tenant::factory()->create();
        $house = House::factory()->create(['tenant_id' => $tenant->id, 'latitude' => -6.2, 'longitude' => 106.8]);
        $resident = Resident::factory()->create(['tenant_id' => $tenant->id]);
        $user = User::factory()->create(['tenant_id' => $tenant->id, 'resident_id' => $resident->id]);

        $this->actingAs($user)->get(route('admin.houses.map'))->assertForbidden();
        $this->actingAs($user)->post(route('admin.houses.guest-links.store', $house))->assertForbidden();

        Auth::logout();
        $this->get(route('admin.houses.map'))->assertRedirect('/login');
    }

    public function test_guest_location_route_enforces_its_rate_limit(): void
    {
        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.42']);
        for ($attempt = 0; $attempt < 60; $attempt++) {
            $this->get(route('guest.location.show', "invalid-token-{$attempt}"))->assertNotFound();
        }
        $this->get(route('guest.location.show', 'invalid-token-over-limit'))->assertStatus(429);
    }

    public function test_qr_uses_the_same_guest_location_url_that_is_validated_by_the_public_route(): void
    {
        $tenant = Tenant::factory()->create();
        $admin = User::factory()->adminRt($tenant)->create();
        $house = House::factory()->create(['tenant_id' => $tenant->id, 'latitude' => -6.2, 'longitude' => 106.8]);
        $generated = app(GuestLocationLinkService::class)->generate($house, $admin);
        $url = route('guest.location.show', $generated->token);

        $this->actingAs($admin)->withSession(['guest_location_url' => $url])->get(route('admin.houses.show', $house))->assertOk()->assertSee($url)->assertSee('QRCode.toCanvas');
        $generated->link->forceFill(['revoked_at' => now()])->save();
        $this->get($url)->assertNotFound();
    }
}
