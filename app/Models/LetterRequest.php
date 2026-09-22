<?php

namespace App\Models;

use App\Enums\LetterRequestStatus;
use Database\Factories\LetterRequestFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $tenant_id
 * @property int $letter_type_id
 * @property int $resident_id
 * @property LetterRequestStatus $status
 * @property string|null $letter_number
 * @property Carbon $requested_at
 * @property Carbon|null $processed_at
 * @property int|null $processed_by
 * @property string|null $rejection_reason
 * @property array<string, mixed>|null $request_data
 * @property string $snapshot_type_code
 * @property string $snapshot_type_name
 * @property array<int, array{name: string, label: string, type: string, required: bool}>|null $snapshot_fields
 * @property string|null $generated_document_path
 */
#[Fillable([
    'tenant_id', 'letter_type_id', 'resident_id', 'status', 'letter_number',
    'requested_at', 'processed_at', 'processed_by', 'rejection_reason',
    'request_data', 'snapshot_type_code', 'snapshot_type_name', 'snapshot_fields',
    'generated_document_path',
])]
class LetterRequest extends Model
{
    /** @use HasFactory<LetterRequestFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => LetterRequestStatus::class,
            'requested_at' => 'datetime',
            'processed_at' => 'datetime',
            'request_data' => 'array',
            'snapshot_fields' => 'array',
        ];
    }

    /** @return BelongsTo<Tenant, $this> */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /** @return BelongsTo<LetterType, $this> */
    public function letterType(): BelongsTo
    {
        return $this->belongsTo(LetterType::class);
    }

    /** @return BelongsTo<Resident, $this> */
    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }

    /** @return BelongsTo<User, $this> */
    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
