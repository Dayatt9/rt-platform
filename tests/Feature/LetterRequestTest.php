<?php

namespace Tests\Feature;

use App\Enums\LetterRequestStatus;
use App\Enums\UserRole;
use App\Models\LetterRequest;
use App\Models\LetterType;
use App\Models\Resident;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LetterRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_resident_can_submit_valid_request(): void
    {
        $tenant = Tenant::factory()->create();
        $resident = Resident::factory()->create(['tenant_id' => $tenant->id]);
        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
            'resident_id' => $resident->id,
            'role' => UserRole::Resident,
        ]);

        $type = LetterType::factory()->create([
            'tenant_id' => $tenant->id,
            'is_active' => true,
            'fields' => [
                ['name' => 'keperluan', 'label' => 'Keperluan', 'type' => 'text', 'required' => true],
            ],
        ]);

        $response = $this->actingAs($user)->post(route('resident.letters.store'), [
            'letter_type_id' => $type->id,
            'field_keperluan' => 'Pindah rumah',
        ]);

        $response->assertRedirect(route('resident.letters.index'));
        $this->assertDatabaseHas('letter_requests', [
            'tenant_id' => $tenant->id,
            'resident_id' => $resident->id,
            'letter_type_id' => $type->id,
            'status' => LetterRequestStatus::Pending->value,
            'snapshot_type_code' => $type->code,
        ]);

        $request = LetterRequest::first();
        $this->assertEquals('Pindah rumah', $request->request_data['keperluan']);
    }

    public function test_resident_cannot_submit_inactive_letter_type(): void
    {
        $tenant = Tenant::factory()->create();
        $resident = Resident::factory()->create(['tenant_id' => $tenant->id]);
        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
            'resident_id' => $resident->id,
            'role' => UserRole::Resident,
        ]);

        $type = LetterType::factory()->create([
            'tenant_id' => $tenant->id,
            'is_active' => false, // inactive!
        ]);

        $response = $this->actingAs($user)->post(route('resident.letters.store'), [
            'letter_type_id' => $type->id,
        ]);

        $response->assertNotFound();
    }

    public function test_resident_cannot_inject_tenant_id_or_status(): void
    {
        $tenant = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $resident = Resident::factory()->create(['tenant_id' => $tenant->id]);
        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
            'resident_id' => $resident->id,
            'role' => UserRole::Resident,
        ]);

        $type = LetterType::factory()->create([
            'tenant_id' => $tenant->id,
            'fields' => [],
        ]);

        $this->actingAs($user)->post(route('resident.letters.store'), [
            'letter_type_id' => $type->id,
            'tenant_id' => $tenantB->id,
            'status' => LetterRequestStatus::Approved->value,
        ]);

        // Assert it was saved with correct original tenant and pending status
        $this->assertDatabaseHas('letter_requests', [
            'tenant_id' => $tenant->id,
            'status' => LetterRequestStatus::Pending->value,
        ]);
        $this->assertDatabaseMissing('letter_requests', [
            'tenant_id' => $tenantB->id,
        ]);
    }

    public function test_tenant_a_resident_cannot_access_tenant_b_request(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $residentA = Resident::factory()->create(['tenant_id' => $tenantA->id]);
        $userA = User::factory()->create([
            'tenant_id' => $tenantA->id,
            'resident_id' => $residentA->id,
            'role' => UserRole::Resident,
        ]);

        $requestB = LetterRequest::factory()->create(['tenant_id' => $tenantB->id]);

        $response = $this->actingAs($userA)->get(route('resident.letters.show', $requestB));
        $response->assertForbidden();
    }

    public function test_admin_rt_can_approve_and_complete_request(): void
    {
        Storage::fake('local');

        $tenant = Tenant::factory()->create(['rt_number' => '05', 'rw_number' => '02']);
        $admin = User::factory()->adminRt($tenant)->create();
        $request = LetterRequest::factory()->create(['tenant_id' => $tenant->id, 'status' => LetterRequestStatus::Pending]);

        // Approve
        $response = $this->actingAs($admin)->post(route('admin.letters.approve', $request));
        $response->assertRedirect();

        $request->refresh();
        $this->assertEquals(LetterRequestStatus::Approved, $request->status);
        $this->assertEquals($admin->id, $request->processed_by);

        // Complete
        $response = $this->actingAs($admin)->post(route('admin.letters.complete', $request));
        $response->assertRedirect();

        $request->refresh();
        $this->assertEquals(LetterRequestStatus::Completed, $request->status);
        $this->assertNotNull($request->letter_number);
        $this->assertNotNull($request->generated_document_path);

        Storage::disk('local')->assertExists($request->generated_document_path);
    }

    public function test_rejection_requires_reason(): void
    {
        $tenant = Tenant::factory()->create();
        $admin = User::factory()->adminRt($tenant)->create();
        $request = LetterRequest::factory()->create(['tenant_id' => $tenant->id, 'status' => LetterRequestStatus::Pending]);

        $response = $this->actingAs($admin)->post(route('admin.letters.reject', $request), []);
        $response->assertSessionHasErrors(['rejection_reason']);

        $this->actingAs($admin)->post(route('admin.letters.reject', $request), [
            'rejection_reason' => 'Tidak memenuhi syarat',
        ]);

        $request->refresh();
        $this->assertEquals(LetterRequestStatus::Rejected, $request->status);
        $this->assertEquals('Tidak memenuhi syarat', $request->rejection_reason);
    }

    public function test_tenant_a_admin_cannot_access_tenant_b_request(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();

        $adminA = User::factory()->adminRt($tenantA)->create();
        $requestB = LetterRequest::factory()->create(['tenant_id' => $tenantB->id]);

        $response = $this->actingAs($adminA)->get(route('admin.letters.show', $requestB));
        $response->assertForbidden();
    }
}
