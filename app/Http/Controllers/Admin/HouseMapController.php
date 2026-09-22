<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Services\CurrentTenant;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HouseMapController extends Controller
{
    public function index(Request $request, CurrentTenant $currentTenant): View
    {
        $tenant = $currentTenant->forUser($request->user(), $request);
        $houses = House::query()
            ->where('tenant_id', $tenant->id)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('house_number')
            ->get(['id', 'house_number', 'address', 'latitude', 'longitude']);

        return view('admin.houses.map', compact('houses'));
    }
}
