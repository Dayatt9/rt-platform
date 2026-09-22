<?php

namespace App\Models;

use Database\Factories\LetterTypeFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $tenant_id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property array<int, array{name: string, label: string, type: string, required: bool}>|null $fields
 * @property string|null $template_body
 * @property bool $is_active
 */
#[Fillable(['tenant_id', 'code', 'name', 'description', 'fields', 'template_body', 'is_active'])]
class LetterType extends Model
{
    /** @use HasFactory<LetterTypeFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fields' => 'array',
            'is_active' => 'boolean',
        ];
    }

    /** @return BelongsTo<Tenant, $this> */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /** @return HasMany<LetterRequest, $this> */
    public function letterRequests(): HasMany
    {
        return $this->hasMany(LetterRequest::class);
    }
}
