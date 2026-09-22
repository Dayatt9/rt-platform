<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property Carbon $expires_at
 * @property Carbon|null $used_at
 * @property Carbon|null $revoked_at
 * @property int|null $pending_user_id
 */
#[Fillable([
    'tenant_id',
    'resident_id',
    'created_by',
    'pending_user_id',
    'code_hash',
    'lookup_hash',
    'expires_at',
    'used_at',
    'revoked_at',
])]
#[Hidden(['code_hash', 'lookup_hash'])]
class ActivationCode extends Model
{
    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'used_at' => 'datetime',
            'revoked_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<Tenant, $this> */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /** @return BelongsTo<Resident, $this> */
    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }

    /** @return BelongsTo<User, $this> */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /** @return BelongsTo<User, $this> */
    public function pendingUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pending_user_id');
    }

    public function isClaimable(): bool
    {
        return $this->used_at === null
            && $this->revoked_at === null
            && $this->pending_user_id === null
            && $this->expires_at->isFuture();
    }

    public function hasExpired(): bool
    {
        return $this->expires_at->isPast();
    }
}
