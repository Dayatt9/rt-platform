<?php

namespace Database\Factories;

use App\Models\Resident;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Resident>
 */
class ResidentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'nik' => $this->faker->unique()->numerify('################'),
            'name' => $this->faker->name(),
            'gender' => 'male',
            'birth_date' => $this->faker->date(),
            'phone' => $this->faker->numerify('08##########'),
            'status' => 'active',
        ];
    }
}
