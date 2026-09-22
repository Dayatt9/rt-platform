<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\LetterType;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LetterTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_rt_can_create_letter_type_for_their_tenant(): void
    {
        $tenant = Tenant::factory()->create();
        $admin = User::factory()->adminRt($tenant)->create();

        $response = $this->actingAs($admin)->post(route('admin.letter-types.store'), [
            'code' => 'SKU',
            'name' => 'Surat Keterangan Usaha',
            'description' => 'Untuk keperluan usaha',
            'is_active' => '1',
            'fields' => [
                ['name' => 'nama_usaha', 'label' => 'Nama Usaha', 'type' => 'text', 'required' => '1'],
            ],
            'template_body' => 'Usaha {{nama_usaha}}',
        ]);

        $response->assertRedirect(route('admin.letter-types.index'));
        $this->assertDatabaseHas('letter_types', [
            'tenant_id' => $tenant->id,
            'code' => 'SKU',
            'name' => 'Surat Keterangan Usaha',
        ]);
    }

    public function test_admin_cannot_modify_another_tenant_letter_type(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();

        $adminA = User::factory()->adminRt($tenantA)->create();
        $typeB = LetterType::factory()->create(['tenant_id' => $tenantB->id, 'code' => 'B01']);

        $response = $this->actingAs($adminA)->put(route('admin.letter-types.update', $typeB), [
            'code' => 'B01-UPDATED',
            'name' => 'Updated Name',
        ]);

        $response->assertForbidden();
    }

    public function test_resident_cannot_manage_letter_types(): void
    {
        $tenant = Tenant::factory()->create();
        $residentUser = User::factory()->create([
            'tenant_id' => $tenant->id,
            'role' => UserRole::Resident,
        ]);

        $response = $this->actingAs($residentUser)->get(route('admin.letter-types.index'));

        $response->assertForbidden();
    }
}
