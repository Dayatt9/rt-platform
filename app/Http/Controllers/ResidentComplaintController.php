<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Services\ComplaintService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResidentComplaintController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $complaints = Complaint::query()
            ->where('tenant_id', $user->tenant_id)
            ->where('resident_id', $user->resident_id)
            ->latest()
            ->paginate(10);

        return view('resident.complaints.index', compact('complaints'));
    }

    public function create(Request $request): View
    {
        Gate::authorize('create', Complaint::class);

        return view('resident.complaints.create', ['categories' => Complaint::CATEGORIES]);
    }

    public function store(Request $request, ComplaintService $complaints): RedirectResponse
    {
        Gate::authorize('create', Complaint::class);

        $data = $request->validate([
            'category' => ['required', 'string', Rule::in(array_keys(Complaint::CATEGORIES))],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:5120'],
        ]);

        $complaint = $complaints->create(
            $request->user(),
            [
                'category' => $data['category'],
                'title' => $data['title'],
                'description' => $data['description'],
            ],
            $request->file('attachment'),
        );

        return to_route('resident.complaints.show', $complaint)
            ->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function show(Complaint $complaint): View
    {
        Gate::authorize('view', $complaint);

        $complaint->load('responder');

        return view('resident.complaints.show', compact('complaint'));
    }

    public function attachment(Complaint $complaint, ComplaintService $complaints): StreamedResponse|RedirectResponse
    {
        Gate::authorize('view', $complaint);

        if (! $complaints->attachmentExists($complaint)) {
            return back()->with('error', 'Lampiran tidak ditemukan.');
        }

        return Storage::disk('local')->download($complaint->attachment_path, $complaints->attachmentDownloadName($complaint));
    }
}
