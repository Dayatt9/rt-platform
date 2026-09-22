<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Services\CurrentTenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class HouseController extends Controller
{
    public function index(Request $request, CurrentTenant $currentTenant): View
    {
        $tenant = $currentTenant->forUser($request->user(), $request);
        $q = House::query()->where('tenant_id', $tenant->id);
        if ($s = $request->string('search')->trim()->toString()) {
            $q->where(fn ($x) => $x->where('house_number', 'like', "%{$s}%")->orWhere('address', 'like', "%{$s}%"));
        }

        return view('admin.houses.index', ['houses' => $q->orderBy('house_number')->paginate(20)->withQueryString(), 'tenant' => $tenant]);
    }

    public function create(Request $request, CurrentTenant $currentTenant): View
    {
        return view('admin.houses.form', ['house' => new House, 'tenant' => $currentTenant->forUser($request->user(), $request)]);
    }

    public function store(Request $request, CurrentTenant $currentTenant): RedirectResponse
    {
        $tenant = $currentTenant->forUser($request->user(), $request);
        $house = new House($this->validated($request, $tenant->id));
        $house->tenant()->associate($tenant);
        $house->save();

        return to_route('admin.houses.show', $house)->with('status', 'Rumah disimpan.');
    }

    public function show(House $house): View
    {
        Gate::authorize('manage', $house);
        $house->load(['households', 'guestLocationLinks' => fn ($q) => $q->latest()]);

        return view('admin.houses.show', compact('house'));
    }

    public function edit(House $house): View
    {
        Gate::authorize('manage', $house);

        return view('admin.houses.form', compact('house'));
    }

    public function update(Request $request, House $house): RedirectResponse
    {
        Gate::authorize('manage', $house);
        $house->update($this->validated($request, $house->tenant_id, $house->id));

        return to_route('admin.houses.show', $house)->with('status', 'Rumah diperbarui.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, int $tenantId, ?int $ignoreId = null): array
    {
        return $request->validate(['house_number' => ['required', 'string', 'max:100', Rule::unique('houses', 'house_number')->where('tenant_id', $tenantId)->ignore($ignoreId)], 'address' => ['required', 'string', 'max:2000'], 'latitude' => ['nullable', 'numeric', 'between:-90,90'], 'longitude' => ['nullable', 'numeric', 'between:-180,180'], 'status' => ['required', Rule::in(['active', 'inactive'])]]);
    }
}
