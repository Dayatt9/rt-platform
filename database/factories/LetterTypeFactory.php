<?php

namespace Database\Factories;

use App\Models\LetterType;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LetterType>
 */
class LetterTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'code' => 'SRT-'.$this->faker->unique()->numerify('####'),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'fields' => [
                ['name' => 'keperluan', 'label' => 'Keperluan', 'type' => 'text', 'required' => true],
            ],
            'template_body' => 'Surat untuk {{resident_name}} dengan keperluan {{keperluan}}.',
            'is_active' => true,
        ];
    }
}
