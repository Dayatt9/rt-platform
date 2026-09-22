<?php

namespace Tests\Feature;

use App\Enums\ComplaintStatus;
use App\Enums\UserRole;
use App\Models\Complaint;
use App\Models\Resident;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ComplaintTest extends TestCase
{
    use RefreshDatabase;

    public function test_resident_can_view_and_create_a_complaint_with_server_derived_ownership(): void
    {
        $tenant = Tenant::factory()->create();
        [$resident, $user] = $this->residentUser($tenant);

        $this->actingAs($user)->get(route('resident.complaints.index'))->assertOk();
        $this->actingAs($user)->get(route('resident.complaints.create'))->assertOk();

        $this->actingAs($user)->post(route('resident.complaints.store'), [
            'category' => 'fasilitas',
            'title' => 'Lampu jalan mati',
            'description' => 'Lampu jalan di depan rumah mati sejak kemarin.',
            'tenant_id' => Tenant::factory()->create()->id,
            'resident_id' => Resident::factory()->create()->id,
            'status' => ComplaintStatus::Resolved->value,
        ])->assertRedirect();

        $this->assertDatabaseHas('complaints', [
            'tenant_id' => $tenant->id,
            'resident_id' => $resident->id,
            'category' => 'fasilitas',
            'status' => ComplaintStatus::Pending->value,
        ]);
    }

    public function test_complaint_creation_validates_required_fields_category_and_attachment(): void
    {
        $tenant = Tenant::factory()->create();
        [, $user] = $this->residentUser($tenant);

        $this->actingAs($user)->post(route('resident.complaints.store'), [
            'category' => 'tidak-valid',
            'title' => '',
            'description' => '',
            'attachment' => UploadedFile::fake()->create('program.exe', 10, 'application/octet-stream'),
        ])->assertSessionHasErrors(['category', 'title', 'description', 'attachment']);
    }

    public function test_resident_can_download_own_attachment(): void
    {
        Storage::fake('local');
        $tenant = Tenant::factory()->create();
        [$resident, $user] = $this->residentUser($tenant);
        $path = 'complaints/'.$tenant->id.'/'.$resident->id.'/evidence.pdf';
        Storage::disk('local')->put($path, 'attachment');
        $complaint = Complaint::factory()->create(['tenant_id' => $tenant->id, 'resident_id' => $resident->id, 'attachment_path' => $path]);

        $this->actingAs($user)->get(route('resident.complaints.attachment', $complaint))->assertOk();
    }

    public function test_resident_attachment_is_validated_and_stored_on_the_private_local_disk(): void
    {
        Storage::fake('local');
        $tenant = Tenant::factory()->create();
        [, $user] = $this->residentUser($tenant);

        $this->actingAs($user)->post(route('resident.complaints.store'), [
            'category' => 'kebersihan',
            'title' => 'Sampah belum diangkut',
            'description' => 'Sampah di titik kumpul belum diangkut.',
            'attachment' => UploadedFile::fake()->create('bukti.pdf', 100, 'application/pdf'),
        ])->assertRedirect();

        $complaint = Complaint::firstOrFail();
        $this->assertNotNull($complaint->attachment_path);
        $this->assertStringStartsWith("complaints/{$tenant->id}/{$user->resident_id}/", $complaint->attachment_path);
        Storage::disk('local')->assertExists($complaint->attachment_path);
    }

    public function test_resident_cannot_view_or_download_another_resident_or_tenant_complaint(): void
    {
        Storage::fake('local');
        $tenantA = Tenant::factory()->create();
        [$residentA, $userA] = $this->residentUser($tenantA);
        [$residentSameTenant] = $this->residentUser($tenantA);
        $tenantB = Tenant::factory()->create();
        [$residentB] = $this->residentUser($tenantB);
        $sameTenantComplaint = $this->complaintWithAttachment($tenantA, $residentSameTenant);
        $tenantBComplaint = $this->complaintWithAttachment($tenantB, $residentB);

        $this->actingAs($userA)->get(route('resident.complaints.show', $sameTenantComplaint))->assertForbidden();
        $this->actingAs($userA)->get(route('resident.complaints.attachment', $sameTenantComplaint))->assertForbidden();
        $this->actingAs($userA)->get(route('resident.complaints.show', $tenantBComplaint))->assertForbidden();
        $this->actingAs($userA)->get(route('resident.complaints.attachment', $tenantBComplaint))->assertForbidden();
    }

    public function test_admin_can_view_tenant_complaints_filter_and_update_response(): void
    {
        $tenant = Tenant::factory()->create();
        $admin = User::factory()->adminRt($tenant)->create();
        [$resident] = $this->residentUser($tenant);
        $complaint = Complaint::factory()->create(['tenant_id' => $tenant->id, 'resident_id' => $resident->id, 'category' => 'keamanan']);

        $this->actingAs($admin)->get(route('admin.complaints.index', ['status' => 'pending', 'category' => 'keamanan']))->assertOk()->assertSee($complaint->title);
        $this->actingAs($admin)->get(route('admin.complaints.show', $complaint))->assertOk();
        $otherAdmin = User::factory()->adminRt($tenant)->create();
        $this->actingAs($admin)->patch(route('admin.complaints.response', $complaint), [
            'admin_response' => 'Petugas akan memeriksa lokasi.',
            'responded_by' => $otherAdmin->id,
            'responded_at' => now()->subDay()->toDateTimeString(),
        ])->assertRedirect();

        $complaint->refresh();
        $this->assertSame('Petugas akan memeriksa lokasi.', $complaint->admin_response);
        $this->assertSame($admin->id, $complaint->responded_by);
        $this->assertNotNull($complaint->responded_at);
    }

    public function test_admin_can_only_access_and_download_complaints_in_own_tenant(): void
    {
        Storage::fake('local');
        $tenantA = Tenant::factory()->create();
        $adminA = User::factory()->adminRt($tenantA)->create();
        $tenantB = Tenant::factory()->create();
        [$residentB] = $this->residentUser($tenantB);
        $complaintB = $this->complaintWithAttachment($tenantB, $residentB);

        $this->actingAs($adminA)->get(route('admin.complaints.show', $complaintB))->assertForbidden();
        $this->actingAs($adminA)->patch(route('admin.complaints.status', $complaintB), ['status' => 'in_progress'])->assertForbidden();
        $this->actingAs($adminA)->patch(route('admin.complaints.response', $complaintB), ['admin_response' => 'Tidak sah'])->assertForbidden();
        $this->actingAs($adminA)->get(route('admin.complaints.attachment', $complaintB))->assertForbidden();
    }

    public function test_resident_cannot_access_admin_complaint_routes(): void
    {
        $tenant = Tenant::factory()->create();
        [$resident, $user] = $this->residentUser($tenant);
        $complaint = Complaint::factory()->create(['tenant_id' => $tenant->id, 'resident_id' => $resident->id]);

        $this->actingAs($user)->get(route('admin.complaints.index'))->assertForbidden();
        $this->actingAs($user)->get(route('admin.complaints.show', $complaint))->assertForbidden();
    }

    public function test_status_transitions_are_limited_to_the_defined_workflow(): void
    {
        $tenant = Tenant::factory()->create();
        $admin = User::factory()->adminRt($tenant)->create();
        [$resident] = $this->residentUser($tenant);
        $complaint = Complaint::factory()->create(['tenant_id' => $tenant->id, 'resident_id' => $resident->id]);

        $this->actingAs($admin)->patch(route('admin.complaints.status', $complaint), ['status' => 'in_progress'])->assertRedirect();
        $this->assertSame(ComplaintStatus::InProgress, $complaint->refresh()->status);

        $this->actingAs($admin)->patch(route('admin.complaints.status', $complaint), ['status' => 'resolved'])->assertRedirect();
        $this->assertSame(ComplaintStatus::Resolved, $complaint->refresh()->status);

        $this->actingAs($admin)->patch(route('admin.complaints.status', $complaint), ['status' => 'pending'])->assertSessionHas('error');
        $this->assertSame(ComplaintStatus::Resolved, $complaint->refresh()->status);
    }

    public function test_pending_can_be_rejected_and_in_progress_can_be_rejected(): void
    {
        $tenant = Tenant::factory()->create();
        $admin = User::factory()->adminRt($tenant)->create();
        [$resident] = $this->residentUser($tenant);
        $pending = Complaint::factory()->create(['tenant_id' => $tenant->id, 'resident_id' => $resident->id]);
        $inProgress = Complaint::factory()->inProgress()->create(['tenant_id' => $tenant->id, 'resident_id' => $resident->id]);

        $this->actingAs($admin)->patch(route('admin.complaints.status', $pending), ['status' => 'rejected'])->assertRedirect();
        $this->actingAs($admin)->patch(route('admin.complaints.status', $inProgress), ['status' => 'rejected'])->assertRedirect();

        $this->assertSame(ComplaintStatus::Rejected, $pending->refresh()->status);
        $this->assertSame(ComplaintStatus::Rejected, $inProgress->refresh()->status);
    }

    /** @return array{Resident, User} */
    private function residentUser(Tenant $tenant): array
    {
        $resident = Resident::factory()->create(['tenant_id' => $tenant->id]);
        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
            'resident_id' => $resident->id,
            'role' => UserRole::Resident,
        ]);

        return [$resident, $user];
    }

    private function complaintWithAttachment(Tenant $tenant, Resident $resident): Complaint
    {
        $path = 'complaints/'.$tenant->id.'/'.$resident->id.'/evidence.pdf';
        Storage::disk('local')->put($path, 'attachment');

        return Complaint::factory()->create([
            'tenant_id' => $tenant->id,
            'resident_id' => $resident->id,
            'attachment_path' => $path,
        ]);
    }
}
