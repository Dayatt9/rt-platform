<?php

namespace App\Services;

use App\Models\GuestLocationLink;

readonly class GeneratedGuestLocationLink
{
    public function __construct(public GuestLocationLink $link, public string $token) {}
}
