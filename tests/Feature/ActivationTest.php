<?php

namespace Tests\Feature;

use App\Enums\AccountStatus;
use App\Models\Resident;
use App\Models\Tenant;
use App\Models\User;
use App\Services\ActivationCodeService;
use App\Services\GeneratedActivationCode;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ActivationTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_is_disabled(): void
    {
        $this->get('/register')->assertNotFound();
        $this->post('/register', [])->assertNotFound();
    }

    public function test_valid_activation_creates_a_pending_account_bound_to_the_resident_and_tenant(): void
    {
        [$resident, $generated] = $this->generatedActivation();

        $this->post(route('activation.validate'), ['code' => $generated->plainTextCode])
            ->assertRedirect(route('activation.account.create'));

        $this->post(route('activation.account.store'), [
            'email' => 'warga@example.test',
            'password' => 'activation-password',
            'password_confirmation' => 'activation-password',
            'tenant_id' => Tenant::factory()->create()->id,
            'resident_id' => Resident::factory()->create()->id,
        ])->assertRedirect(route('verification.notice'));

        $user = User::query()->where('email', 'warga@example.test')->firstOrFail();
        $activationCode = $generated->activationCode->refresh();

        $this->assertSame($resident->tenant_id, $user->tenant_id);
        $this->assertSame($resident->id, $user->resident_id);
        $this->assertSame(AccountStatus::Pending, $user->status);
        $this->assertTrue(Hash::check('activation-password', $user->password));
        $this->assertSame($user->id, $activationCode->pending_user_id);
        $this->assertNull($activationCode->used_at);
    }

    public function test_activation_plaintext_is_not_stored_and_codes_are_not_reused_or_predictable(): void
    {
        [, $first] = $this->generatedActivation();
        [, $second] = $this->generatedActivation();

        $this->assertNotSame($first->plainTextCode, $second->plainTextCode);
        $this->assertGreaterThanOrEqual(40, strlen($first->plainTextCode));
        $this->assertNotSame($first->plainTextCode, $first->activationCode->code_hash);
        $this->assertDatabaseMissing('activation_codes', ['code_hash' => $first->plainTextCode]);
        $this->assertDatabaseMissing('activation_codes', ['lookup_hash' => $first->plainTextCode]);
    }

    public function test_invalid_expired_revoked_and_used_codes_are_rejected(): void
    {
        $this->post(route('activation.validate'), ['code' => 'not-a-valid-code'])
            ->assertSessionHasErrors('code');

        [, $expired] = $this->generatedActivation();
        $expired->activationCode->update(['expires_at' => now()->subMinute()]);
        $this->post(route('activation.validate'), ['code' => $expired->plainTextCode])
            ->assertSessionHasErrors('code');

        [, $revoked] = $this->generatedActivation();
        $revoked->activationCode->update(['revoked_at' => now()]);
        $this->post(route('activation.validate'), ['code' => $revoked->plainTextCode])
            ->assertSessionHasErrors('code');

        [, $used] = $this->generatedActivation();
        $used->activationCode->update(['used_at' => now()]);
        $this->post(route('activation.validate'), ['code' => $used->plainTextCode])
            ->assertSessionHasErrors('code');
    }

    public function test_activation_can_only_be_claimed_once(): void
    {
        [, $generated] = $this->generatedActivation();

        $this->post(route('activation.validate'), ['code' => $generated->plainTextCode]);
        $this->post(route('activation.account.store'), [
            'email' => 'first@example.test',
            'password' => 'activation-password',
            'password_confirmation' => 'activation-password',
        ])->assertRedirect(route('verification.notice'));

        $this->post(route('logout'));
        $this->withSession(['activation_code_id' => $generated->activationCode->id])
            ->post(route('activation.account.store'), [
                'email' => 'second@example.test',
                'password' => 'activation-password',
                'password_confirmation' => 'activation-password',
            ])->assertSessionHasErrors('code');

        $this->assertSame(1, User::query()->whereIn('email', ['first@example.test', 'second@example.test'])->count());
    }

    public function test_email_verification_activates_the_account_and_marks_the_code_used(): void
    {
        [, $generated] = $this->generatedActivation();
        $user = app(ActivationCodeService::class)->claim(
            $generated->activationCode,
            'verified@example.test',
            'activation-password',
        );

        $user->markEmailAsVerified();
        event(new Verified($user));

        $this->assertSame(AccountStatus::Active, $user->refresh()->status);
        $this->assertNotNull($generated->activationCode->refresh()->used_at);
    }

    public function test_pending_and_suspended_accounts_cannot_log_in_but_verified_active_account_can(): void
    {
        $pending = User::factory()->create([
            'email' => 'pending@example.test',
            'status' => AccountStatus::Pending,
        ]);
        $suspended = User::factory()->create([
            'email' => 'suspended@example.test',
            'status' => AccountStatus::Suspended,
        ]);
        $active = User::factory()->superAdmin()->create([
            'email' => 'active@example.test',
            'status' => AccountStatus::Active,
            'email_verified_at' => now(),
        ]);

        $this->post(route('login.store'), ['email' => $pending->email, 'password' => 'password'])
            ->assertSessionHasErrors('email');
        $this->post(route('login.store'), ['email' => $suspended->email, 'password' => 'password'])
            ->assertSessionHasErrors('email');
        $this->post(route('login.store'), ['email' => $active->email, 'password' => 'password'])
            ->assertRedirect(route('dashboard', absolute: false));

        $this->assertAuthenticatedAs($active);
        $this->assertNotNull($active->refresh()->last_login_at);
    }

    public function test_unverified_resident_cannot_access_verified_account_areas(): void
    {
        [, $generated] = $this->generatedActivation();
        $user = app(ActivationCodeService::class)->claim(
            $generated->activationCode,
            'unverified@example.test',
            'activation-password',
        );

        $this->actingAs($user)
            ->get(route('profile.edit'))
            ->assertRedirect(route('verification.notice'));
    }

    public function test_admin_can_only_generate_or_revoke_activation_for_its_own_tenant(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $adminA = User::factory()->adminRt($tenantA)->create();
        $residentB = Resident::factory()->create(['tenant_id' => $tenantB->id]);
        $residentA = Resident::factory()->create(['tenant_id' => $tenantA->id]);
        $activationCode = app(ActivationCodeService::class)->generate($residentA, $adminA)->activationCode;

        $this->actingAs($adminA)
            ->post(route('admin.residents.activation.store', $residentB))
            ->assertForbidden();
        $this->actingAs($adminA)
            ->get(route('admin.residents.activation.show', $residentB))
            ->assertForbidden();
        $this->actingAs($adminA)
            ->delete(route('admin.residents.activation.destroy', [$residentB, $activationCode]))
            ->assertNotFound();
    }

    public function test_resident_cannot_create_activation_for_self_or_another_resident(): void
    {
        $tenant = Tenant::factory()->create();
        $resident = Resident::factory()->create(['tenant_id' => $tenant->id]);
        $otherResident = Resident::factory()->create(['tenant_id' => $tenant->id]);
        $admin = User::factory()->adminRt($tenant)->create();
        $activationCode = app(ActivationCodeService::class)->generate($otherResident, $admin)->activationCode;
        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
            'resident_id' => $resident->id,
            'status' => AccountStatus::Active,
        ]);

        $this->actingAs($user)
            ->post(route('admin.residents.activation.store', $resident))
            ->assertForbidden();
        $this->actingAs($user)
            ->post(route('admin.residents.activation.store', $otherResident))
            ->assertForbidden();
        $this->actingAs($user)
            ->delete(route('admin.residents.activation.destroy', [$otherResident, $activationCode]))
            ->assertForbidden();
    }

    /**
     * @return array{Resident, GeneratedActivationCode}
     */
    private function generatedActivation(): array
    {
        $tenant = Tenant::factory()->create();
        $resident = Resident::factory()->create(['tenant_id' => $tenant->id]);
        $admin = User::factory()->adminRt($tenant)->create();

        return [$resident, app(ActivationCodeService::class)->generate($resident, $admin)];
    }
}
