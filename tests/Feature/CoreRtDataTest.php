<?php

namespace Tests\Feature;

use App\Models\House;
use App\Models\Household;
use App\Models\Resident;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoreRtDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_creates_and_updates_a_resident_only_in_own_tenant(): void
    {
        $tenantA=Tenant::factory()->create(); $tenantB=Tenant::factory()->create(); $admin=User::factory()->adminRt($tenantA)->create();
        $this->actingAs($admin)->post(route('admin.residents.store'), ['name'=>'Warga A','nik'=>'1111111111111111','status'=>'active'])->assertRedirect();
        $resident=Resident::where('nik','1111111111111111')->firstOrFail(); $this->assertSame($tenantA->id,$resident->tenant_id);
        $this->actingAs($admin)->put(route('admin.residents.update',$resident), ['name'=>'Warga A Baru','nik'=>'','phone'=>'081234567890','status'=>'active'])->assertRedirect();
        $this->assertSame('1111111111111111',$resident->refresh()->nik);
        $this->assertSame('Warga A Baru',$resident->name);
        $other=Resident::factory()->create(['tenant_id'=>$tenantB->id]);
        $this->actingAs($admin)->get(route('admin.residents.show',$other))->assertForbidden();
        $this->actingAs($admin)->put(route('admin.residents.update',$other), ['name'=>'Changed','nik'=>$other->nik,'status'=>'active'])->assertForbidden();
    }

    public function test_kk_is_unique_per_tenant_and_a_house_can_have_multiple_households(): void
    {
        $tenantA=Tenant::factory()->create(); $tenantB=Tenant::factory()->create(); $admin=User::factory()->adminRt($tenantA)->create(); $house=House::factory()->create(['tenant_id'=>$tenantA->id]);
        $payload=['kk_number'=>'2222222222222222','house_id'=>$house->id,'status'=>'active'];
        $this->actingAs($admin)->post(route('admin.households.store'),$payload)->assertRedirect();
        $this->actingAs($admin)->post(route('admin.households.store'),$payload)->assertSessionHasErrors('kk_number');
        Household::factory()->create(['tenant_id'=>$tenantA->id,'house_id'=>$house->id]);
        Household::factory()->create(['tenant_id'=>$tenantB->id,'kk_number'=>$payload['kk_number']]);
        $this->assertSame(2,$house->refresh()->households()->count());
    }

    public function test_household_cannot_use_a_house_or_member_from_another_tenant_and_coordinates_are_validated(): void
    {
        $tenantA=Tenant::factory()->create(); $tenantB=Tenant::factory()->create(); $admin=User::factory()->adminRt($tenantA)->create(); $houseB=House::factory()->create(['tenant_id'=>$tenantB->id]);
        $this->actingAs($admin)->post(route('admin.households.store'),['kk_number'=>'3333333333333333','house_id'=>$houseB->id,'status'=>'active'])->assertForbidden();
        $this->actingAs($admin)->post(route('admin.houses.store'),['house_number'=>'B-01','address'=>'Jalan Uji','latitude'=>91,'longitude'=>181,'status'=>'active'])->assertSessionHasErrors(['latitude','longitude']);
        $household=Household::factory()->create(['tenant_id'=>$tenantA->id]); $residentB=Resident::factory()->create(['tenant_id'=>$tenantB->id]);
        $this->actingAs($admin)->post(route('admin.households.members.store',$household),['resident_id'=>$residentB->id,'family_role'=>'child'])->assertForbidden();
    }

    public function test_resident_role_cannot_access_master_data(): void
    {
        $tenant=Tenant::factory()->create(); $resident=Resident::factory()->create(['tenant_id'=>$tenant->id]); $user=User::factory()->create(['tenant_id'=>$tenant->id,'resident_id'=>$resident->id]);
        $this->actingAs($user)->get(route('admin.residents.index'))->assertForbidden();
        $this->actingAs($user)->get(route('admin.households.index'))->assertForbidden();
        $this->actingAs($user)->get(route('admin.houses.index'))->assertForbidden();
    }
}
