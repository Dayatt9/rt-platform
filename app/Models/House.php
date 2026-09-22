<?php

namespace App\Models;

use Database\Factories\HouseFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['house_number', 'address', 'latitude', 'longitude', 'status'])]
class House extends Model
{
    /** @use HasFactory<HouseFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return ['latitude' => 'decimal:7', 'longitude' => 'decimal:7'];
    }

    /** @return BelongsTo<Tenant, $this> */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /** @return HasMany<Household, $this> */
    public function households(): HasMany
    {
        return $this->hasMany(Household::class);
    }

    /** @return HasMany<GuestLocationLink, $this> */
    public function guestLocationLinks(): HasMany
    {
        return $this->hasMany(GuestLocationLink::class);
    }
}
