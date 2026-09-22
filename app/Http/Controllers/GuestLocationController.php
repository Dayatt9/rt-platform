<?php

namespace App\Http\Controllers;

use App\Services\GuestLocationLinkService;
use Illuminate\Http\Response;
use Illuminate\View\View;

class GuestLocationController extends Controller
{
    public function show(string $token, GuestLocationLinkService $links): View|Response
    {
        $link = $links->findUsable($token);
        abort_if($link === null, 404);

        return view('guest.location', [
            'address' => $link->house->address,
            'latitude' => (string) $link->house->latitude,
            'longitude' => (string) $link->house->longitude,
        ]);
    }
}
