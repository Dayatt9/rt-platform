<?php

namespace App\Http\Controllers;

use App\Enums\LetterRequestStatus;
use App\Models\LetterRequest;
use App\Models\LetterType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResidentLetterController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $requests = LetterRequest::query()
            ->with('letterType')
            ->where('tenant_id', $user->tenant_id)
            ->where('resident_id', $user->resident_id)
            ->latest('requested_at')
            ->paginate(10);

        return view('resident.letters.index', [
            'requests' => $requests,
        ]);
    }

    public function create(Request $request): View
    {
        $user = $request->user();

        $letterTypes = LetterType::query()
            ->where('tenant_id', $user->tenant_id)
            ->where('is_active', true)
            ->get();

        $selectedType = null;
        if ($request->has('type')) {
            $selectedType = $letterTypes->firstWhere('id', $request->input('type'));
        }

        return view('resident.letters.create', [
            'letterTypes' => $letterTypes,
            'selectedType' => $selectedType,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validatedType = $request->validate([
            'letter_type_id' => ['required', 'exists:letter_types,id'],
        ]);

        /** @var LetterType $letterType */
        $letterType = LetterType::where('tenant_id', $user->tenant_id)
            ->where('is_active', true)
            ->findOrFail($validatedType['letter_type_id']);

        $rules = [];
        if (is_array($letterType->fields)) {
            foreach ($letterType->fields as $field) {
                $fieldName = 'field_'.$field['name'];
                $fieldRules = [];
                if ($field['required']) {
                    $fieldRules[] = 'required';
                } else {
                    $fieldRules[] = 'nullable';
                }

                if ($field['type'] === 'number') {
                    $fieldRules[] = 'numeric';
                } elseif ($field['type'] === 'date') {
                    $fieldRules[] = 'date';
                } else {
                    $fieldRules[] = 'string';
                }

                $rules[$fieldName] = $fieldRules;
            }
        }

        $validatedData = $request->validate($rules);

        $requestData = [];
        if (is_array($letterType->fields)) {
            foreach ($letterType->fields as $field) {
                $requestData[$field['name']] = $validatedData['field_'.$field['name']] ?? null;
            }
        }

        LetterRequest::create([
            'tenant_id' => $user->tenant_id,
            'letter_type_id' => $letterType->id,
            'resident_id' => $user->resident_id,
            'status' => LetterRequestStatus::Pending,
            'requested_at' => now(),
            'request_data' => $requestData,
            'snapshot_type_code' => $letterType->code,
            'snapshot_type_name' => $letterType->name,
            'snapshot_fields' => $letterType->fields,
        ]);

        return redirect()->route('resident.letters.index')->with('success', 'Pengajuan surat berhasil dikirim.');
    }

    public function show(LetterRequest $letterRequest): View
    {
        Gate::authorize('view', $letterRequest);

        return view('resident.letters.show', [
            'request' => $letterRequest,
        ]);
    }

    public function download(LetterRequest $letterRequest): StreamedResponse|RedirectResponse
    {
        Gate::authorize('view', $letterRequest);

        if ($letterRequest->status !== LetterRequestStatus::Completed || ! $letterRequest->generated_document_path) {
            return back()->with('error', 'Dokumen belum tersedia.');
        }

        if (! Storage::disk('local')->exists($letterRequest->generated_document_path)) {
            return back()->with('error', 'File dokumen tidak ditemukan.');
        }

        return Storage::disk('local')->download($letterRequest->generated_document_path, 'Surat_'.$letterRequest->letter_number.'.html');
    }
}
