<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tenant>
 */
class TenantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'RT '.$this->faker->unique()->numerify('###'),
            'province' => 'Bali',
            'regency' => 'Denpasar',
            'district' => 'Denpasar Selatan',
            'village' => 'Sanur',
            'rt_number' => $this->faker->numerify('##'),
            'rw_number' => $this->faker->numerify('##'),
            'address' => $this->faker->address(),
            'status' => 'active',
        ];
    }
}
