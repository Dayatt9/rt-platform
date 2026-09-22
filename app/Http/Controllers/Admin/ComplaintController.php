<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ComplaintStatus;
use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Services\ComplaintService;
use App\Services\CurrentTenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ComplaintController extends Controller
{
    public function index(Request $request, CurrentTenant $currentTenant): View
    {
        Gate::authorize('viewAny', Complaint::class);

        $tenant = $currentTenant->forUser($request->user(), $request);
        $filters = $request->validate([
            'status' => ['nullable', Rule::in(array_map(fn (ComplaintStatus $status) => $status->value, ComplaintStatus::cases()))],
            'category' => ['nullable', Rule::in(array_keys(Complaint::CATEGORIES))],
        ]);

        $complaints = Complaint::query()
            ->with('resident')
            ->where('tenant_id', $tenant->id)
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->when($filters['category'] ?? null, fn ($query, $category) => $query->where('category', $category))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.complaints.index', [
            'complaints' => $complaints,
            'categories' => Complaint::CATEGORIES,
            'statuses' => ComplaintStatus::cases(),
        ]);
    }

    public function show(Complaint $complaint): View
    {
        Gate::authorize('update', $complaint);

        $complaint->load(['resident', 'responder']);

        return view('admin.complaints.show', [
            'complaint' => $complaint,
            'statuses' => ComplaintStatus::cases(),
        ]);
    }

    public function updateStatus(Request $request, Complaint $complaint, ComplaintService $complaints): RedirectResponse
    {
        Gate::authorize('update', $complaint);

        $data = $request->validate([
            'status' => ['required', Rule::in(array_map(fn (ComplaintStatus $status) => $status->value, ComplaintStatus::cases()))],
        ]);
        $status = ComplaintStatus::from($data['status']);

        if (! $complaints->transition($complaint, $status)) {
            return back()->with('error', 'Perubahan status tersebut tidak diizinkan.');
        }

        return back()->with('success', 'Status pengaduan diperbarui.');
    }

    public function updateResponse(Request $request, Complaint $complaint, ComplaintService $complaints): RedirectResponse
    {
        Gate::authorize('update', $complaint);

        $data = $request->validate([
            'admin_response' => ['required', 'string', 'max:5000'],
        ]);

        $complaints->respond($complaint, $request->user(), $data['admin_response']);

        return back()->with('success', 'Tanggapan pengurus disimpan.');
    }

    public function attachment(Complaint $complaint, ComplaintService $complaints): StreamedResponse|RedirectResponse
    {
        Gate::authorize('update', $complaint);

        if (! $complaints->attachmentExists($complaint)) {
            return back()->with('error', 'Lampiran tidak ditemukan.');
        }

        return Storage::disk('local')->download($complaint->attachment_path, $complaints->attachmentDownloadName($complaint));
    }
}
