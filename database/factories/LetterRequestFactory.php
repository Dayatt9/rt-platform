<?php

namespace Database\Factories;

use App\Enums\LetterRequestStatus;
use App\Models\LetterRequest;
use App\Models\LetterType;
use App\Models\Resident;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<LetterRequest>
 */
class LetterRequestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'letter_type_id' => LetterType::factory(),
            'resident_id' => Resident::factory(),
            'status' => LetterRequestStatus::Pending,
            'requested_at' => Carbon::now(),
            'request_data' => ['keperluan' => 'Urusan keluarga'],
            'snapshot_type_code' => 'SRT-01',
            'snapshot_type_name' => 'Surat Pengantar',
            'snapshot_fields' => [
                ['name' => 'keperluan', 'label' => 'Keperluan', 'type' => 'text', 'required' => true],
            ],
        ];
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => LetterRequestStatus::Approved,
            'processed_at' => Carbon::now(),
        ]);
    }

    public function rejected(string $reason = 'Tidak lengkap'): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => LetterRequestStatus::Rejected,
            'rejection_reason' => $reason,
            'processed_at' => Carbon::now(),
        ]);
    }

    public function completed(string $number = '123/RT01'): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => LetterRequestStatus::Completed,
            'letter_number' => $number,
            'processed_at' => Carbon::now(),
            'generated_document_path' => 'letters/1/1/'.uniqid().'.html',
        ]);
    }
}
