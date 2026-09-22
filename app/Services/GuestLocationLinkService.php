<?php

namespace App\Services;

use App\Models\GuestLocationLink;
use App\Models\House;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GuestLocationLinkService
{
    public function generate(House $house, User $creator): GeneratedGuestLocationLink
    {
        $token = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
        $link = new GuestLocationLink;
        $link->forceFill([
            'tenant_id' => $house->tenant_id,
            'house_id' => $house->id,
            'created_by' => $creator->id,
            'token_hash' => Hash::make($token),
            'lookup_hash' => $this->lookupHash($token),
            'expires_at' => now()->addHours(config('guest-location.link_ttl_hours')),
        ])->save();

        return new GeneratedGuestLocationLink($link, $token);
    }

    public function findUsable(string $token): ?GuestLocationLink
    {
        $link = GuestLocationLink::query()
            ->with(['house.tenant'])
            ->where('lookup_hash', $this->lookupHash($token))
            ->first();

        if ($link === null || ! Hash::check($token, $link->token_hash)) {
            return null;
        }

        return $link->isUsable()
            && $link->house !== null
            && $link->house->status === 'active'
            && $link->house->latitude !== null
            && $link->house->longitude !== null
            && $link->house->tenant_id === $link->tenant_id
            && $link->house->tenant !== null
            && $link->house->tenant->isActive()
            ? $link : null;
    }

    public function revoke(GuestLocationLink $link): void
    {
        if ($link->revoked_at === null) {
            $link->forceFill(['revoked_at' => now()])->save();
        }
    }

    private function lookupHash(string $token): string
    {
        return hash_hmac('sha256', $token, (string) config('app.key'));
    }
}
