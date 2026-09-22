<?php

namespace Database\Factories;

use App\Models\Household;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Household> */
class HouseholdFactory extends Factory
{
    public function definition(): array
    {
        return ['tenant_id' => Tenant::factory(), 'house_id' => null, 'kk_number' => $this->faker->unique()->numerify('################'), 'status' => 'active'];
    }
}
