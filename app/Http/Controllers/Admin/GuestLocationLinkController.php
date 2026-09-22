<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuestLocationLink;
use App\Models\House;
use App\Services\GuestLocationLinkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class GuestLocationLinkController extends Controller
{
    public function store(House $house, GuestLocationLinkService $links): RedirectResponse
    {
        Gate::authorize('manage', $house);
        if ($house->status !== 'active' || $house->latitude === null || $house->longitude === null) {
            return back()->withErrors(['coordinates' => 'Rumah aktif harus memiliki koordinat sebelum membuat tautan lokasi tamu.']);
        }
        $generated = $links->generate($house, request()->user());

        return to_route('admin.houses.show', $house)->with('guest_location_url', route('guest.location.show', $generated->token));
    }

    public function destroy(House $house, GuestLocationLink $guestLocationLink, GuestLocationLinkService $links): RedirectResponse
    {
        Gate::authorize('manage', $house);
        Gate::authorize('manage', $guestLocationLink);
        abort_unless($guestLocationLink->house_id === $house->id && $guestLocationLink->tenant_id === $house->tenant_id, 404);
        $links->revoke($guestLocationLink);

        return to_route('admin.houses.show', $house)->with('status', 'Tautan lokasi tamu dicabut.');
    }
}
