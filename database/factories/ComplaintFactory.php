<?php

namespace Database\Factories;

use App\Enums\ComplaintStatus;
use App\Models\Complaint;
use App\Models\Resident;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Complaint>
 */
class ComplaintFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'resident_id' => fn (array $attributes) => Resident::factory()
                ->create(['tenant_id' => $attributes['tenant_id']])
                ->id,
            'category' => 'lingkungan',
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'status' => ComplaintStatus::Pending,
        ];
    }

    public function pending(): static
    {
        return $this->state(['status' => ComplaintStatus::Pending]);
    }

    public function inProgress(): static
    {
        return $this->state(['status' => ComplaintStatus::InProgress]);
    }

    public function resolved(): static
    {
        return $this->state(['status' => ComplaintStatus::Resolved]);
    }

    public function rejected(): static
    {
        return $this->state(['status' => ComplaintStatus::Rejected]);
    }

    public function withAttachment(string $path = 'complaints/1/1/attachment.pdf'): static
    {
        return $this->state(['attachment_path' => $path]);
    }

    public function forTenant(Tenant $tenant): static
    {
        return $this->state([
            'tenant_id' => $tenant->id,
            'resident_id' => Resident::factory()->state(['tenant_id' => $tenant->id]),
        ]);
    }
}
