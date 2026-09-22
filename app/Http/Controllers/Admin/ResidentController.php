<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use App\Services\CurrentTenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ResidentController extends Controller
{
    public function index(Request $request, CurrentTenant $currentTenant): View
    {
        $tenant = $currentTenant->forUser($request->user(), $request);
        $query = Resident::query()->where('tenant_id', $tenant->id)->with('user');
        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(fn ($q) => $q->where('name', 'like', "%{$search}%")->orWhere('nik', 'like', "%{$search}%")->orWhere('phone', 'like', "%{$search}%"));
        }
        if (in_array($request->input('status'), ['active', 'inactive'], true)) $query->where('status', $request->input('status'));
        return view('admin.residents.index', ['residents' => $query->orderBy('name')->paginate(20)->withQueryString(), 'tenant' => $tenant]);
    }

    public function create(Request $request, CurrentTenant $currentTenant): View { return view('admin.residents.form', ['resident' => new Resident, 'tenant' => $currentTenant->forUser($request->user(), $request)]); }

    public function store(Request $request, CurrentTenant $currentTenant): RedirectResponse
    {
        $tenant = $currentTenant->forUser($request->user(), $request);
        $resident = new Resident($this->validated($request, $tenant->id)); $resident->tenant()->associate($tenant); $resident->save();
        return to_route('admin.residents.show', $resident)->with('status', 'Data warga disimpan.');
    }

    public function show(Resident $resident): View { Gate::authorize('view', $resident); return view('admin.residents.show', compact('resident')); }
    public function edit(Resident $resident): View { Gate::authorize('manage', $resident); return view('admin.residents.form', compact('resident')); }
    public function update(Request $request, Resident $resident): RedirectResponse { Gate::authorize('manage', $resident); $data=$this->validated($request, $resident->tenant_id, $resident->id, false); foreach (['nik', 'phone'] as $field) if (blank($data[$field] ?? null)) unset($data[$field]); $resident->update($data); return to_route('admin.residents.show', $resident)->with('status', 'Data warga diperbarui.'); }
    public function status(Request $request, Resident $resident): RedirectResponse { Gate::authorize('manage', $resident); $data=$request->validate(['status'=>['required', Rule::in(['active','inactive'])]]); $resident->update($data); return back()->with('status','Status warga diperbarui.'); }

    private function validated(Request $request, int $tenantId, ?int $ignoreId = null, bool $nikRequired = true): array
    {
        return $request->validate([
            'name'=>['required','string','max:255'], 'nik'=>[$nikRequired ? 'required' : 'nullable','digits:16', Rule::unique('residents','nik')->where('tenant_id',$tenantId)->ignore($ignoreId)],
            'gender'=>['nullable',Rule::in(['male','female'])], 'birth_date'=>['nullable','date','before:today'], 'phone'=>['nullable','string','max:30'], 'status'=>['required',Rule::in(['active','inactive'])],
        ]);
    }
}
