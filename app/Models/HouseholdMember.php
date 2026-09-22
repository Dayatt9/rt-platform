<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['tenant_id', 'household_id', 'resident_id', 'family_role', 'status', 'joined_at', 'left_at'])]
class HouseholdMember extends Model
{
    protected function casts(): array
    {
        return ['joined_at' => 'date', 'left_at' => 'date'];
    }

    /** @return BelongsTo<Household, $this> */
    public function household(): BelongsTo { return $this->belongsTo(Household::class); }

    /** @return BelongsTo<Resident, $this> */
    public function resident(): BelongsTo { return $this->belongsTo(Resident::class); }

    /** @return BelongsTo<Tenant, $this> */
    public function tenant(): BelongsTo { return $this->belongsTo(Tenant::class); }
}
