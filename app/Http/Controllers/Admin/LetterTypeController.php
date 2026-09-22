<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LetterType;
use App\Services\TenantContext;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class LetterTypeController extends Controller
{
    public function index(Request $request, TenantContext $context): View
    {
        Gate::authorize('viewAny', LetterType::class);

        $tenant = $context->tenant();
        $letterTypes = LetterType::query()
            ->where('tenant_id', $tenant->id)
            ->latest()
            ->paginate(15);

        return view('admin.letter-types.index', [
            'letterTypes' => $letterTypes,
        ]);
    }

    public function create(): View
    {
        Gate::authorize('create', LetterType::class);

        return view('admin.letter-types.form', [
            'letterType' => new LetterType,
        ]);
    }

    public function store(Request $request, TenantContext $context): RedirectResponse
    {
        Gate::authorize('create', LetterType::class);

        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'fields' => ['nullable', 'array'],
            'fields.*.name' => ['required', 'string', 'alpha_dash'],
            'fields.*.label' => ['required', 'string'],
            'fields.*.type' => ['required', 'string', 'in:text,textarea,date,number'],
            'fields.*.required' => ['boolean'],
            'template_body' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        // Code uniqueness within tenant
        $request->validate([
            'code' => [
                function ($attribute, $value, $fail) use ($context) {
                    if (LetterType::where('tenant_id', $context->tenant()->id)->where('code', $value)->exists()) {
                        $fail('Kode surat sudah digunakan.');
                    }
                },
            ],
        ]);

        $validated['tenant_id'] = $context->tenant()->id;
        $validated['is_active'] = $request->boolean('is_active');
        $validated['fields'] = $request->input('fields', []);

        LetterType::create($validated);

        return redirect()->route('admin.letter-types.index')->with('success', 'Jenis surat berhasil ditambahkan.');
    }

    public function edit(LetterType $letterType): View
    {
        Gate::authorize('update', $letterType);

        return view('admin.letter-types.form', [
            'letterType' => $letterType,
        ]);
    }

    public function update(Request $request, LetterType $letterType): RedirectResponse
    {
        Gate::authorize('update', $letterType);

        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'fields' => ['nullable', 'array'],
            'fields.*.name' => ['required', 'string', 'alpha_dash'],
            'fields.*.label' => ['required', 'string'],
            'fields.*.type' => ['required', 'string', 'in:text,textarea,date,number'],
            'fields.*.required' => ['boolean'],
            'template_body' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        if ($validated['code'] !== $letterType->code) {
            $request->validate([
                'code' => [
                    function ($attribute, $value, $fail) use ($letterType) {
                        if (LetterType::where('tenant_id', $letterType->tenant_id)->where('code', $value)->exists()) {
                            $fail('Kode surat sudah digunakan.');
                        }
                    },
                ],
            ]);
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['fields'] = $request->input('fields', []);

        $letterType->update($validated);

        return redirect()->route('admin.letter-types.index')->with('success', 'Jenis surat berhasil diperbarui.');
    }
}
