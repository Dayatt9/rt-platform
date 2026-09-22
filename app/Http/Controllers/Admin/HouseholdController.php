<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Household;
use App\Models\HouseholdMember;
use App\Models\Resident;
use App\Services\CurrentTenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class HouseholdController extends Controller
{
    public function index(Request $request, CurrentTenant $currentTenant): View
    {
        $tenant = $currentTenant->forUser($request->user(), $request);
        $q = Household::query()->where('tenant_id', $tenant->id)->with('house');
        if ($s = $request->string('search')->trim()->toString()) {
            $q->where('kk_number', 'like', "%{$s}%");
        }

        return view('admin.households.index', ['households' => $q->orderBy('kk_number')->paginate(20)->withQueryString(), 'tenant' => $tenant]);
    }

    public function create(Request $request, CurrentTenant $currentTenant): View
    {
        $tenant = $currentTenant->forUser($request->user(), $request);

        return view('admin.households.form', ['household' => new Household, 'houses' => House::where('tenant_id', $tenant->id)->orderBy('house_number')->get(), 'tenant' => $tenant]);
    }

    public function store(Request $request, CurrentTenant $currentTenant): RedirectResponse
    {
        $tenant = $currentTenant->forUser($request->user(), $request);
        $household = new Household($this->validated($request, $tenant->id));
        $household->tenant()->associate($tenant);
        $household->save();

        return to_route('admin.households.show', $household)->with('status', 'Data KK disimpan.');
    }

    public function show(Household $household): View
    {
        Gate::authorize('manage', $household);
        $household->load(['house', 'members.resident']);
        $residents = Resident::where('tenant_id', $household->tenant_id)->where('status', 'active')->orderBy('name')->get();

        return view('admin.households.show', compact('household', 'residents'));
    }

    public function edit(Household $household): View
    {
        Gate::authorize('manage', $household);

        return view('admin.households.form', ['household' => $household, 'houses' => House::where('tenant_id', $household->tenant_id)->orderBy('house_number')->get()]);
    }

    public function update(Request $request, Household $household): RedirectResponse
    {
        Gate::authorize('manage', $household);
        $data = $this->validated($request, $household->tenant_id, $household->id, false);
        if (blank($data['kk_number'] ?? null)) {
            unset($data['kk_number']);
        } $household->update($data);

        return to_route('admin.households.show', $household)->with('status', 'Data KK diperbarui.');
    }

    public function addMember(Request $request, Household $household): RedirectResponse
    {
        Gate::authorize('manage', $household);
        $data = $request->validate(['resident_id' => ['required', 'integer', Rule::exists('residents', 'id')], 'family_role' => ['required', Rule::in(['head', 'spouse', 'child', 'parent', 'other'])]]);
        /** @var Resident $resident */
        $resident = Resident::findOrFail($data['resident_id']);
        abort_unless($resident->tenant_id === $household->tenant_id, 403);
        $exists = HouseholdMember::query()->where('household_id', $household->id)->where('resident_id', $resident->id)->where('status', 'active')->exists();
        if ($exists) {
            return back()->withErrors(['resident_id' => 'Warga sudah menjadi anggota aktif KK ini.']);
        }
        HouseholdMember::create(['tenant_id' => $household->tenant_id, 'household_id' => $household->id, 'resident_id' => $resident->id, 'family_role' => $data['family_role'], 'status' => 'active', 'joined_at' => today()]);

        return back()->with('status', 'Anggota KK ditambahkan.');
    }

    public function endMember(Household $household, HouseholdMember $member): RedirectResponse
    {
        Gate::authorize('manage', $household);
        abort_unless($member->household_id === $household->id && $member->tenant_id === $household->tenant_id, 404);
        $member->update(['status' => 'inactive', 'left_at' => today()]);

        return back()->with('status', 'Keanggotaan diarsipkan.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, int $tenantId, ?int $ignoreId = null, bool $kkRequired = true): array
    {
        $data = $request->validate(['kk_number' => [$kkRequired ? 'required' : 'nullable', 'digits:16', Rule::unique('households', 'kk_number')->where('tenant_id', $tenantId)->ignore($ignoreId)], 'house_id' => ['nullable', 'integer', Rule::exists('houses', 'id')], 'status' => ['required', Rule::in(['active', 'inactive'])]]);
        if (! empty($data['house_id'])) {
            abort_unless(House::whereKey($data['house_id'])->where('tenant_id', $tenantId)->exists(), 403);
        }

        return $data;
    }
}
