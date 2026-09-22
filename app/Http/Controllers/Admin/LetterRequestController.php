<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LetterRequestStatus;
use App\Http\Controllers\Controller;
use App\Models\LetterRequest;
use App\Services\LetterDocumentService;
use App\Services\LetterNumberService;
use App\Services\TenantContext;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LetterRequestController extends Controller
{
    public function index(Request $request, TenantContext $context): View
    {
        Gate::authorize('viewAny', LetterRequest::class);

        $tenant = $context->tenant();

        $query = LetterRequest::query()
            ->with(['resident', 'letterType'])
            ->where('tenant_id', $tenant->id)
            ->latest('requested_at');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        return view('admin.letters.index', [
            'requests' => $query->paginate(15),
        ]);
    }

    public function show(LetterRequest $letterRequest): View
    {
        Gate::authorize('update', $letterRequest);

        $letterRequest->load(['resident', 'letterType', 'processor']);

        return view('admin.letters.show', [
            'request' => $letterRequest,
        ]);
    }

    public function approve(Request $request, LetterRequest $letterRequest): RedirectResponse
    {
        Gate::authorize('update', $letterRequest);

        if ($letterRequest->status !== LetterRequestStatus::Pending) {
            return back()->with('error', 'Hanya pengajuan berstatus menunggu yang dapat disetujui.');
        }

        $letterRequest->update([
            'status' => LetterRequestStatus::Approved,
            'processed_by' => $request->user()?->id,
            'processed_at' => now(),
        ]);

        return back()->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject(Request $request, LetterRequest $letterRequest): RedirectResponse
    {
        Gate::authorize('update', $letterRequest);

        if ($letterRequest->status !== LetterRequestStatus::Pending) {
            return back()->with('error', 'Hanya pengajuan berstatus menunggu yang dapat ditolak.');
        }

        $validated = $request->validate([
            'rejection_reason' => ['required', 'string'],
        ]);

        $letterRequest->update([
            'status' => LetterRequestStatus::Rejected,
            'processed_by' => $request->user()?->id,
            'processed_at' => now(),
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return back()->with('success', 'Pengajuan berhasil ditolak.');
    }

    public function complete(Request $request, LetterRequest $letterRequest, LetterNumberService $numberService, LetterDocumentService $documentService): RedirectResponse
    {
        Gate::authorize('update', $letterRequest);

        if ($letterRequest->status !== LetterRequestStatus::Approved) {
            return back()->with('error', 'Hanya pengajuan berstatus disetujui yang dapat diselesaikan.');
        }

        $letterNumber = $numberService->generate($letterRequest);

        // Ensure uniqueness just in case
        while (LetterRequest::where('tenant_id', $letterRequest->tenant_id)->where('letter_number', $letterNumber)->exists()) {
            // In highly concurrent cases, we might need to sleep or append randomness, but ID is in the number so it should be unique.
            $letterNumber .= '-'.rand(10, 99);
        }

        $letterRequest->letter_number = $letterNumber;
        $path = $documentService->generate($letterRequest);

        $letterRequest->update([
            'status' => LetterRequestStatus::Completed,
            'generated_document_path' => $path,
        ]);

        return back()->with('success', 'Surat berhasil diselesaikan dan dokumen telah dibuat.');
    }

    public function download(LetterRequest $letterRequest): StreamedResponse|RedirectResponse
    {
        Gate::authorize('update', $letterRequest);

        if ($letterRequest->status !== LetterRequestStatus::Completed || ! $letterRequest->generated_document_path) {
            return back()->with('error', 'Dokumen belum tersedia.');
        }

        if (! Storage::disk('local')->exists($letterRequest->generated_document_path)) {
            return back()->with('error', 'File dokumen tidak ditemukan.');
        }

        return Storage::disk('local')->download($letterRequest->generated_document_path, 'Surat_'.$letterRequest->letter_number.'.html');
    }
}
